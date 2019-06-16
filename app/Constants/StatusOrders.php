<?php

namespace App\Constants;

use App\Helpers\Utils;

class StatusOrders {
    
    CONST ORDER_NEW = 0;
    CONST ORDER_SHIPPING = 1;
    CONST ORDER_DONE = 2;
    CONST ORDER_CANCEL = 3;
    
    public static function getData($key = '') {
        $array = [
            self::ORDER_NEW => trans('auth.status.order_new'),
            self::ORDER_SHIPPING => trans('auth.status.order_shipping'),
            self::ORDER_DONE => trans('auth.status.order_done'),
            self::ORDER_CANCEL => trans('auth.status.order_cancel'),
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