<?php

namespace App\Constants;

use App\Helpers\Utils;

class ProductType {
    
    CONST IS_NEW = 1;
    CONST IS_POPULAR = 2;
    CONST IS_BEST_SELLING = 3;
    CONST IS_DETAIL_ITEM = 4;
    
    public static function getData($key = '') {
        $array = [
            self::IS_NEW => trans('auth.products.form.is_new.text'),
            self::IS_POPULAR => trans('auth.products.form.is_popular.text'),
            self::IS_BEST_SELLING => trans('auth.products.form.is_best_selling.text'),
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
            if($key == $selected) {
                $html .= '<option value="'. $key.'" selected>'. $value .'</option>';
            } else {
                $html .= '<option value="'. $key.'">'. $value .'</option>';
            }
        }
        return $html;
    }
    
}