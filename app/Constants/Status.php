<?php

namespace App\Constants;

use App\Helpers\Utils;

class Status {
    
    CONST UNACTIVE = 0;
    CONST ACTIVE = 1;
    CONST IS_NEW = 1;
    CONST IS_POPULAR = 1;
    CONST IS_BEST_SELLING = 1;
    
    public static function getData($key = '') {
        $array = [
            self::UNACTIVE => trans('auth.status.unactive'),
            self::ACTIVE => trans('auth.status.active'),
        ];
        
        if(!Utils::blank($key)) {
            return $array[$key];
        }
        
        return $array;
    }
    
    public static function createSelectList($selected = '') {
        $data = self::getData();
        $html = '';
        foreach($data as $key=>$value) {
            if(!Utils::blank($selected) && $key == $selected) {
                $html .= '<option value="'. $key.'" selected>'. $value .'</option>';
            } else {
                $html .= '<option value="'. $key.'">'. $value .'</option>';
            }
        }
        return $html;
    }
    
}