<?php

namespace App\Constants;

use App\Helpers\Utils;

class UploadPath {
    
    CONST UPLOAD = 'upload/';
    CONST ICO = 'web_ico/';
    CONST WEB_LOGO = 'web_logo/';
    CONST VENDOR_LOGO = 'vendor/';
    CONST BANNER = 'banner/';
    CONST PHOTO = 'photo/';
    CONST AVATAR = 'avatar/';
    CONST PRODUCT = 'image/';
    CONST WEB_BANNER = 'web_banner/';
    
    CONST PATH_LIST = [
        'upload_web_ico'    => self::ICO,
        'upload_web_logo'   => self::WEB_LOGO,
        'upload_logo'       => self::VENDOR_LOGO,
        'upload_banner'     => self::BANNER,
        'upload_photo'      => self::PHOTO,
        'upload_avatar'     => self::AVATAR,
        'upload_image'      => self::PRODUCT,
        'upload_web_banner' => self::WEB_BANNER
    ];
    
    public static function getUploadPath($key = '') {
        
        return self::UPLOAD . self::PATH_LIST[$key];
    }
    
    public static function getFilePath($key = '') {
        return self::PATH_LIST[$key];
    }
    
    public static function removeListPath() {
        $output = [];
        $pathList = self::PATH_LIST;
        foreach($pathList as $path) {
            $dirPath = self::UPLOAD . $path;
            Utils::deleteDir($dirPath);
        }
        
        return $output;
    }
}