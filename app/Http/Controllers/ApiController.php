<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Banner;
use App\Vendor;
use App\Constants\Status;
use App\Helpers\Utils;
use App\Category;
use App\Color;
use App\Contact;
use App\Post;
use App\Product;
use App\User;
use App\Size;
use App\Helpers\Cart;
use App\Constants\Common;
use App\Constants\ContactStatus;
use App\Constants\PostStatus;
use App\PostGroups;
use App\Constants\ProductStatus;
use App\Order;

class ApiController extends Controller
{
    public $output = ['code' => 404, 'data' => ''];
    
    public function checkExists(Request $request) {
        $value = trim($request->value);
        $col = trim($request->col);
        $table = $request->table;
        if($table == 'postgroups') {
            $table = Common::POST_GROUPS;
        }
        $idCheck = $request->id_check;
        $itemName = trans($request->itemName);
        $check = false;
        $data = DB::table($table)->where($col, $value)->first();
        $check = true;
        
        if($data && $idCheck != $data->id) {
            $check = false;
        }
        
        if(!$check) {
            $this->output['error'] = trans('validation.unique', ['attribute' => $itemName]);
            return response()->json($this->output, 500);
        }
        $this->output['code'] = 200;
        return response()->json($this->output);
    }
    
    public function updateStatus(Request $request) {
        $id = $request->id;
        $currentStatus = $request->current_status;
        $table = $request->table;
        $object = [];
        switch($table) {
            case Common::VENDORS; // Vendors table
                $object = Vendor::find($id);
                
                break;
            case Common::CATEGORIES; // Categories table
                $object = Category::find($id);
                break;
                
            case Common::BANNERS; // Banners table
                $object = Banner::find($id);
                break;
                
            case Common::CONTACTS; // Contacts table
                $object = Contact::find($id);
                break;
                
            case Common::POSTS; // Posts table
                $object = Post::find($id);
                break;
                
            case Common::USERS; // Users table
                $object = User::find($id);
                break;
                
            case Common::PRODUCTS; // Products table
            case 'PRODUCT_AVAIL_FLG':
                $object = Product::find($id);
                break;
                
            case 'postgroups': // Post Groups table
                $object = PostGroups::find($id);
                
            default:
                break;
        }
        
        if($table == 'PRODUCT_AVAIL_FLG') {
            $object->avail_flg = $currentStatus == 1 ? '0' : '1';
        } else {
            $object->status = $currentStatus == 1 ? '0' : '1';
        }
        
        if($object->save()) {
            $this->output['code'] = 200;
            switch($table) {
                case Common::CONTACTS; // Contacts table
                    $this->output['data'] = ['status' => $object->status, 'text' => ContactStatus::getData($object->status)];
                    break;
                
                case Common::POSTS; // Posts table
                    $this->output['data'] = ['status' => $object->status, 'text' => PostStatus::getData($object->status)];
                    break;
                    
                case Common::PRODUCTS; // Posts table
                    $this->output['data'] = ['status' => $object->status, 'text' => Status::getData($object->status)];
                    break;
                case 'PRODUCT_AVAIL_FLG':
                    $this->output['data'] = ['status' => $object->avail_flg, 'text' => ProductStatus::getData($object->avail_flg)];
                    break;
                default:
                    $this->output['data'] = ['status' => $object->status, 'text' => Status::getData($object->status)];
                    break;
            }
        }
        return response()->json($this->output);
    }
    
    public function loadCity(Request $request, $html = true) {
        $html = '<option value="" selected>' . trans('shop.checkout.choose_province') . '</option>';
        $city = DB::table('devvn_tinhthanhpho')->orderBy('type')->get();
        
        if($city->count()) {
            foreach($city as $ct) {
                $html .= '<option value="' . $ct->matp . '" data-ship-fee="' . $ct->ship_fee . '">' . $ct->name . '</option>';
            }
        }
        
        return $html;
    }
    
