<?php

namespace App\Constants;

use App\Helpers\Utils;

class ContactStatus {
    
    CONST NEW_CONTACT = 0;
    CONST REPLIED_CONTACT = 1;
    
    public static function getData($key = '') {
        $array = [
            self::NEW_CONTACT => trans('auth.status.new'),
            self::REPLIED_CONTACT => trans('auth.status.replied'),
        ];

        if(!Utils::blank($key)) {
            return $array[$key];
        }
        
        return $array;
    }
    
    public static function createSelectList() {
        $data = self::getData();
        $html = '';
        foreach($data as $key=>$value) {
            $html .= '<option value="'. $key.'">'. $value .'</option>';
        }
        return $html;
    }
    
}