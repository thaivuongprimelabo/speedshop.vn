<?php

namespace App\Http\Controllers\Auth;

use App\Color;
use App\Product;
use App\ServiceGroups;
use App\Size;
use App\Constants\Common;
use App\Constants\Status;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\ImageProduct;
use App\Constants\ProductType;
use App\Services;
use App\ProductServiceGroup;
use App\ProductDetailGroups;
use App\ProductDetails;
use App\Constants\ProductStatus;

class productsController extends AppController
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->middleware('auth');
        
    }
    
    public function index(Request $request) {
        return view('auth.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request, $type = '') {
        
        return $this->doSearch($request, new Product(), $type);
    }
    
    /**
     * create
     * @param Request $request
     */
    public function create(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                
                DB::beginTransaction();
                
                try {
                    $data = new Product();
                    $data->name          = Utils::cnvNull($request->name, '');
                    $data->name_url      = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                    $data->price         = Utils::cnvNull($request->price, trans('auth.price_empty_text'));
                    $data->category_id   = Utils::cnvNull($request->category_id, '0');
                    $data->vendor_id     = Utils::cnvNull($request->vendor_id, '0');
                    $data->discount      = Utils::cnvNull($request->discount, 0);
                    $data->description   = Utils::cnvNull($request->description, '');
                    $data->summary   = Utils::cnvNull($request->summary, '');
                    $data->status        = Utils::cnvNull($request->status, Status::UNACTIVE);
                    $data->avail_flg     = Utils::cnvNull($request->avail_flg, ProductStatus::OUT_OF_STOCK);
                    $data->is_new        = Utils::cnvNull($request->is_new, 0);
                    $data->is_popular        = Utils::cnvNull($request->is_popular, 0);
                    $data->is_best_selling   = Utils::cnvNull($request->is_best_selling, 0);
                    $data->seo_keywords      = Utils::cnvNull($request->seo_keywords, '');
                    $data->seo_description   = Utils::cnvNull($request->seo_description, '');
                    $data->created_at    = date('Y-m-d H:i:s');
                    $data->updated_at    = date('Y-m-d H:i:s');
                    
                    if($data->save()) {
                        $is_main = $request->is_main;
                        $arrFilenames = [];
                        Utils::doUploadMultiple($request, 'upload_image', $data->id, $arrFilenames, $is_main);
                        if(count($arrFilenames)) {
                            $product_images = [];
                            DB::table(Common::IMAGES_PRODUCT)->insert($arrFilenames);
                        }
                        
                        $this->addService($data->id, $request);
                        
                        DB::commit();
                        
                        return redirect(route('auth_products_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                    }
                    
                } catch(\Exception $e) {
                    DB::rollBack();
                }
                
            } else {
                return redirect(route('auth_products_create'))->with('error', trans('messages.ERROR'));
            }
        }
        
        return view('auth.form', $this->output);
    }
    
    /**
     * create
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $data = Product::find($request->id);
        
        if($request->isMethod('post')) {
            
            $request->description = str_replace('\r\n', '', $request->description);
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                $data->name          = Utils::cnvNull($request->name, '');
                $data->name_url      = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                $data->price         = Utils::cnvNull($request->price, trans('auth.price_empty_text'));
                $data->category_id   = Utils::cnvNull($request->category_id, '0');
                $data->vendor_id     = Utils::cnvNull($request->vendor_id, '0');
                $data->discount      = Utils::cnvNull($request->discount, '');
                $data->description   = Utils::cnvNull($request->description, '');
                $data->summary       = Utils::cnvNull($request->summary, '');
                $data->status        = Utils::cnvNull($request->status, Status::UNACTIVE);
                $data->avail_flg     = Utils::cnvNull($request->avail_flg, ProductStatus::OUT_OF_STOCK);
                $data->is_new        = Utils::cnvNull($request->is_new, 0);
                $data->is_popular        = Utils::cnvNull($request->is_popular, 0);
                $data->is_best_selling   = Utils::cnvNull($request->is_best_selling, 0);
                $data->seo_keywords      = Utils::cnvNull($request->seo_keywords, '');
                $data->seo_description   = Utils::cnvNull($request->seo_description, '');
                $data->updated_at    = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    $is_main = $request->is_main;
                    if(!Utils::blank($is_main)) {
                        DB::table(Common::IMAGES_PRODUCT)->update(['is_main' => 0]);
                    }
                    
                    if(is_numeric($is_main)) {
                        DB::table(Common::IMAGES_PRODUCT)->where('id', $is_main)->update(['is_main' => 1]);
                    }
                    
                    $arrFilenames = [];
                    Utils::doUploadMultiple($request, 'upload_image', $data->id, $arrFilenames, $is_main);
                    if(count($arrFilenames)) {
                        DB::table(Common::IMAGES_PRODUCT)->insert($arrFilenames);
                    }
                    
                    $images_del = $request->images_del;
                    if(!is_null($images_del) && count($images_del)) {
                        DB::table(Common::IMAGES_PRODUCT)->whereIn('id', $images_del)->delete();
                    }
                    
                    $this->addService($data->id, $request);
                    
                    return redirect(route('auth_products_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_products_edit', ['id' => $request->id]))->with('error', trans('messages.ERROR'));
            }
        }
        
        $this->output['data'] = $data;
        return view('auth.form', $this->output);
    }
    
    public function remove(Request $request) {
        $result = ['code' => 404];
        $ids = $request->ids;
        if(Product::destroy($ids)) {
            ProductDetails::whereIn('product_id', $ids)->delete();
            $image_products = ImageProduct::whereIn('product_id', $ids)->get();
            foreach($image_products as $image) {
                Utils::removeFile($image->image);
                Utils::removeFile($image->medium);
                Utils::removeFile($image->small);
            }
            ImageProduct::whereIn('product_id', $ids)->delete();
            $result['code'] = 200;
            return response()->json($result);
        }
    }
    
    private function addService($productId, $request) {
        $services = $request->service;
        
        if($services != null && count($services)) {
            ProductDetails::where('product_id', $productId)->delete();
            foreach($services as $key=>$value) {
                
                $items = $value['item'];
                
                if(!count($items)) {
                    continue;
                }
                
                $productDetailGroup = ProductDetailGroups::where('name', trim($value['group_name']))->first();
                if(!$productDetailGroup) {
                    $productDetailGroup               = new ProductDetailGroups();
                    $productDetailGroup->name         = strip_tags($value['group_name']);
                    $productDetailGroup->created_at   = date('Y-m-d H:i:s');
                    $productDetailGroup->save();
                }
                
                if($productDetailGroup->id) {
                    
                    foreach($items as $item) {
                        
                        if(Utils::blank($item['name'])) {
                            continue;
                        }
                        
                        $detail = new ProductDetails();
                        $detail->name = strip_tags($item['name']);
                        $detail->price = strip_tags($item['price']);
                        $detail->product_id = $productId;
                        $detail->product_detail_group_id = $productDetailGroup->id;
                        $detail->save();
                    }
                }
            }
        }
    }
    
}