    public function loadDistrict(Request $request) {
        
        $html = '<option value="">' . trans('shop.checkout.choose_district') . '</option>';
        
        $cityId = $request->city_id;
        $json = $request->json;
        
        $district = DB::table('devvn_quanhuyen')->where('matp', $cityId)->orderBy('type')->get();
        
        if($json) {
            return response()->json(['data' => $district]);
        }
        
        if($district->count()) {
            foreach($district as $ct) {
                $html .= '<option value="' . $ct->maqh . '" data-ship-fee="' . $ct->ship_fee . '">' . $ct->name . '</option>';
            }
        }
        
        return $html;
        
    }
    
    public function loadWard(Request $request) {
        
        $html = '<option value="">' . trans('shop.checkout.choose_ward') . '</option>';
        
        $districtId = $request->district_id;
        
        $ward = DB::table('devvn_xaphuongthitran')->where('maqh', $districtId)->orderBy('type')->get();
        
        if($ward->count()) {
            foreach($ward as $ct) {
                $html .= '<option value="' . $ct->xaid . '">' . $ct->name . '</option>';
            }
        }
        
        return $html;
    }
    
    public function checkUploadFile(Request $request) {
        $image_mime_type = Common::IMAGE_MIMES;
        $fileSizeLimit = $request->limitUpload;
        if($request->hasFile('fileUpload')) {
            $file = $request->file('fileUpload');
            
            if(!is_array($file)) {
                $mimeType = $request->file('fileUpload')->getMimeType();
                $imageMimeType = explode(',', $image_mime_type);
                
                if(!in_array($mimeType, $imageMimeType)) {
                    return response()->json(['error' => trans('validation.image', ['filename' => $file->getClientOriginalName()])], 500);
                }
                
                $size = $request->file('fileUpload')->getSize();
                if($size > $fileSizeLimit) {
                    return response()->json(['error' => trans('validation.size.file', ['filename' => $file->getClientOriginalName(), 'limit_upload' => Utils::formatMemory($fileSizeLimit)])], 500);
                }
            } else {
                for($i = 0; $i < count($file); $i++) {
                    $f = $file[$i];
                    $mimeType = $f->getMimeType();
                    $imageMimeType = explode(',', $image_mime_type);
                    
                    if(!in_array($mimeType, $imageMimeType)) {
                        return response()->json(['error' => trans('validation.image', ['filename' => $f->getClientOriginalName()])], 500);
                    }
                    
                    $size = $f->getSize();
                    if($size > $fileSizeLimit) {
                        return response()->json(['error' => trans('validation.size.file', ['filename' => $f->getClientOriginalName(), 'limit_upload' => Utils::formatMemory($fileSizeLimit)])], 500);
                    }
                }
            }
        }
    }
    
    public function getSelectPost(Request $request) {
        $posts = Post::select('id', 'name', 'name_url', 'post_group_id')->active()->get();
        $output = [];
        if($posts->count()) {
            foreach($posts as $post) {
                $item = [
                    'id' => $post->id,
                    'name' => $post->name,
                    'name_url' => $post->name_url,
                    'link' => $post->getLink()
                ];
                
                array_push($output, $item);
            }
            return response()->json($output);
        }
        
        return response()->json($output);
    }
    
    public function updateShipFee(Request $request) {
        $id = $request->id;
        $ship_fee = $request->ship_fee;
        DB::table('devvn_tinhthanhpho')->where('matp', $id)->update(['ship_fee' => $ship_fee]);
        DB::table('devvn_quanhuyen')->where('maqh', $id)->orWhere('matp', $id)->update(['ship_fee' => $ship_fee]);
        
        return response()->json(['code' => 200]);
    }
    
    public function orderChecking(Request $request) {
        $value = $request->value;
        $orders = Order::where('customer_email', $value)->orWhere('customer_phone', $value)->orderBy('created_at')->get();
        return response()->json(['#order_checking_list' => view('shop.order_checking_list', compact('orders'))->render()]);
    }
    
}
