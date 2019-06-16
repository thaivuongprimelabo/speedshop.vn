<?php

namespace App\Constants;

use App\Helpers\Utils;

class BookingStatus {
    
    CONST CANCEL = 0;
    CONST WAITING_CONFIRM = 1;
    CONST AVAILABLE = 2;
    CONST DONE = 3;
    
    public static function getData($key = '') {
        $array = [
            self::CANCEL => trans('auth.status.booking_cancel'),
            self::WAITING_CONFIRM => trans('auth.status.booking_confirm'),
            self::AVAILABLE => trans('auth.status.booking_available'),
            self::DONE => trans('auth.status.booking_done')
        ];
        
        if($key != '') {
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