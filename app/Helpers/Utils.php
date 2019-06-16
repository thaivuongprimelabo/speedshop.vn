<?php

namespace App\Helpers;

use App\Constants\BookingStatus;
use App\Constants\Common;
use App\Constants\ContactStatus;
use App\Constants\ProductType;
use App\Constants\Status;
use App\Constants\StatusOrders;
use App\Constants\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Image;
use App\Booking;
use App\Category;
use App\Config;
use App\Product;
use App\Vendor;
use Carbon\Carbon;
use App\PostGroups;
use App\Constants\ProductStatus;
use App\Times;
use App\Constants\UploadPath;
use Illuminate\Http\UploadedFile;

class Utils {
    
    public static function getImageLink($image = '') {
        
        $uploadFolder = UploadPath::UPLOAD;
        
        if(strpos($image, ',') !== FALSE) {
            $arrImage = explode(',', $image);
            $image = $arrImage[0];
        }
        
        if(strpos($image, 'https') !== FALSE || strpos($image, 'http') !== FALSE) {
            return $image;
        }
        
        if(!self::blank($image)) {
            
            if(!file_exists(public_path($uploadFolder . $image))) {
                return url($uploadFolder . Common::NO_IMAGE_FOUND);
            }
            
            return url($uploadFolder . $image);
        } else {
            return '';
        }
    }
    
    public static function doUploadSimple($request, $key, &$filename) {
        
        $file = null;
        
        if($request instanceof Request && $request->hasFile($key)) {
            $file = $request->$key;
        }
        
        if($request instanceof UploadedFile) {
            $file = $request;
        }
        
        if($file == null) {
            return $filename;
        }
        
        $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $filename = time() . '_' . str_random(10) . '.' . $ext;
        if($key == 'web_ico') {
            $filename = 'favicon.png';
        }
        
        $uploadPath = UploadPath::getUploadPath($key);
        $filePath = UploadPath::getFilePath($key, $filename);
        
        if($file->move(public_path($uploadPath), $filename)) {
            $filename = $filePath . $filename;
        }
    }
    
    public static function doUploadMultiple($request, $key, $id, &$arrFilenames = [], $is_main_file = '') {
        if($request->hasFile($key)) {
            $files = $request->$key;
            $upload_images = $request->upload_images;
            if(is_array($files)) {
                for($i = 0; $i < count($files); $i++) {
                    
                    $filename = '';
                    $file = $files[$i];
                    
                    if(is_null($upload_images)) {
                        break;
                    }
                    
                    if(!in_array($file->getClientOriginalName(), $upload_images)) {
                        continue;
                    }
                    
                    $medium = '';
                    $small = '';
                    $size = Config::select($key . '_image_size')->first();
                    if(strpos($size->upload_image_image_size, ',') !== FALSE) {
                        $products_sizes = explode(',', $size->upload_image_image_size);
                        $products_medium_size = $products_sizes[0];
                        $products_small_size = $products_sizes[1];
                        self::resizeImage($key, $file, $products_medium_size, $medium);
                        self::resizeImage($key, $file, $products_small_size, $small);
                    }
                    
                    self::doUploadSimple($file, $key, $filename);
                    
                    $image = [
                        'product_id' => $id,
                        'image' => $filename,
                        'medium' => $medium,
                        'small' => $small,
                        'is_main' => 0
                    ];
                    
                    if($is_main_file == $file->getClientOriginalName()) {
                        $image['is_main'] = 1;
                    }
                    array_push($arrFilenames, $image);
                }
            }
        }
    }
    
