<?php

namespace App\Http\Controllers;

use App\Constants\Common;
use App\Helpers\Utils;
use App\Helpers\Cart;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use View;
use Artesaos\SEOTools\Facades\TwitterCard;
use App\IpAddress;
class AppController extends Controller
{
    public $output = [];
    public $config = [];
    
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
        $this->middleware(function ($request, $next) {
            $this->output['cart'] = Cart::getInstance($request->getSession());
            return $next($request);
        });
        
        
        // Config
        $config = Utils::getConfig();

        if($config) {
            $web_logo = Utils::getImageLink($config->web_logo);
            $web_ico = Utils::getImageLink($config->web_ico);
            
            $banners_image_size = Utils::cnvNull($config->upload_banner_image_size, '100x100');
            $banners_demension = explode('x', $banners_image_size);
            
            $this->output = [
                'config' => [
                    'web_name' => Utils::cnvNull($config->web_title, 'E-shop'),
                    'web_description' => Utils::cnvNull($config->web_description, $config->web_title),
                    'web_keywords' => Utils::cnvNull($config->web_keywords, $config->web_title),
                    'web_logo' => $web_logo,
                    'web_ico' => $web_ico,
                    'mail_from' => Utils::cnvNull($config->mail_from, $config->web_email),
                    'mail_name' => Utils::cnvNull($config->mail_name, $config->web_title),
                    'web_email' => Utils::cnvNull($config->web_email, 'shopxeom90@gmail.com'),
                    'web_hotline' => Utils::cnvNull($config->web_hotline, ''),
                    'web_hotline_cskh' => Utils::cnvNull($config->web_hotline_cskh, ''),
                    'web_working_time' => Utils::cnvNull($config->web_working_time, ''),
                    'web_address' => Utils::cnvNull($config->web_address, ''),
                    'freeship' => Utils::cnvNull($config->freeship, ''),
                    'freeship_money' => Utils::cnvNull($config->freeship_money, ''),
                    'web_address_branch' => Utils::cnvNull($config->web_address_branch, ''),
                    'footer_text' => Utils::cnvNull($config->footer_text, ''),
                    'facebook_fanpage' => Utils::cnvNull($config->facebook_fanpage, ''),
                    'youtube_channel' => Utils::cnvNull($config->youtube_channel, ''),
                    'shopee_page' => Utils::cnvNull($config->shopee_page, ''),
                    'zalo_page' => Utils::cnvNull($config->zalo_page, ''),
                    'web_banner' => Utils::cnvNull($config->web_banner, ''),
//                     'banners_maximum_upload' => Utils::cnvNull($config->banners_maximum_upload, 51200),
//                     'vendors_maximum_upload' => Utils::cnvNull($config->vendors_maximum_upload, 51200),
//                     'products_maximum_upload' => Utils::cnvNull($config->products_maximum_upload, 51200),
//                     'posts_maximum_upload'   => Utils::cnvNull($config->post_maximum_upload, 51200),
//                     'web_logo_maximum_upload'   => Utils::cnvNull($config->web_logo_maximum_upload, 51200),
//                     'web_ico_maximum_upload'   => Utils::cnvNull($config->web_ico_maximum_upload, 51200),
//                     'users_maximum_upload'   => Utils::cnvNull($config->users_maximum_upload, 51200),
//                     'avatar_maximum_upload'   => Utils::cnvNull($config->users_maximum_upload, 51200),
//                     'attachment_maximum_upload'   => Utils::cnvNull($config->attachment_maximum_upload, 51200),
                    
                    'banners_width' => $banners_demension[0],
                    'banners_height' => $banners_demension[1],
//                     'vendors_image_size' => Utils::cnvNull($config->vendors_image_size, '100x100'),
//                     'products_image_size' => Utils::cnvNull($config->products_image_size, '100x100'),
//                     'posts_image_size'   => Utils::cnvNull($config->posts_image_size, '100x100'),
//                     'web_logo_image_size'   => Utils::cnvNull($config->web_logo_image_size, '100x100'),
//                     'web_ico_image_size'   => Utils::cnvNull($config->web_ico_image_size, '100x100'),
//                     'users_image_size'   => Utils::cnvNull($config->users_image_size, '100x100'),
//                     'avatar_image_size' => Utils::cnvNull($config->users_image_size, '100x100'),
                    'bank_info' => Utils::cnvNull($config->bank_info, ''),
                    'cash_info' => Utils::cnvNull($config->cash_info, ''),
                    'limit_product_show' => Utils::cnvNull($config->limit_product_show, 10),
                    'limit_product_show_tab' => Utils::cnvNull($config->limit_product_show_tab, 10),
                    'limit_post_show' => Utils::cnvNull($config->limit_post_show, 12),
                    'url_ext' => Utils::cnvNull($config->url_ext, '.html'),
                ],
            ];
            
            if($config->off == 1) {
                return abort(404);
            }
            
        }
    }
    
    protected function setSEO($data = []) {
        
        $title = isset($data['title']) && !Utils::blank($data['title']) ? $data['title'] : $this->output['config']['web_name'];
        $summary = isset($data['summary']) && !Utils::blank($data['summary']) ? $data['summary'] : $this->output['config']['web_description'];
        $section = isset($data['section']) && !Utils::blank($data['section']) ? $data['section'] : '';
        $keywords = isset($data['keywords']) && !Utils::blank($data['keywords']) ? $data['keywords'] : [$this->output['config']['web_keywords']];
        $link = isset($data['link']) && !Utils::blank($data['link']) ? $data['link'] : route('home');
        $type = isset($data['type']) && !Utils::blank($data['type']) ? $data['type'] : 'product';
        $image = isset($data['image']) && !Utils::blank($data['image']) && strpos($data['image'], Common::NO_IMAGE_FOUND) === FALSE  ? $data['image'] : Utils::getImageLink($this->output['config']['web_banner']);
        
        SEOMeta::setTitleDefault($title);
        SEOMeta::setTitle($this->output['config']['web_name']);
        SEOMeta::setDescription($summary);
        SEOMeta::addMeta('article:section', $section, 'property');
        SEOMeta::addKeyword($keywords);
        
        OpenGraph::setDescription($summary);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl($link);
        OpenGraph::addProperty('type', $type);
        OpenGraph::addImage(['url' => $image, 'size' => 720]);
        OpenGraph::addImage($image, ['height' => 720, 'width' => 480]);
        
    }
    
    
    protected function createErrorList($errors) {
        
        $html = '<ul>';
        foreach($errors as $err) {
            $html .= '<li><i class="fa fa-exclamation"></i> ' . $err[0] .'</li>';
        }
        $html .= '</ul>';
        return $html;
    }
    
    private function ipAddressAccess() {
        try {
            $ip = $_SERVER['REMOTE_ADDR'];
            $details = file_get_contents("http://ipinfo.io/{$ip}/json");
            $ipAddress = IpAddress::updateOrCreate(
                ['ip' => $ip],
                [
                    'ip' => $ip,
                    'location' => $details,
                    'created_at' => date('Y-m-d H:i:s')
                ]
            );
        } catch(\Exception $e) {
            
        }
    }
    
}
