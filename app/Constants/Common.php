<?php

namespace App\Constants;

class Common {
    
    CONST IMAGE_MIMES = 'image/jpg,image/jpeg,image/gif,image/png';
    CONST NO_IMAGE_FOUND = 'default_img.png';
    CONST NO_AVATAR = 'avatar.png';
    CONST ROW_PER_PAGE = 10;
    CONST LIMIT_PRODUCT_SHOW = 12;
    CONST LIMIT_PRODUCT_SHOW_SIDEBAR = 5;
    CONST LIMIT_PRODUCT_SHOW_TAB = 8;
    CONST LIMIT_POST_SHOW = 6;
    CONST NAME_MAXLENGTH = 120;
    CONST PHONE_MAXLENGTH = 15;
    CONST LINK_MAXLENGTH = 255;
    CONST DESC_MAXLENGTH = 300;
    CONST PRICE_MAXLENGTH = 11;
    CONST PRICE_PRODUCT_MAXLENGTH = 100;
    CONST EMAIL_MAXLENGTH = 150;
    CONST PASSWORD_MAXLENGTH = 40;
    CONST PASSWORD_MINLENGTH = 6;
    CONST DISCOUNT_MAXLENGTH = 3;
    
    /** Table **/
    CONST USERS = 'users';
    CONST VENDORS = 'vendors';
    CONST CATEGORIES = 'categories';
    CONST BANNERS = 'banners';
    CONST CONTACTS = 'contacts';
    CONST POSTS = 'posts';
    CONST CONFIG = 'config';
    CONST PRODUCTS = 'products';
    CONST IMAGES_PRODUCT = 'images_product';
    CONST PAGES = 'pages';
    CONST ORDERS = 'orders';
    CONST ORDER_DETAILS = 'order_details';
    CONST PRODUCT_DETAILS = 'product_details';
    CONST PRODUCT_DETAIL_GROUPS = 'product_detail_groups';
    CONST POST_GROUPS = 'post_groups';
    CONST IP_ADDRESS = 'ip_address';
    
    CONST TABLE_LIST = [
        self::USERS, self::VENDORS, self::CATEGORIES, self::BANNERS,
        self::CONTACTS, self::POSTS, self::PRODUCTS,
        self::IMAGES_PRODUCT, self::ORDERS, self::ORDER_DETAILS,
        self::PRODUCT_DETAILS, self::PRODUCT_DETAIL_GROUPS, self::POST_GROUPS, self::IP_ADDRESS
    ];
    
    /** Role **/
    CONST SUPER_ADMIN = '0';
    CONST ADMIN = '1';
    CONST MOD = '2';
    
    /** Mail **/
    CONST FROM_MAIL = 'thaivuong1503@gmail.com';
    CONST FROM_NAME = 'System';
    CONST SUBJECT = '【CPanel】 Test send mail';
    CONST TEMPLATE = 'auth.emails.template';
    
    /** Size */
    CONST UPLOAD_SIZE_LIMIT = ['51200', '102400', '204800', '307200' ,'512000', '1048576'];
    
    CONST CURRENCY = '₫';
    
    public static function getValue($key) {
        return constant('Common::' . $key);
    }
    
    
}