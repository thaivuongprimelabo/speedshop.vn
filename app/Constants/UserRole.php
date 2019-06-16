<?php

namespace App\Constants;

use App\Helpers\Utils;
use Illuminate\Support\Facades\Auth;

class UserRole {
    
    CONST SUPER_ADMIN = '0';
    CONST ADMIN = '1';
    CONST MOD = '2';
    CONST MEMBERS = '3';
    
    public static function getData($key = '') {
        $array = [
            self::SUPER_ADMIN => trans('auth.role.super_admin'),
            self::ADMIN => trans('auth.role.admin'),
            self::MOD => trans('auth.role.mod'),
            self::MEMBERS => trans('auth.role.member')
        ];

        if(!Utils::blank($key)) {
            return $array[$key];
        }
        
        return $array;
    }
    
    public static function createSelectList($selected = '') {
        $data = self::getData();
        unset($data[self::SUPER_ADMIN]);
        if(Auth::user()->role_id == self::ADMIN) {
            unset($data[self::ADMIN]);
        }
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