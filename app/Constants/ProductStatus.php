<?php

namespace App\Constants;

use App\Helpers\Utils;

class ProductStatus {
    
    CONST OUT_OF_STOCK = 0;
    CONST AVAILABLE = 1;
    
    public static function getData($key = '') {
        $array = [
            self::OUT_OF_STOCK => trans('auth.status.out_of_stock'),
            self::AVAILABLE => trans('auth.status.available'),
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