<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Common;
use App\Constants\UserRole;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\User;
use App\Category;
use App\Product;
use Carbon\Carbon;
class AppController extends Controller
{
    public $config = [];
    public $result = ['code' => 200, 'data' => ''];
    public $name = '';
    public $rules = [];
    public $output = ['data' => null, 'name' => '', 'rules' => [], 'editor' => 'editor.small.js'];
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
        $this->middleware(['auth', 'admin'])->except('showLoginForm', 'login');
        
        $this->middleware(function ($request, $next) {
            $this->uploadLastLogin();
            
            return $next($request);
        })->except('showLoginForm', 'login');;
        
        // Config
        $config = Utils::getConfig();
        
        if($config) {
            $web_logo = Utils::getImageLink($config->web_logo);
            $web_ico = Utils::getImageLink($config->web_ico);
            
            $this->config['config'] = [
                'web_logo' => $web_logo,
                'web_ico' => $web_ico,
                'mail_from' => Utils::cnvNull($config->mail_from, $config->web_email),
                'mail_name' => Utils::cnvNull($config->mail_name, $config->web_title),
                'web_name' => Utils::cnvNull($config->web_title, ''),
                'web_email' => Utils::cnvNull($config->web_email, ''),
                'web_hotline' => Utils::cnvNull($config->web_hotline, ''),
                'web_hotline_cskh' => Utils::cnvNull($config->web_hotline_cskh, ''),
                'web_working_time' => Utils::cnvNull($config->web_working_time, ''),
                'web_address' => Utils::cnvNull($config->web_address, ''),
                'upload_banner_maximum_upload' => Utils::cnvNull($config->upload_banner_maximum_upload, 51200),
                'upload_logo_maximum_upload' => Utils::cnvNull($config->upload_logo_maximum_upload, 51200),
                'upload_image_maximum_upload' => Utils::cnvNull($config->upload_image_maximum_upload, 51200),
                'upload_photo_maximum_upload'   => Utils::cnvNull($config->upload_photo_maximum_upload, 51200),
                'upload_web_logo_maximum_upload'   => Utils::cnvNull($config->upload_web_logo_maximum_upload, 51200),
                'upload_web_ico_maximum_upload'   => Utils::cnvNull($config->upload_web_ico_maximum_upload, 51200),
                'upload_avatar_maximum_upload'   => Utils::cnvNull($config->upload_avatar_maximum_upload, 51200),
                'upload_web_banner_maximum_upload'   => Utils::cnvNull($config->upload_web_banner_maximum_upload, 51200),
                
                'upload_banner_image_size' => Utils::cnvNull($config->upload_banner_image_size, '100x100'),
                'upload_logo_image_size' => Utils::cnvNull($config->upload_logo_image_size, '100x100'),
                'upload_image_image_size' => Utils::cnvNull($config->upload_image_image_size, '100x100'),
                'upload_photo_image_size'   => Utils::cnvNull($config->upload_photo_image_size, '100x100'),
                'upload_web_logo_image_size'   => Utils::cnvNull($config->upload_web_logo_image_size, '100x100'),
                'upload_web_ico_image_size'   => Utils::cnvNull($config->upload_web_ico_image_size, '100x100'),
                'upload_avatar_image_size'   => Utils::cnvNull($config->upload_avatar_image_size, '100x100'),
                'upload_web_banner_image_size'   => Utils::cnvNull($config->upload_web_banner_image_size, '100x100'),
                
                'limit_product_show' => Utils::cnvNull($config->limit_product_show, 12),
                'limit_product_show_tab' => Utils::cnvNull($config->limit_product_show_tab, 8),
                'limit_post_show' => Utils::cnvNull($config->limit_post_show, 12),
                'url_ext' => Utils::cnvNull($config->url_ext, '.html'),
            ];
            
            View::share($this->config);
        }
        
        $arrUnaccess = [
            'users'
        ];
        
        $exp = explode('_', Route::currentRouteName());
        $this->name = isset($exp[1]) ? $exp[1] : '';
        if($this->name == 'posts' || $this->name == 'products') {
            $this->output['editor'] = 'editor.full.js';
        }
        $this->rules = trans('auth.' . $this->name . '.rules');
        $this->rules = is_array($this->rules) ? $this->rules : [];
        $this->output['name'] =  $this->name;
        $this->output['rules'] = $this->rules;
    }
    
    public function doSearch($request, Model $model, $type = '', $view = 'auth.ajax_list') {
        
        $wheres = [];
        $route = Route::currentRouteName();
        $name = str_replace('auth_', '', str_replace('_search', '', Route::currentRouteName()));
        
        if($request->isMethod('post')) {
            
            $data = $request->all();
            $search_condition = trans('auth.' . $name . '.search_form');
            
            foreach($search_condition as $key=>$con) {
                $value = $data[$key];
                if(!Utils::blank($value)) {
                    if($key == 'name') {
                        $wheres[] = [$key, 'LIKE', '%' . $value . '%'];
                    }elseif($key == 'created_at') { 
                        $value = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
                        $wheres[] = [DB::raw('DATE(' . $key . ')'), '=', $value];
                    }else {
                        $wheres[] = [$key, '=', $value];
                    }
                }
            }
        }
        
        if($model instanceof User) {
            $wheres[] = ['id', '!=', Auth::id()];
            switch(Auth::user()->role_id) {
                case UserRole::ADMIN:
                    $wheres[] = ['role_id', '!=', UserRole::SUPER_ADMIN];
                    break;
                case UserRole::MOD:
                    $wheres[] = ['role_id', '!=', UserRole::SUPER_ADMIN];
                    $wheres[] = ['role_id', '!=', UserRole::ADMIN];
                    break;
            }
            
            if($type == 'members') {
                $wheres[] = ['role_id', '=', UserRole::MEMBERS];
            }
        }
        
        if($model instanceof Category) {
        }
        
        if($model instanceof Product) {
        }
        
        $data_obj = $model::where($wheres)->orderBy('created_at', 'DESC');
        $data_count = $data_obj->get()->count();
        $data_list = $data_obj->paginate(Common::ROW_PER_PAGE);
        
        $paging = $data_list->toArray();
        
        if($request->ajax()) {
            $this->result['data'] = view($view, compact('data_list', 'data_count', 'paging', 'name'))->render();
            return response()->json($this->result);
        } else {
            return compact('data_list', 'data_count', 'paging', 'name');
        }
    }
    
    private function uploadLastLogin() {
        $dt = Carbon::createFromFormat('Y-m-d H:i:s',Auth::user()->last_login); //Tạo 1 datetime
        $now = Carbon::now();
        
        $diff = $now->diffInHours($dt);
        if($diff > 8) {
            $user = User::find(Auth::id());
            $user->last_login = date('Y-m-d H:i:s');
            $user->save();
        }
    }
    
}