    public static function resizeImage($key, $file = null, $demension = null, &$filename = '') {
        
        if(!$file || $demension == null) {
            return;
        }
        
        $image_size = getimagesize($file->getRealPath());
        $image_width = isset($image_size[0]) ? $image_size[0] : 0;
        $image_height = isset($image_size[1]) ? $image_size[1] : 0;
        
        $d = explode('x', $demension);
        $image_width_resize = null;
        $image_height_resize = null;
        if(isset($d[0]) && !self::blank($d[0])) {
            $image_width_resize = $d[0];
        }
        
        if(isset($d[1]) && !self::blank($d[1])) {
            $image_height_resize = $d[1];
        }
        
        if($image_width < $image_width_resize) {
            $image_width_resize = $image_width;
        }
        
        if($image_height < $image_height_resize) {
            $image_height_resize = $image_height;
        }
        
        $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $filename = time() . '_' . str_random(10) . '.' . $ext;
        $uploadPath = UploadPath::getUploadPath($key);
        $resizePath = $uploadPath . $demension;
        $filePath = UploadPath::getFilePath($key) . $demension . '/' . $filename;
        
        $image_resize = Image::make($file->getRealPath());
//         $image_resize->resize($image_width_resize, $image_height_resize);
        $image_resize->resize($image_width_resize, $image_height_resize, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        
        if(!file_exists(public_path($uploadPath))) {
            mkdir(public_path($uploadPath));
        }
        
        if(!file_exists(public_path($resizePath))) {
            mkdir(public_path($resizePath));
        }
        
        if($image_resize->save(public_path($resizePath . '/' . $filename))) {
            $filename = $filePath;
        }
        
    }
    
    public static function removeFile($file) {
        if(!self::blank($file)) {
            $filepath = public_path(UploadPath::UPLOAD . $file);
            if(file_exists($filepath)) {
                unlink($filepath);
            }
        }
    }
    
    public static function formatMemory($memory, $number = false)
    {
        if(!$number) {
            if ($memory >= 1024 * 1024 * 1024) {
                return sprintf('%.1f GB', $memory / 1024 / 1024 / 1024);
            }
            
            if ($memory >= 1024 * 1024) {
                return sprintf('%.1f MB', $memory / 1024 / 1024);
            }
            
            if ($memory >= 1024) {
                return sprintf('%d KB', $memory / 1024);
            }
            
            return sprintf('%d B', $memory);
            
        } else {
            if ($memory >= 1024 * 1024 * 1024) {
                return sprintf('%.1f', $memory / 1024 / 1024 / 1024);
            }
            
            if ($memory >= 1024 * 1024) {
                return sprintf('%.1f', $memory / 1024 / 1024);
            }
            
            if ($memory >= 1024) {
                return sprintf('%d', $memory / 1024);
            }
            
            return sprintf('%d', $memory);
        }
        
        
    }
    
    public static function getValidateMessage($key, $param = '', $param2 = '') {
        
        if(!self::blank($param) && strpos($param, 'auth.') !== FALSE) {
            $param = str_replace('.text', '', $param);
            $param = $param . '.text';
        }
        
        if(!self::blank($param2) && strpos($param2, 'auth.') !== FALSE) {
            $param2 = str_replace('.text', '', $param2);
            $param2 = $param2 . '.text';
        }
        
        $message = trans($key);
        $message = str_replace(':size', trans($param2), $message);
        $message = str_replace(':max', trans($param2), $message);
        $message = str_replace(':attribute', trans($param), $message);
        $message = str_replace(':equal', trans($param2), $message);
        return $message;
    }
    
    public static function replaceMessageParam($key, $params = []) {
        $message = trans($key);
        for($i = 0; $i < count($params); $i++) {
            $message = str_replace('{' . $i . '}', $params[$i], $message);
        }
        return $message;
    }
        
    /**
     * Determine if the given value is "blank".
     *
     * @param  mixed  $value
     * @return bool
     */
    public static function blank($value)
    {
        if (is_null($value)) {
            return true;
        }
        
        if (is_string($value)) {
            return trim($value) === '';
        }
        
        if (is_numeric($value) || is_bool($value)) {
            return false;
        }
        
        return empty($value);
    }
    
    public static function cnvNull($value, $default = '') {
        if(self::blank($value)) {
            return $default;
        }
        return $value;
    }
    
    public static function createSelectList($table = '', $selected = '') {
        $html = '';
        $data = [];
        switch($table) {
            case 'CATEGORY_PARENT':
            case 'CATEGORY_PRODUCT':
                $categories = Category::select('name', 'id')->where('parent_id', 0)->where('status', Status::ACTIVE)->get();
                foreach($categories as $c) {
                    array_push($data, $c);
                    
                    $child = Category::select('name', 'id')->where('parent_id', $c->id)->where('status', Status::ACTIVE)->get();
                    foreach($child as $c1) {
                        $c1->name = '|---- ' . $c1->name;
                        array_push($data, $c1);
                        $child1 = Category::select('name', 'id')->where('parent_id', $c1->id)->where('status', Status::ACTIVE)->get();
                        foreach($child1 as $c2) {
                            $c2->name = '&nbsp;&nbsp;&nbsp;&nbsp;|---- ' . $c2->name;
                            $c2->disabled = true;
                            array_push($data, $c2);
                        }
                    }
                }
                break;
            case 'VENDOR_PRODUCT':
                $data = Vendor::select('name', 'id')->where('status', Status::ACTIVE)->get();
                break;
            case 'UPLOAD_SIZE_LIMIT':
                $uploadLimits = Common::UPLOAD_SIZE_LIMIT;
                foreach($uploadLimits as $limit) {
                    array_push($data,['id' => $limit, 'name' => self::formatMemory($limit)]);
                }
                break;
            case 'BANNER_TYPE':
                $bannerType = trans('auth.banner_type');
                foreach($bannerType as $key=>$value) {
                    array_push($data,['id' => $key, 'name' => $value['text']]);
                }
                break;
            case 'CONTACT_TYPE':
                return ContactStatus::createSelectList($selected);
                break;
            case 'STATUS_ORDERS':
                return StatusOrders::createSelectList($selected);
                break;
            case 'POST_GROUPS':
                $postGroups = PostGroups::select('id', 'name')->active()->where('parent_id', 0)->get();
                foreach($postGroups as $group) {
                    array_push($data, $group);
                    
                    $childGroups = $group->getChildGroup();
                    foreach($childGroups as $g) {
                        $g->name = '|---- ' . $g->name;
                        array_push($data, $g);
                    }
                }
                break;
            case 'POSTGROUPS_PARENT':
                $data = PostGroups::select('id', 'name')->active()->where('parent_id', 0)->get();
                break;
            case 'BOOKING_STATUS':
                return BookingStatus::createSelectList($selected);
                break;
            case 'ROLE_USERS':
                return UserRole::createSelectList($selected);
                break;
            default:
                $data = [];
                break;
        }
        
        foreach($data as $item) {
            $id = is_object($item) ? $item->id : $item['id'];
            $name = is_object($item) ? $item->name : $item['name'];
            $disabled = $table == 'CATEGORY_PARENT' && is_object($item) && isset($item->disabled) ? "disabled=disabled" : '';
            if($item)
            if($selected == $id) {
                $html .= '<option value="'. $id .'" selected>'. $name .'</option>';
            } else {
                $html .= '<option value="'. $id .'" ' . $disabled . '>'. $name .'</option>';
            }
        }
        
        return $html;
    }
    
    public static function createCheckboxList($table = '', $selected = '') {
        $html = '';
        $data = [];
        switch($table) {
            case Common::CATEGORIES:
                $data = Category::select('name', 'id')->where('parent_id', 0)->where('status', Status::ACTIVE)->get();
                break;
            case Common::VENDORS:
                $data = DB::table($table)->select('name', 'id')->where('status', Status::ACTIVE)->get();
                break;
            default:
                $data = [];
                break;
        }
        
        $selectedId = explode(',', $selected);
        
        foreach($data as $item) {
            if($table != Common::COLORS) {
                if(in_array($item->id, $selectedId)) {
                    $html .= '<label><input type="checkbox" name="'. $table . '[]" value="'. $item->id .'" checked="checked" /> '. $item->name .'</option></label>';
                } else {
                    $html .= '<label><input type="checkbox" name="'. $table . '[]" value="'. $item->id .'" /> '. $item->name .'</option></label>';
                }
            } else {
                if(in_array($item->id, $selectedId)) {
                    $html .= '<label><input type="checkbox" name="'. $table . '[]" value="'. $item->id .'" checked="checked" /><a href="#" style="display:inline-block; width:21px; height:21px; margin-left:5px; margin-bottom:-6px; background-color:'. $item->name .'"></a></label>';
                } else {
                    $html .= '<label><input type="checkbox" name="'. $table . '[]" value="'. $item->id .'" /><a href="#" style="display:inline-block; width:21px; height:21px; margin-left:5px; margin-bottom:-6px; background-color:'. $item->name .'"></a></label>';
                }
            }
        }
        
        return $html;
    }
    
    public static function createVendor() {
        $html = '<div class="manunew">';
        $vendors = Vendor::select('id', 'name', 'name_url', 'logo')->where('status', Status::ACTIVE)->get();
        $count = 1;
        foreach($vendors as $vendor) {
            $html .= '<a href="'. route('vendor', ['vendor' => $vendor->name_url]) .'"><img src="'. self::getImageLink($vendor->logo) .'" /></a>';
        }
        $html .= '</div>';
        return $html;
    }
    
    public static function createSidebar() {
        
        $arrUnaccess = [
            'users'
        ];
        
        $html = '';
        $routes = Route::getRoutes();
        $currentRoute = Route::currentRouteName();
        $open = '';
        $display = '';
        $sidebar = trans('auth.sidebar');
        $html .= '';
        
        $count = '<span class="pull-right-container">';
        $count .= '<small class="label pull-right bg-red">{count}</small>';
        $count .= '</span>';
        foreach($sidebar as $k=>$v) {
            $open = $display = '';
            $roleId = Auth::user()->role_id;
            
            if(!is_array($v)) {
                if($currentRoute == 'auth_' . $k) {
                    $html .= '<li class="active"><a href="' . route('auth_' . $k) . '"><i class="fa fa-files-o"></i><span>' . $v . '</span>';
                } else {
                    $html .= '<li><a href="' . route('auth_' . $k) . '"><i class="fa fa-files-o"></i><span>' . $v . '</span>';
                }
                
                if($k == 'orders' || $k == 'contacts') {
                    $cnt = DB::table($k)->where('status', StatusOrders::ORDER_NEW)->orWhere('status', ContactStatus::NEW_CONTACT)->count();
                    if($cnt) {
                        $count = str_replace('{count}', $cnt, $count);
                        $html .= $count;
                    }
                }
                
                $html .= '</a></li>';
            } else {
                
                $key = explode('_', $currentRoute);
                if(key_exists($key[1], $v) || $key[1] == $k) {
                    $open = 'menu-open';
                    $display = 'style="display: block;"';
                }
                $html .= '<li class="treeview ' . $open . '">';
                $html .= '<a href="javascript:void(0)"><i class="fa fa-files-o"></i><span>' . $v['title'] . '</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
                $html .= '<ul class="treeview-menu" ' . $display . '>';
                foreach($v as $kk=>$vv) {
                    if($routes->hasNamedRoute('auth_' . $kk)) {
                        if($currentRoute == 'auth_' . $kk) {
                            $html .= '<li><a href="' . route('auth_' . $kk) . '" style="color:#ffffff"><i class="fa fa-circle-o"></i> ' . $vv . '</a></li>';
                        } else {
                            $html .= '<li><a href="' . route('auth_' . $kk) . '"><i class="fa fa-circle-o"></i> ' . $vv . '</a></li>';
                        }
                    }
                }
                $html .= '</ul>';
                $html .= '</li>';
                
            }
            
        }
        
        return $html;
    }
    
    public static function getConfig() {
        
        $config = Config::first();
        return $config;
    }
    
    public static function setConfigMail() {
        
        $config = self::getConfig();
        if(!self::blank($config->mail_account)) {
            \Illuminate\Support\Facades\Config::set('mail.driver', $config->mail_driver);
            \Illuminate\Support\Facades\Config::set('mail.host', $config->mail_host);
            \Illuminate\Support\Facades\Config::set('mail.port', $config->mail_port);
            \Illuminate\Support\Facades\Config::set('mail.from.address', $config->mail_from);
            \Illuminate\Support\Facades\Config::set('mail.from.name', $config->mail_name);
            \Illuminate\Support\Facades\Config::set('mail.encryption', $config->mail_encryption);
            \Illuminate\Support\Facades\Config::set('mail.username', $config->mail_account);
            \Illuminate\Support\Facades\Config::set('mail.password', $config->mail_password);
        }
    }
    
    public static function sendMail($config_email = []) {
        
        $message = '';
        
        try {
            $from = isset($config_email['from'])?$config_email['from']: Common::FROM_MAIL;
            $from_name = isset($config_email['from_name'])?$config_email['from_name']: Common::FROM_NAME;
            $to = isset($config_email['to'])?$config_email['to']:'';
            $subject = isset($config_email['subject'])?$config_email['subject']: Common::SUBJECT;
            $msg = isset($config_email['msg'])?$config_email['msg']:'';
            $template = isset($config_email['template'])?$config_email['template']: Common::TEMPLATE;
            $cc = isset($config_email['cc'])?$config_email['cc']:null;
            $bcc = isset($config_email['bcc'])?$config_email['bcc']:null;
            $pathToFile = isset($config_email['pathToFile'])?$config_email['pathToFile']:null;
            
            Mail::send($template, $msg, function ($email) use ($from, $from_name, $to, $subject, $cc, $bcc, $pathToFile) {
                if ($from_name != '') {
                    $email->from($from, $from_name);
                } else {
                    $email->from($from, $from);
                }
                $email->to($to);
                if ($cc !== null) {
                    $email->cc($cc);
                }
                if ($bcc !== null) {
                    $email->bcc($bcc);
                }
                if ($pathToFile !== null) {
                    if(count($pathToFile)) {
                        foreach($pathToFile as $attach) {
                            $email->attach($attach);
                        }
                    }
                }
                $email->subject($subject);
            });
            
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        
        return $message;
    }
    
    public static function createMainNav() {
        $mainNav = trans('shop.main_nav');
        $html = '';
        foreach($mainNav as $key=>$nav) {
            if($key == Route::currentRouteName()) {
                $html .= '<li class="active"><a href="'. route($key) . '">'. $nav . ' </a></li>';
            } else {
                $html .= '<li><a href="'. route($key) . '">'. $nav . ' </a></li>';
            }
        }
        
        return $html;
    }
    
    public static function createNameUrl($str) {
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $kq = str_replace("'", "''", $str);
        
        return self::url_title(strtolower($kq));
    }
    
    private static function url_title($str, $separator = '-', $lowercase = FALSE)
    {
        if ($separator === 'dash')
        {
            $separator = '-';
        }
        elseif ($separator === 'underscore')
        {
            $separator = '_';
        }
        
        $q_separator = preg_quote($separator, '#');
        
        $trans = array(
            '&.+?;'			=> '',
            '[^\w\d _-]'		=> '',
            '\s+'			=> $separator,
            '('.$q_separator.')+'	=> $separator
        );
        
        $str = strip_tags($str);
        foreach ($trans as $key => $val)
        {
            $str = preg_replace('#'.$key.'#i'.(true ? 'u' : ''), $val, $str);
        }
        
        if ($lowercase === TRUE)
        {
            $str = strtolower($str);
        }
        
        return trim(trim($str, $separator));
    }
    
    public static function createFriendlyUrl($segment, $ext) {
        $url = implode('/', $segment) . $ext;
        return $url;
    }
    
    public static function getDiscountPrice($price, $discount) {
        return $price - ($price * ($discount / 100));
    }
    
    public static function deleteDir($dirPath) {
        
        if (! is_dir($dirPath)) {
            return true;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        return rmdir($dirPath);
    }
    
    public static function getYoutubeEmbedUrl($url)
    {
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
        
        if(isset($matches[1])) {
            $id = $matches[1];
            return 'https://www.youtube.com/embed/' . $id;
        }
        
        return null;
    }
    
    public static function getYoutubeVideoId($url)
    {
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
        
        if(isset($matches[1])) {
            $id = $matches[1];
            return $id;
        }
        
        return null;
    }
    
    public static function getYoutubeThumbnail($url)
    {
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
        
        if(isset($matches[1])) {
            $id = $matches[1];
            return 'http://img.youtube.com/vi/' . $id . '/0.jpg';
        }
        
        return null;
    }
    
    public static function formatCurrency($input) {
        if(is_numeric($input)) {
            return number_format($input, 0, ',', '.') . Common::CURRENCY;
        }
        return $input;
    }
    
    public static function generateList($config, $name, $data = null, $otherData = null, $key = '') {
        
        $html = '';
        
        $routes = Route::getRoutes();
        
        $table_info = trans('auth.' . $name . '.table_header');
        if(!self::blank($key)) {
            $table_info = trans('auth.' . $name . '.' . $key);
        }
        $data_count = $data->count();
        $footers = [];
        if(count($table_info)) {
            $colWidth = '<col width="3%">';
            $thead = '<thead><tr><th><input type="checkbox" id="select_all" /></th>';
            $number_col = 0;
            foreach($table_info as $key=>$info) {
                if(isset($info['tfoot'])) {
                    $footers[$key] = $info;
                    continue;
                }
                if(isset($info['hide'])) {
                    continue;
                }
                $colWidth .= '<col width="' . $info['width'] . '">';
                $thead .= '<th>' . $info['text'] . '</th>';
                $number_col++;
                
            }
            $thead .= '</thead></tr>';
            
            $tbody = '<tbody><tr align="center"><td colspan="' . $number_col . '">' . trans('auth.no_data_found') .'</td></tr>';
            if($data_count) {
                $tbody = '<tbody>';
                foreach($data as $item) {
                    $tbody .= '<tr>';
                    $tbody .= '<td><input type="checkbox" class="row-delete" value="' . $item->id .'" /></td>';
                    foreach($table_info as $key=>$info) {
                        if(isset($info['tfoot']) == 'tfoot') {
                            continue;
                        }
                        switch($key) {
                            case 'parent_cate':
                            case 'parent_postgroup':
                                $tbody .= '<td>' . $item->getParentName() . '</td>';
                                break;
                            case 'category':
                                $tbody .= '<td>' . $item->getCategoryName() . '</td>';
                                break;
                            case 'vendor':
                                $tbody .= '<td>' . $item->getVendorName() . '</td>';
                                break;
                            case 'banner':
                                if($item->select_type == 'use_image') {
                                    $tbody .= '<td><img src="' . self::getImageLink($item->$key) . '" style="max-width:150px;max-height:200px" class="img img-thumbnail" /></td>';
                                } else {
                                    $tbody .= '<td><img src="http://img.youtube.com/vi/' . $item->youtube_id . '/0.jpg"  style="max-width:150px;max-height:200px" class="img img-thumbnail" /></td>';
                                }
                                break;
                                
                            case 'logo':
                            case 'avatar':
                            case 'photo':
                                if(!self::blank($item->$key)) {
                                    $tbody .= '<td><img src="' . self::getImageLink($item->$key) . '" style="max-width:50px;max-height:200px" class="img img-thumbnail" /></td>';
                                } else {
                                    $tbody .= '<td></td>';
                                }
                                
                                break;
                                
                            case 'images':
                            case 'image':
                                $tbody .= '<td><img src="' . $item->getFirstImage('small') . '" style="max-width:50px;max-height:200px" class="img img-thumbnail" /></td>';
                                break;
                                
                            case 'status':
                                $label = '<span class="label label-danger">' . trans('auth.status.unactive') . '</span>';
                                if($item->status == Status::ACTIVE) {
                                    $label = '<span class="label label-success">' . trans('auth.status.active') . '</span>';
                                }
                                $tbody .= '<td><a href="javascript:void(0)" class="update-status" data-key="' . $name . '" data-id="' . $item->id . '" data-status="' . $item->status . '">' . $label . '</a></td>';
                                break;
                                
                            case 'product_status':
                                $label = '<span class="label label-success">' . trans('auth.status.active') . '</span>';
                                if($item->status == STATUS::UNACTIVE) {
                                    $label = '<span class="label label-danger">' . trans('auth.status.unactive') . '</span>';
                                }
                                $tbody .= '<td><a href="javascript:void(0)" class="update-status"  data-key="' . $name . '" data-id="' . $item->id . '" data-status="' . $item->status . '">' . $label . '</a></td>';
                                break;
                                
                            case 'product_avail_flg':
                                $label = '<span class="label label-success">' . trans('auth.status.available') . '</span>';
                                if($item->avail_flg == ProductStatus::OUT_OF_STOCK) {
                                    $label = '<span class="label label-danger">' . trans('auth.status.out_of_stock') . '</span>';
                                }
                                $tbody .= '<td><a href="javascript:void(0)" class="update-status" data-key="PRODUCT_AVAIL_FLG" data-id="' . $item->id . '" data-status="' . $item->avail_flg . '">' . $label . '</a></td>';
                                break;
                                
                            case 'role_id':
                                
                                $label = '<span class="label label-primary">' . trans('auth.role.super_admin') . '</span>';
                                
                                if($item->role_id == UserRole::ADMIN) {
                                    $label = '<span class="label label-warning">' . trans('auth.role.admin') . '</span>';
                                }
                                
                                if($item->role_id == UserRole::MOD) {
                                    $label = '<span class="label label-warning">' . trans('auth.role.mod') . '</span>';
                                }
                                
                                if($item->role_id == UserRole::MEMBERS) {
                                    $label = '<span class="label label-default">' . trans('auth.role.member') . '</span>';
                                }
                                
                                $tbody .= '<td><a href="javascript:void(0)">' . $label . '</a></td>';
                                break;
                                
                            case 'price':
                            case 'cost':
                                $tbody .= '<td>' . self::formatCurrency($item->$key) . '</td>';
                                break;
                                
                            case 'created_at':
                            case 'updated_at':
                            case 'published_at':
                            case 'last_login':
                                $date = self::formatDate($item->$key);
                                $tbody .= '<td>' . $date . '</td>';
                                break;
                            case 'order_status':
                                $label = '<span class="label label-primary">' . trans('auth.status.order_new') . '</span>';
                                if($item->status == StatusOrders::ORDER_SHIPPING) {
                                    $label = '<span class="label label-warning">' . trans('auth.status.order_shipping') . '</span>';
                                }
                                if($item->status == StatusOrders::ORDER_DONE) {
                                    $label = '<span class="label label-success">' . trans('auth.status.order_done') . '</span>';
                                }
                                if($item->status == StatusOrders::ORDER_CANCEL) {
                                    $label = '<span class="label label-danger">' . trans('auth.status.order_cancel') . '</span>';
                                }
                                
                                $tbody .= '<td>' . $label . '</td>';
                                break;
                            
                            case 'contact_status':
                                $label = '<span class="label label-primary">' . trans('auth.status.new') . '</span>';
                                if($item->status == Status::ACTIVE) {
                                    $label = '<span class="label label-success">' . trans('auth.status.replied') . '</span>';
                                }
                                $tbody .= '<td><a href="javascript:void(0)" class="update-status" data-id="' . $item->id . '" data-status="' . $item->status . '">' . $label . '</a></td>';
                                break;
                                
                            case 'edit_action':
                                if(isset($info['hide'])) {
                                    continue;
                                }
                                
                                $route = 'auth_' . $name . '_edit';
                                if($routes->hasNamedRoute($route)) {
                                    $url = route('auth_' . $name . '_edit',['id' => $item->id]);
                                    $tbody .= '<td align="center"><a href="javascript:void(0)" data-url="' . $url . '" class="edit" title="Edit"><i class="fa fa-edit" aria-hidden="true" style="font-size: 24px"></i></a></td>';
                                } else {
                                    $tbody .= '<td></td>';
                                }
                                break;
                                
                            case 'remove_action':
                                if(isset($info['hide'])) {
                                    continue;
                                }
                                
                                $route = 'auth_' . $name . '_remove';
                                if($routes->hasNamedRoute($route)) {
                                    $url = route('auth_' . $name . '_remove');
                                    $tbody .= '<td align="center"><a href="javascript:void(0)" data-id="' . $item->id . '" data-url="' . $url . '" class="remove-row" title="Remove"><i class="fa fa-trash" aria-hidden="true" style="font-size: 24px"></i></a></td>';
                                } else {
                                    $tbody .= '<td></td>';
                                }
                                
                                break;
                                
                            default:
                                $tbody .= '<td>' . $item->$key . '</td>';
                                break;
                        }
                        
                    }
                    
                    $tbody .= '</tr>';
                }
            }
            
            $tbody .= '</tbody>';
            $tfoot = '';
            if(count($footers)) {
                $tfoot = '<tfoot>';
                foreach($footers as $key=>$foot) {
                    $tfoot .= '<tr><th class="empty" colspan="' . $foot['colspan'] . '"></th><th>' . $foot['text'] . '</th><th class="sub-total"> ' . self::formatCurrency($otherData->$key) . '</th></tr>';
                }
                $tfoot .= '</tfoot>';
            }
        }
        $html .= '<div class="table-responsive">';
        $html .= '<table class="table table-hover" style="word-wrap:break-word;">';
        $html .= $colWidth;
        $html .= $thead;
        
        $html .= $tbody;
        $html .= $tfoot;
        $html .= '</table>';
        $html .= '</div>';
        
        return $html;
    }
    
    public static function generateForm($config, $name, $data = null, $forms = null) {
        $auth_name = trans('auth.' . $name);
        if($forms == null) {
            
            if(isset($auth_name['form'])) {
                $auth_form = $auth_name['form'];
                if(isset($auth_form['many_form'])) {
                    $multi_form_html = '';
                    foreach($auth_form as $key=>$forms) {
                        if(Auth::user()->role_id == UserRole::ADMIN && ($key == 'mail_settings' || $key == 'upload_settings')) {
                            continue;
                        }
                        if($key == 'many_form') {
                            continue;
                        }
                        $multi_form_html .= self::generateForm($config, $name, $data, $forms);
                    }
                    $multi_form_html .= view('auth.common.button_footer',['name' => $name, 'back_url' => route('auth_' . $name)])->render();
                    return $multi_form_html;
                } else {
                    $forms = $auth_form;
                }
            }
        }
        
        $tabForm = isset($auth_name['tab_form']) ? $auth_name['tab_form'] : false;
        $id = isset($data->id) ? $data->id : 0;
        $form_html = '';
        
        $header = '<div class="box-header with-border">';
        if(isset($forms['header'])) {
            $header .= '<h3 class="box-title">' . $forms['header'] . '</h3>';
        } else {
            if($id > 0) {
                $header .= '<h3 class="box-title">' . trans('auth.edit_box_title') . '</h3>';
            } else {
                $header .= '<h3 class="box-title">' . trans('auth.create_box_title') . '</h3>';
            }
        }
        $header .= '</div>';
        
        
        if($tabForm) {
            $acceptAdmin = [
                'tab_form_2'
            ];
            
            $form_html .= '<input type="hidden" name="id" id="id_check" value="' . $id . '" />';
            $form_html = '';
            $form_html .= '<div class="nav-tabs-custom">';
            $form_html .= '<ul class="nav nav-tabs">';
            
            foreach($tabForm as $id=>$form) {
                if($name == 'config' && Auth::user()->role_id == UserRole::ADMIN && in_array($id, $acceptAdmin)) {
                    continue;
                }
                $form_html .= '<li class="' . ($id == 'tab_form_1' ? 'active' : '') . '">';
                $form_html .= '<a href="#' . $id . '" data-toggle="tab" aria-expanded="true"> '. $form['title'];
                $form_html .= '</a>';
                $form_html .= '</li>';
            }
            
            $form_html .= '</ul>';
            $form_html .= '<div class="tab-content">';
            foreach($tabForm as $id=>$form) {
                if(isset($form['view'])) {
                    $body = view($form['view'],['data' => $data])->render();
                } else {
                    $body = '';
                    foreach($form as $key=>$value) {
                        $body .= self::createElement($key, $value, $config, $name, $data);
                    }
                }
                
                $form_html .= '<div class="tab-pane ' . ($id == 'tab_form_1' ? 'active' : '') . '" id="' . $id . '">';
                $form_html .= $body;
                $form_html .= '</div>';
            }
            
            $form_html .= view('auth.common.button_footer',['name' => $name, 'back_url' => route('auth_' . $name), 'data' => $data])->render();
            
        } else {
            $body = '<div class="box-body">';
            foreach($forms as $key=>$value) {
                $body .= self::createElement($key, $value, $config, $name, $data);
            }
            $body .= '</div>';
            
            $form_html = '<div class="box box-primary">';
            $form_html .= $header;
            $form_html .= '<input type="hidden" name="id" id="id_check" value="' . $id . '" />';
            $form_html .= $body;
            if(!isset($auth_name['form']['many_form'])) {
                $form_html .= view('auth.common.button_footer',['name' => $name, 'back_url' => route('auth_' . $name), 'data' => $data])->render();
            }
            $form_html .= '</div>';
        }
        
        return $form_html;
    }
    
    private static function createElement($key = '', $value = '', $config, $name, $data = null) {
        
        $text = isset($value['text']) ? $value['text'] : '';
        $placeholder = isset($value['placeholder']) ? $value['placeholder'] : $text;
        $maxlengthValue = isset($value['maxlength']) ? $value['maxlength'] : '';
        $maxlength = '';
        $lengthText = '';
        if(!self::blank($maxlengthValue)) {
            $maxlength = 'maxlength=' .$maxlengthValue;
            $lengthText = str_replace('{0}', $maxlengthValue, trans('auth.length_text'));
        }
        $table = isset($value['table']) ? $value['table'] : '';
        $emptyText = isset($value['empty_text']) ? $value['empty_text'] : '';
        $containerId = isset($value['container_id']) ? $value['container_id'] : '';
        
        if(!Utils::blank($containerId)) {
            if($data != null) {
                $select_type = $data->select_type;
                if($containerId != $select_type) {
                    $containerId = 'select_type ' . $containerId . ' hide_element';
                } else {
                    $containerId = 'select_type ' . $containerId;
                }
            } else {
                $banner_type = trans('auth.banner_type');
                if(!$banner_type[$containerId]['checked']) {
                    $containerId = 'select_type ' . $containerId . ' hide_element';
                } else {
                    $containerId = 'select_type ' . $containerId;
                }
            }
        }
        
        $disable = isset($value['disabled']) ? 'disabled=true' : '';
        $label = '<label>' . $text . '<small>' . $lengthText . '</small></label>';
        $element_value = !is_null($data) && !Utils::blank($data->$key) ? $data->$key : '';
        
        $element_html = '<div class="form-group ' . $containerId . '">';
        $type = isset($value['type']) ? $value['type'] : '';
        $count = isset($value['count']) ? $value['count'] : 0;
        
        switch($type) {
            case 'radio_list':
                
                $element_html = '<div class="radio">';
                
                $radio_values = $value['value'];
                foreach($radio_values as $k=>$v) {
                    
                    $element_html .= '<label>';
                    $element_html .= '<input type="radio" class="' . $key . '" name="' . $key . '" value="' . $k . '" ' . ($v['checked'] || $k == $element_value ? 'checked="checked"' : '') . ' /> ' . $v['text'];
                    $element_html .= '</label>';
                    
                }
                
                break;
                
            case 'youtube_preview':
                
                $element_html .= $label;
                $element_html .= '<div id="youtube_preview">';
                if(!is_null($data) && !Utils::blank($data->youtube_id)) {
                    $element_html .= '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $data->youtube_id . '" frameborder="0" allowfullscreen></iframe>';
                }
                $element_html .= '</div>';
                $element_html .= '<input type="hidden" name="youtube_embed_url" id="youtube_embed_url" value="" />';
                
                break;
                
            case 'textarea':
                
                $element_html .= $label;
                $element_html .= '<div>';
                $element_html .= '<textarea class="form-control" rows="6" name="' . $key . '" placeholder="' . $placeholder . '" ' . $maxlength . ' '. $disable . '>' . $element_value . '</textarea>';
                $element_html .= '<input type="hidden" name="youtube_embed_url" id="youtube_embed_url" value="" />';
                $element_html .= '</div>';
                break;
                
            case 'text':
                
                if($key == 'youtube_id') {
                    $element_value = !Utils::blank($element_value) ? 'https://www.youtube.com/watch?v=' . $element_value : '';
                }
                
                if($key == 'price') {
                    $element_html .= $label;
                    $element_html .= '<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>';
                    $element_html .= '<input type="text" class="form-control" name="' . $key . '" id="' . $key . '" value="' . $element_value . '" placeholder="' . $placeholder . '" ' . $maxlength . ' '. $disable . ' />';
                    
                    if(!self::blank($element_value)) {
                        $element_value = self::formatCurrency($element_value);
                    }
                    $element_html .= '</div>';
                    $element_html .= '<span id="format_currency"><strong><small>Định dạng tiền tệ: <i>' . $element_value . '</i></small></strong></span>';
                } else {
                    $element_html .= $label;
                    $element_html .= '<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>';
                    $element_html .= '<input type="text" class="form-control" name="' . $key . '" id="' . $key . '" value="' . $element_value . '" placeholder="' . $placeholder . '" ' . $maxlength . ' '. $disable . ' />';
                    $element_html .= '</div>';
                }
                
                break;
            case 'link_to_post':
                $element_html .= $label;
                $element_html .= '<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>';
                $element_html .= '<input type="text" class="form-control" name="' . $key . '" id="' . $key . '" value="' . $element_value . '" placeholder="' . $placeholder . '" ' . $maxlength . ' '. $disable . ' />';
                $element_html .= '<div class="input-group-btn">';
                $element_html .= '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#selectPostModal"><i class="fa fa-link fa-fw"></i> URL bài viết</button>';
                $element_html .= '</div>'; 
                $element_html .= '</div>';
                break;
                
            case 'address':
            case 'hotline':
                $element_html .= $label;
                $element_html .= '<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>';
                $element = explode('|', $element_value);
                if(count($element)) {
                    foreach($element as $el) {
                        $element_html .= '<input type="text" class="form-control" name="' . $key . '[]" value="' . $el . '" placeholder="' . $placeholder . '" ' . $maxlength . ' '. $disable . ' />';
                    }
                } else {
                    $element_html .= '<input type="text" class="form-control" name="' . $key . '[]" value="" placeholder="' . $placeholder . '" ' . $maxlength . ' '. $disable . ' />';
                }
                
                $element_html .= '</div>';
                $element_html .= '<button type="button" class="btn btn-danger add-info mt-1"><i class="fa fa-plus"></i> Thêm</button>';
                break;
                
            case 'currency':
                
                $element_html .= $label;
                $element_html .= '<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>';
                $element_html .= '<input type="number" class="form-control" name="' . $key . '" id="' . $key . '" value="' . $element_value . '" placeholder="' . $placeholder . '" ' . $maxlength . ' '. $disable . ' />';
                
                if(!self::blank($element_value)) {
                    $element_value = self::formatCurrency($element_value);
                }
                $element_html .= '</div>';
                $element_html .= '<span id="format_currency"><strong><small>Định dạng tiền tệ: <i>' . $element_value . '</i></small></strong></span>';
                
                break;
                
            case 'number':
                
                $element_html .= $label;
                $element_html .= '<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>';
                $element_html .= '<input type="number" class="form-control" name="' . $key . '" id="' . $key . '" value="' . $element_value . '" placeholder="' . $placeholder . '" ' . $maxlength . ' '. $disable . ' />';
                $element_html .= '</div>';
                break;
            
            case 'discount':
                
                $element_html .= $label;
                $element_html .= '<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>';
                $element_html .= '<input type="number" class="form-control" name="' . $key . '" id="' . $key . '" value="' . $element_value . '" placeholder="' . $placeholder . '" ' . $maxlength . ' '. $disable . ' max="100" />';
                $element_html .= '</div>';
                $discount_value = '';
                if(!self::blank($element_value) && $element_value > 0) {
                    $discount_value = self::formatCurrency($data->price - ($data->price * ($element_value / 100)));
                }
                $element_html .= '<span id="format_discount"><strong><small>Giá sau khi giảm: <i>' . $discount_value . '</i></small></strong></span>';
                break;
            case 'email':
                
                $element_html .= $label;
                $element_html .= '<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>';
                $element_html .= '<input type="email" class="form-control" name="' . $key . '" id="' . $key . '" value="' . $element_value . '" placeholder="' . $placeholder . '" ' . $maxlength . ' '. $disable . ' />';
                $element_html .= '</div>';
                break;
                
            case 'password':
                
                $element_html .= $label;
                $element_html .= '<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>';
                $element_html .= '<input type="password" class="form-control" name="' . $key . '" id="' . $key . '" value="" placeholder="' . $placeholder . '" ' . $maxlength . ' '. $disable . ' />';
                $element_html .= '</div>';
                break;
                
            case 'checkbox':
                
                $checked = 'checked="checked"';
                
                $element_html .= '<div class="checkbox">';
                
                if(isset($value['checked']) && !$value['checked']) {
                    $checked = '';
                }
                
                if(!self::blank($element_value) && !$element_value) {
                    $checked = '';
                }
                
                $valueCheckbox = isset($value['value']) ? $value['value'] : 1;
                
                $element_html .= '<label><input type="checkbox" name="' . $key . '" value="' . $valueCheckbox . '" ' . $checked . ' />&nbsp;&nbsp;&nbsp;' . $text . '</label>';
                
                $element_html .= '</div>';
                break;
                
            case 'checkbox_multi':
                
                $element_html .= '<label>' .$text . '</label>';
                $element_html .= '<div class="checkbox">';
                $element_html .= '<label>' . self::createCheckboxList($table, $element_value) . '</label>';
                $element_html .= '</div>';
                break;
                
            case 'checkbox_color_multi':
                
                $element_html .= '<label>' .$text . '</label>';
                $element_html .= '<div class="checkbox">';
                $element_html .= '<label>' . self::createCheckboxList($table, $element_value) . '</label>';
                $element_html .= '</div>';
                break;
                
            case 'label':
                
                if($key == 'payment_method') {
                    $payment_methods = trans('auth.payment_methods');
                    $element_value = $payment_methods[$element_value];
                }
                
                if($key == 'created_at') {
                    $element_value = self::formatDate($element_value);
                }
                
                $element_html .= '<label>' .$text . '</label>&nbsp;&nbsp;&nbsp;';
                $element_html .= '<span>' . $element_value . '</span>';
                break;
                
            case 'link':
                
                $element_html .= '<label>' .$text . '</label>';
                $element_html .= '<a href="mailto:' . $element_value . '">' . $element_value . '</a>';
                break;
                
            case 'file_simple':
                $key_data = str_replace('upload_', '', $key);
                $element_value = !is_null($data) && !Utils::blank($data->$key_data) ? $data->$key_data : '';
                $image_size = isset($config[$key . '_image_size']) ? $config[$key . '_image_size'] : '100x100';
                $limit_upload = isset($config[$key . '_maximum_upload']) ? $config[$key . '_maximum_upload'] : '51200';
                
                if($key == 'upload_web_ico') {
                    $image_size = '40x40';
                }
                
                $split = explode('x', $image_size);
                $element_html .= $label . trans('auth.text_image_small',['limit_upload' => self::formatMemory($limit_upload)]);
                $preview_control_id = 'preview_' . $key;
                $element_html .= '<div>';
                $element_html .= '<input type="file" class="form-control upload-simple" name="' . $key . '" data-preview-control="' . $preview_control_id . '" data-limit-upload="' . $limit_upload . '" />';
                $style = 'width: ' . $split[0] . 'px;height: ' . $split[1] . 'px';
                $element_html .= '<div class="preview_area" style="' . $style . ';position:relative">';
                $element_html .= '<span class="spinner_preview" style="display:none"><i class="fa fa-circle-o-notch fa-spin"></i> ' . trans('auth.upload_check_txt') . '</span>';
                if(!self::blank($element_value)) {
                    $element_html .= '<a href="javascript:void(0)" class="remove-img-simple" style="position:absolute; top:15px; right:-18px"><i class="fa fa-trash" style="font-size:18px;"></i></a>';
                    $element_html .= '<img id="' . $preview_control_id . '" src="' . self::getImageLink($element_value) . '" class="img-thumbnail" style="margin-top:10px;' . $style . '">';
                } else {
                    $element_html .= '<img id="' . $preview_control_id . '" src="' . self::getImageLink(Common::NO_IMAGE_FOUND) . '" class="img-thumbnail" style="margin-top:10px;' . $style . ';">';
                }
                $element_html .= '<input type="hidden" class="filename_hidden" name="' . $key_data . '_hidden" value="' . $element_value . '" />';
                $element_html .= '</div>';
                $element_html .= '</div>';
                break;
                
            case 'file_multiple':
                $key_data = str_replace('upload_', '', $key);
                $element_value = !is_null($data) && !Utils::blank($data->$key_data) ? $data->$key_data : '';
                $image_size = isset($config[$key . '_image_size']) ? $config[$key . '_image_size'] : '100x100';
                $limit_upload = isset($config[$key . '_maximum_upload']) ? $config[$key . '_maximum_upload'] : '51200';
                if(strpos($image_size, ',') !== FALSE) {
                    $split = explode(',', $image_size);
                    $split = explode('x', $split[0]);
                } else {
                    $split = explode('x', $image_size);
                }
                $element_html .= '<button type="button" id="upload_button" data-name="' . $key . '[]" data-preview-control="preview_list" data-limit-upload="' . $limit_upload . '" class="btn btn-primary"><i class="fa fa-image"></i> Tải hình sản phẩm</button>';
                $element_html .= trans('auth.text_image_small',['limit_upload' => self::formatMemory($limit_upload)]);
                $preview_control_id = 'preview_' . $key;
                $element_html .= '<div id="preview_list" class="preview_area">';
                $element_html .= '<span class="spinner_preview" style="display:none"><i class="fa fa-circle-o-notch fa-spin"></i> ' . trans('auth.upload_check_txt') . '</span>';
                $image_using = !is_null($data) ? $data->getAllImage($data->id) : [];
                if(count($image_using)) {
                    foreach($image_using as $image) {
                        $element_html .= '<div class="img-wrapper" data-filename=' . $image->id . ' style="display:inline-block; position:relative">';
                        if($image->is_main) {
                            $element_html .= '<i class="fa fa-check" aria-hidden="true" style="position:absolute; top:15px; left:15px; font-size:24px; color:#31a231"></i>';
                        }
                        $element_html .= '<a href="javascript:void(0)" class="remove-img" style="position:absolute; top:15px; right:15px" data-id="' . $image->id . '"><i class="fa fa-trash" style="font-size:24px;"></i></a>';
                        $element_html .= '<img src="' . Utils::getImageLink($image->image) . '" class="img-thumbnail" style="max-width:110px; max-height:150px;margin-top:10px; margin-right:5px">';
                        $element_html .= '</div>';
                    }
                }
                $element_html .= '</div>';
                $element_html .= '<input type="hidden" id="is_main" name="is_main" value="" />';
                $element_html .= '<input type="hidden" id="file_selected" />';
                break;
                
            case 'select':
                $element_html .= '<div>';
                $element_html .= '<label>' .$text . '</label>';
                $element_html .= '<select class="form-control" name="' . $key . '" id="' . $key . '">';
                if(!self::blank($emptyText)) {
                    $element_html .= '<option value="">' . $emptyText . '</option>';
                }
                $element_html .= self::createSelectList($table, $element_value);
                $element_html .= '</select>';
                $element_html .= '</div>';
                break;
                
            case 'editor':
                $editor_type = isset($value['editor']) ? $value['editor'] : 'small';
                $editor_height = isset($value['height']) ? $value['height'] : '200';
                $element_html .= '<div>';
                $element_html .= '<label>' .$text . '</label>';
                $element_html .= '<textarea name="' . $key . '" id="' . $key . '" class="fckeditor" data-height="' . $editor_height . '" data-editor="' . $editor_type . '" placeholder="' . $placeholder . '">' . $element_value . '</textarea>';
                $element_html .= '</div>';
                break;
                
        }
        $element_html .= '<span class="help-block"></span>';
        $element_html .= '</div>';
        return $element_html;
    }
    
    public static function formatDate($input) {
        $result="";
        try {
            $result = Carbon::createFromFormat('Y-m-d H:i:s', $input)->format('d-m-Y H:i:s');
        } catch (\Exception $e) {
            $result="";
        }
        return $result;
    }
    
    public static function generateValidation($name, $input_rules = [], $data = []) {
        
        $result = [
            'rules' => [],
            'messages' => []
        ];
        $rules = [];
        $messages = [];
        if(!is_array($input_rules)) {
            return json_encode($result);
        }
        
        foreach($input_rules as $k=>$v) {
            $rules[$k] = [];
            $messages[$k] = [];
            $exp = explode('|', $v);
            foreach($exp as $kk=>$vv) {
                
                $exp1 = explode(':', $vv);
                $rule_name = '';
                $rule_check = '';
                if(isset($exp1[1])) {
                    $rule_name = $exp1[0];
                    $rule_check = $exp1[1];
                } else {
                    $rule_name = $vv;
                    $rule_check = true;
                }
                
                $msg_item = '';
                $auth_name = trans('auth.' . $name);
                if(isset($auth_name['tab_form'])) {
                    foreach($auth_name['tab_form'] as $tab) {
                        foreach($tab as $kk=>$vv) {
                            if($kk == $k) {
                                $item_name = $vv['text'];
                                break;
                            }
                        }
                    }
                } else {
                    $item_name = $auth_name['form'][$k]['text'];
                }
                $value_compare = '';
                switch($rule_name) {
                    case 'required':
                        $msg_item = 'validation.required';
                        if($k == 'content' || $k == 'reply_content') {
                            $rule_name = 'required_ckeditor';
                        }
                        if($k == 'role_id' || $k == 'category_id' || $k == 'post_group_id' || $k == 'upload_banner') {
                            $msg_item = 'validation.required_select';
                        }
                        break;
                    case 'email':
                        $msg_item = 'validation.email';
                        break;
                    case 'max':
                        $rule_name = 'maxlength';
                        $msg_item = 'validation.max.string';
                        $value_compare = $rule_check;
                        break;
                    case 'min':
                        $rule_name = 'minlength';
                        $msg_item = 'validation.min.string';
                        $value_compare = $rule_check;
                        break;
                    case 'url':
                        $msg_item = 'validation.url';
                        $value_compare = $rule_check;
                        break;
                    case 'same':
                        $rule_name = 'equalTo';
                        $msg_item = 'validation.confirmed';
                        $value_compare = 'auth.' . $name . '.form.' . $rule_check;
                        $rule_check = '#' . $rule_check;
                        break;
                    default:
                        
                        break;
                }
                
                if(!($data != null && $data->count() > 0 && ($k == 'password' || $k == 'conf_password'))) {
                    $rules[$k][$rule_name] = $rule_check;
                    $messages[$k][$rule_name] = self::getValidateMessage($msg_item, $item_name, $value_compare);
                }
            }
            
        }
        
        $result['rules'] = $rules;
        $result['messages'] = $messages;
        
        return json_encode($result);
    }
    
    /*============================== Shop ============================*/
    public static function createNavigation($postition = 'web') {
        $mainNav = trans('shop.main_nav');
        $html = '';
        
        $categories = Category::select('id', 'name', 'name_url')->active()->where('parent_id', 0)->get();
        $postGroups = PostGroups::select('id', 'name', 'name_url')->active()->get();
        
        if($postition == 'web') {
            $html .= view('shop.common.top_nav', compact('categories', 'postGroups'))->render();
        }
        
        if($postition == 'mobile') {
            $html .= view('shop.common.top_nav_mobile', compact('categories', 'postGroups'))->render();
        }
        
        if($postition == 'sub_footer') {
            $html .= '<ul class="list-menu list-blogs">';
            $routes = Route::getRoutes();
            foreach($mainNav as $route=>$nav) {
                $html .= '<li><a href="' . route($route) . '">' . $nav['text'] . '</a></li>';
            }
            $html .= '</ul>';
        }
        
        if($postition == 'footer') {
            $html .= '<ul class="list-menu-footer">';
            $routes = Route::getRoutes();
            foreach($mainNav as $route=>$nav) {
                $html .= '<li><a href="' . route($route) . '">' . $nav['text'] . '</a></li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }
    
    public static function createSidebarShop($position = 'category_list') {
        $html = '';
        if($position == 'category_list') {
            $categories = Category::select('id', 'name', 'name_url', 'parent_id')->where('status', Status::ACTIVE)->where('parent_id', 0)->get();
            $html .= view('shop.common.category_list',compact('categories'))->render();
        }
        
        if($position == 'postgroups_list') {
            $postGroups = PostGroups::select('id', 'name', 'name_url')->active()->get();
            $html .= view('shop.common.postgroups_list',compact('postGroups'))->render();
        }
        
        if($position == 'price_search') {
            $html .= view('shop.common.price_search')->render();
        }
        
        if($position == 'popular_products') {
            $products = Product::where('status', Status::ACTIVE)->where('is_popular', ProductType::IS_POPULAR)->paginate(Common::LIMIT_PRODUCT_SHOW_SIDEBAR);
            $html .= view('shop.common.popular_products', compact('products'))->render();
        }
        return $html;
        
    }
    
    public static function createProductTab($title, $type = '', $limit_product = Common::LIMIT_PRODUCT_SHOW_TAB) {
        $html = '';
        $categories = Category::select('id', 'name', 'name_url')->active()->where('parent_id', 0)->get();
        
        
        $route = '';
        $where = [];
        if($type == ProductType::IS_NEW) {
            $route = route('newProducts');
            $where['is_new'] = ProductType::IS_NEW;
        }
        if($type == ProductType::IS_BEST_SELLING) {
            $route = route('bestSellProducts');
            $where['is_best_selling'] = ProductType::IS_BEST_SELLING;
        }
        if($type == ProductType::IS_POPULAR) {
            $route = route('popularProducts');
            $where['is_popular'] = ProductType::IS_POPULAR;
        }
        
        $all_products = Product::active()->where($where)->orderBy('updated_at', 'DESC')->limit($limit_product)->get();
        
        $html .= view('shop.common.product', compact('categories', 'title', 'type', 'route', 'all_products', 'limit_product'))->render();
        return $html;
    }
    
    public static function createVendorSection() {
        $vendors = Vendor::active()->get();
        $html = view('shop.common.vendors', compact('vendors'))->render();
        return $html;
    }
}