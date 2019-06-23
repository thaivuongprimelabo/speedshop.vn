<?php

namespace App\Http\Controllers\Auth;

use App\Config;
use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Constants\UploadPath;
use App\IpAddress;
class ConfigController extends AppController
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Request $request) {
        $data = Config::first();
        if($request->isMethod('post')) {
            
            if($request->clear_config_cache) {
                Artisan::call('config:clear');
                Artisan::call('view:clear');
                echo '=============== Clear view cache =============== ';
                exit;
            }
            if($request->clear_data) {
                
                UploadPath::removeListPath();
                
                DB::beginTransaction();
                try {
                    $tableList = Common::TABLE_LIST;
                    foreach($tableList as $table) {
                        if($table == Common::USERS) {
                            DB::table($table)->where('id', '!=', 1)->delete();
                            DB::query('ALTER TABLE ' . $table . ' AUTO_INCREMENT = 2');
                        } else {
                            DB::table($table)->truncate();
                            DB::query('ALTER TABLE ' . $table . ' AUTO_INCREMENT = 1');
                        }
                    }
                    
                    DB::commit();
                } catch(\Exception $e) {
                    DB::rollback();
                    echo '=============== ' . $e->getMessage() . ' =============== ';
                    exit;
                }
                echo '=============== Done! =============== ';
                exit;
            }
            $web_ico = $data->web_ico;
            $web_ico_hidden = $request->web_ico_hidden;
            $web_logo = $data->web_logo;
            $web_logo_hidden = $request->web_logo_hidden;
            $web_banner = $data->web_banner;
            $web_banner_hidden = $request->web_banner_hidden;
            
            if(Utils::blank($web_ico_hidden)) {
                $web_ico = null;
            }
            
            if(Utils::blank($web_logo_hidden)) {
                $web_logo = null;
            }
            
            if(Utils::blank($web_banner_hidden)) {
                $web_banner = null;
            }
            
            $key = 'upload_web_logo';
            $demension = $data[$key . '_image_size'];
            Utils::resizeImage($key, $request->$key, $demension, $web_logo);
            
            $key = 'upload_web_ico';
            $demension = $data[$key . '_image_size'];
            Utils::resizeImage($key, $request->$key, $demension, $web_ico);
            
            $key = 'upload_web_banner';
            $demension = $data[$key . '_image_size'];
            Utils::doUploadSimple($request, $key, $web_banner);
            
            $data->web_title       = Utils::cnvNull($request->web_title, '');
            $data->web_description = Utils::cnvNull($request->web_description, '');
            $data->web_keywords    = Utils::cnvNull($request->web_keywords, '');
            $data->web_logo        = $web_logo;
            $data->web_ico         = $web_ico;
            $data->web_banner      = $web_banner;
            $data->web_email       = Utils::cnvNull($request->web_email, '');
            $data->limit_product_show         = Utils::cnvNull($request->limit_product_show, 12);
            $data->limit_product_show_tab     = Utils::cnvNull($request->limit_product_show_tab, 8);
            $data->limit_post_show     = Utils::cnvNull($request->limit_post_show, 12);
            $data->url_ext         = Utils::cnvNull($request->url_ext, '');
            
            $web_address = $request->web_address;
            if(is_array($web_address) && count($web_address)) {
                $web_address = array_filter($web_address, 'strlen');
                $web_address = implode('|', $web_address);
                $data->web_address = $web_address;
            }
            
            $data->web_email = Utils::cnvNull($request->web_email, '');
            
            $web_hotline = $request->web_hotline;
            if(is_array($web_hotline) && count($web_hotline)) {
                $web_hotline = array_filter($web_hotline, 'strlen');
                $web_hotline = implode('|', $web_hotline);
                $data->web_hotline = $web_hotline;
            }
            
            $web_hotline_cskh = $request->web_hotline_cskh;
            if(is_array($web_hotline_cskh) && count($web_hotline_cskh)) {
                $web_hotline_cskh = array_filter($web_hotline_cskh, 'strlen');
                $web_hotline_cskh = implode('|', $web_hotline_cskh);
                $data->web_hotline_cskh = $web_hotline_cskh;
            }
            
            $data->web_working_time = Utils::cnvNull($request->web_working_time, '');
            $data->freeship = Utils::cnvNull($request->freeship, '');
            $data->freeship_money = Utils::cnvNull($request->freeship_money, '');
            $data->footer_text = Utils::cnvNull($request->footer_text, '');
            $data->facebook_fanpage = Utils::cnvNull($request->facebook_fanpage, '');
            $data->youtube_channel = Utils::cnvNull($request->youtube_channel, '');
            $data->zalo_page = Utils::cnvNull($request->zalo_page, '');
            $data->shopee_page = Utils::cnvNull($request->shopee_page, '');
            $data->mail_from = Utils::cnvNull($request->mail_from, '');
            $data->mail_name = Utils::cnvNull($request->mail_name, '');
            if(Auth::user()->role_id == Common::SUPER_ADMIN) {
                $data->upload_banner_maximum_upload = Utils::cnvNull($request->upload_banner_maximum_upload, '');
                $data->upload_logo_maximum_upload = Utils::cnvNull($request->upload_logo_maximum_upload, '');
                $data->upload_image_maximum_upload = Utils::cnvNull($request->upload_image_maximum_upload, '');
                $data->upload_photo_maximum_upload    = Utils::cnvNull($request->upload_photo_maximum_upload, '');
                $data->upload_web_logo_maximum_upload    = Utils::cnvNull($request->upload_web_logo_maximum_upload, '');
                $data->upload_web_ico_maximum_upload    = Utils::cnvNull($request->upload_web_ico_maximum_upload, '');
                $data->upload_avatar_maximum_upload = Utils::cnvNull($request->upload_avatar_maximum_upload, '');
                $data->upload_banner_image_size = Utils::cnvNull($request->upload_banner_image_size, '');
                $data->upload_logo_image_size = Utils::cnvNull($request->upload_logo_image_size, '');
                $data->upload_image_image_size = Utils::cnvNull($request->upload_image_image_size, '');
                $data->upload_photo_image_size = Utils::cnvNull($request->upload_photo_image_size, '');
                $data->upload_web_logo_image_size = Utils::cnvNull($request->upload_web_logo_image_size, '');
                $data->upload_web_ico_image_size = Utils::cnvNull($request->upload_web_ico_image_size, '');
                $data->upload_avatar_image_size = Utils::cnvNull($request->upload_avatar_image_size, '');
                $data->upload_web_banner_maximum_upload = Utils::cnvNull($request->upload_web_banner_maximum_upload, '');
                $data->upload_web_banner_image_size = Utils::cnvNull($request->upload_web_banner_image_size, '');
            }
            $data->off = Utils::cnvNull($request->off, 0);
            $data->bank_info = Utils::cnvNull($request->bank_info, '');
            $data->cash_info = Utils::cnvNull($request->cash_info, '');
            if($data->save()) {
                return redirect(route('auth_config'))->with('success', trans('messages.UPDATE_SUCCESS'));
            }
        }
        
        $this->output['data'] = $data;
        return view('auth.form', $this->output);
    }
    
    /**
     * ipAddress
     * @param Request $request
     */
    public function ipAddress(Request $request) {
        return view('auth.index', $this->ipSearch($request));
    }
    
    /**
     * ipAddress
     * @param Request $request
     */
    public function ipSearch(Request $request) {
        return $this->doSearch($request, new IpAddress());
    }
    
    public function ipRemove(Request $request) {
        $result = ['code' => 404];
        $ids = $request->ids;
        if(IpAddress::destroy($ids)) {
            $result['code'] = 200;
            return response()->json($result);
        }
    }
}
