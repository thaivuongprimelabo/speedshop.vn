<?php
use App\Constants\ProductStatus;

$bannerType = [
    'use_image' => [
        'checked' => true,
        'text' => 'Hình ảnh'
    ],
    'use_youtube' => [
        'checked' => false,
        'text' => 'Youtube Clip'
    ]
];

$productType = [
    'normal' => 'Sản phẩm',
    'accessories' => 'Phụ kiện'
];

$product_status = [
    'out_of_stock' => 'Hết hàng',
    'available' => 'Còn hàng'
];

$paymentMethods = [
    'cash_info' => 'Thanh toán bằng tiền mặt',
    'bank_info' => 'Chuyển khoản ngân hàng'
];

$auth = [
    
    /*
     * |--------------------------------------------------------------------------
     * | Authentication Language Lines
     * |--------------------------------------------------------------------------
     * |
     * | The following language lines are used during authentication for various
     * | messages that we need to display to the user. You are free to modify
     * | these language lines according to your application's requirements.
     * |
     */
    
    'failed' => 'Tài khoản hoặc mật khẩu không chính xác.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'title' => 'Control Panel',
    /*------------ Login page ------------------- */
    'login_page_title' => '<b>Control</b>Panel',
    'login_page_top_text' => 'Vui lòng đăng nhập để truy cập hệ thống',
    'email_placeholder' => 'E-mail',
    'password_placeholder' => 'Mật khẩu',
    'remember_me' => 'Duy trì đăng nhập',
     /*------------ Dashboard page ------------------- */
    'dashboard_page_title' => '<b>C</b>Panel',
    'back_to_home' => 'Xem trang chính',
    'count' => '&nbsp;&nbsp;(Tìm thấy tất cả :count dòng dữ liệu)',
    /*------------ Sidebar ------------------- */
    'sidebar' => [
        'products' => [
            'title' => 'Quản lý sản phẩm',
            'products' => 'Danh mục sản phẩm',
            'categories' => 'Danh mục loại sản phẩm',
            'vendors' => 'Danh mục nhà cung cấp',
        ],
        'orders' => 'Quản lý đơn hàng',
        'banners' => 'Quản lý banner',
        'posts' => [
            'title' => 'Quản lý bài viết',
            'posts' => 'Bài viết',
            'postgroups' => 'Loại bài viết'
        ],
        'pages' => 'Quản lý trang nội dung',
        'contacts' => 'Hộp thư liên hệ',
        'users' => 'Quản lý tài khoản',
        'shipfee' => 'Phí ship',
        'config' => 'Cài đặt'
    ],
    'banner_type' => $bannerType,
    /*------------ Vendor page ------------------- */
    'ip' => [
        'list_title' => 'Danh mục ip truy cập',
        'search_form' => [
            'ip' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo IP'
            ],
        ],
        'table_header' => [
            'id' => [
                'text' => 'ID',
                'width' => '5%'
            ],
            'ip' => [
                'text' => 'Địa chỉ IP',
                'width' => '30%'
            ],
            'location' => [
                'text' => 'Vị trí',
                'width' => '30%'
            ],
            'created_at' => [
                'text' => 'Ngày truy cập',
                'width' => '20%'
            ],
            'remove_action' => [
                'text' => '',
                'width' => '10%'
            ]
        ]
    ],
    /*------------ Vendor page ------------------- */
    'vendors' => [
        'list_title' => 'Danh mục nhà cung cấp',
        'create_title' => 'Đăng ký nhà cung cấp',
        'edit_title' => 'Chỉnh sửa nhà cung cấp',
        'edit_title' => 'Chỉnh sửa nhà cung cấp',
        'search_placeholder' => 'Mã, tên nhà cung cấp',
        'table_header' => [
            'id' => [
                'text' => 'ID',
                'width' => '3%'
            ],
            'name' => [
                'text' => 'Tên loại sản phẩm',
                'width' => '10%'
            ],
            'logo' => [
                'text' => 'Logo',
                'width' => '10%'
            ],
            'status' => [
                'text' => 'Trạng thái',
                'width' => '10%'
            ],
            'created_at' => [
                'text' => 'Ngày đăng ký',
                'width' => '10%'
            ],
            'updated_at' => [
                'text' => 'Ngày cập nhật',
                'width' => '10%'
            ],
            'remove_action' => [
                'text' => '',
                'width' => '5%'
            ],
            'edit_action' => [
                'text' => '',
                'width' => '5%'
            ]
        ],
        'search_form' => [
            'id' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo ID nhà cung cấp'
            ],
            'name' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo tên nhà cung cấp'
            ],
            'status' => [
                'type' => 'status_select'
            ]
        ],
        'search_form' => [
            'id' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo ID loại sản phẩm'
            ],
            'name' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo tên loại sản phẩm'
            ],
            'status' => [
                'type' => 'status_select'
            ]
        ],
        'form' => [
            'name' => [
                'type' => 'text',
                'text' => 'Tên nhà cung cấp',
                'maxlength' => \App\Constants\Common::NAME_MAXLENGTH
            ],
            'upload_logo' => [
                'type' => 'file_simple',
                'text' => 'Hình ảnh'
            ],
            'status' => [
                'type' => 'checkbox',
                'text' => 'Đang hoạt động',
                'checked' => true
            ]
        ],
        'rules' => [
            'name' => 'required|max:' . \App\Constants\Common::NAME_MAXLENGTH,
        ]
    ],
    /*------------ Category page ------------------- */
    'categories' => [
        'list_title' => 'Danh mục loại sản phẩm',
        'create_title' => 'Đăng ký loại sản phẩm',
        'edit_title' => 'Chỉnh sửa loại sản phẩm',
        'edit_title' => 'Chỉnh sửa loại sản phẩm',
        'search_placeholder' => 'Mã, tên loại sản phẩm',
        'table_header' => [
            'id' => [
                'text' => 'ID',
                'width' => '3%'
            ],
            'name' => [
                'text' => 'Tên loại sản phẩm',
                'width' => '20%'
            ],
            'parent_cate' => [
                'text' => 'Loại cha',
                'width' => '10%'
            ],
            'status' => [
                'text' => 'Trạng thái',
                'width' => '10%'
            ],
            'created_at' => [
                'text' => 'Ngày đăng ký',
                'width' => '10%'
            ],
            'updated_at' => [
                'text' => 'Ngày cập nhật',
                'width' => '10%'
            ],
            'remove_action' => [
                'text' => '',
                'width' => '5%'
            ],
            'edit_action' => [
                'text' => '',
                'width' => '5%'
            ]
        ],
        'search_form' => [
            'id' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo ID loại sản phẩm'
            ],
            'name' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo tên loại sản phẩm'
            ],
            'status' => [
                'type' => 'status_select'
            ]
        ],
        'form' => [
            'name' => [
                'type' => 'text',
                'text' => 'Tên loại sản phẩm'
            ],
            'parent_id' => [
                'type' => 'select',
                'text' => 'Chọn loại cha',
                'empty_text' => '(Không chọn mặc định đây là loại cha)',
                'table' => 'CATEGORY_PARENT'
            ],
            'status' => [
                'type' => 'checkbox',
                'text' => 'Đang hoạt động',
                'checked' => true
            ]
        ],
        'rules' => [
            'name' => 'required|max:' . \App\Constants\Common::NAME_MAXLENGTH
        ]
    ],
    /*------------ Banner page ------------------- */
    'banners' => [
        'list_title' => 'Danh mục banner',
        'create_title' => 'Đăng ký banner',
        'edit_title' => 'Chỉnh sửa banner',
        'select_post_title' => 'Danh sách bài viết',
        'table_header' => [
            'id' => [
                'text' => 'ID',
                'width' => '3%'
            ],
            'banner' => [
                'text' => 'Banner',
                'width' => '15%'
            ],
            'link' => [
                'text' => 'Đường dẫn',
                'width' => '20%'
            ],
            'status' => [
                'text' => 'Trạng thái',
                'width' => '10%'
            ],
            'created_at' => [
                'text' => 'Ngày đăng ký',
                'width' => '10%'
            ],
            'updated_at' => [
                'text' => 'Ngày cập nhật',
                'width' => '10%'
            ],
            'remove_action' => [
                'text' => '',
                'width' => '5%'
            ],
            'edit_action' => [
                'text' => '',
                'width' => '5%'
            ]
        ],
        'search_form' => [
            'status' => [
                'type' => 'status_select',
                'empty_text' => 'Lọc theo trạng thái'
            ],
            'select_type' => [
                'type' => 'data_select',
                'table' => 'BANNER_TYPE',
                'empty_text' => 'Lọc theo loại'
            ]
        ],
        'status' => 'Tất cả trạng thái',
        'form' => [
            'select_type' => [
                'type' => 'radio_list',
                'value' => $bannerType
            ],
            'upload_banner' => [
                'type' => 'file_simple',
                'text' => 'Banner',
                'container_id' => 'use_image'
            ],
            'link' => [
                'type' => 'link_to_post',
                'text' => 'Đường dẫn',
                'container_id' => 'use_image'
            ],
            'youtube_id' => [
                'type' => 'text',
                'text' => 'Youtube URL',
                'container_id' => 'use_youtube'
            ],
            'preview_youtube' => [
                'type' => 'youtube_preview',
                'text' => 'Preview',
                'container_id' => 'use_youtube'
            ],
            'status' => [
                'type' => 'checkbox',
                'text' => 'Đang hoạt động',
                'checked' => true
            ]
        ],
        'rules' => [
            'upload_banner' => 'required',
            'link' => 'max:' . \App\Constants\Common::LINK_MAXLENGTH,
            'youtube_id' => 'max:' . \App\Constants\Common::LINK_MAXLENGTH
        ]
    ],
    /*------------ Contacts page ------------------- */
    'contacts' => [
        'list_title' => 'Danh mục liên hệ',
        'edit_title' => 'Xem thư',
        'table_header' => [
            'id' => [
                'text' => 'ID',
                'width' => '5%'
            ],
            'subject' => [
                'text' => 'Tựa đề',
                'width' => '20%'
            ],
            'email' => [
                'text' => 'E-mail',
                'width' => '20%'
            ],
            'phone' => [
                'text' => 'Số điện thoại',
                'width' => '10%'
            ],
            'contact_status' => [
                'text' => 'Trạng thái',
                'width' => '10%'
            ],
            'created_at' => [
                'text' => 'Ngày gửi',
                'width' => '15%'
            ],
            'remove_action' => [
                'text' => '',
                'width' => '5%'
            ],
            'edit_action' => [
                'text' => '',
                'width' => '5%'
            ]
        ],
        'search_form' => [
            'email' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo địa chỉ E-mail'
            ],
            'phone' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo số điện thoại'
            ],
            'status' => [
                'type' => 'data_select',
                'empty_text' => 'Lọc theo trạng thái',
                'table' => 'CONTACT_TYPE'
            ]
        ],
        'form' => [
            'subject' => [
                'type' => 'text',
                'text' => 'Tựa đề',
                'disabled' => true
            ],
            'name' => [
                'type' => 'text',
                'text' => 'Tên',
                'disabled' => true
            ],
            'email' => [
                'type' => 'text',
                'text' => 'E-mail',
                'disabled' => true
            ],
            'phone' => [
                'type' => 'text',
                'text' => 'Số điện thoại',
                'disabled' => true
            ],
            'content' => [
                'type' => 'textarea',
                'text' => 'Nội dung',
                'disabled' => true
            ],
            'reply_content' => [
                'type' => 'editor',
                'text' => 'Nội dung trả lời '
            ]
        ],
        'rules' => [
            'reply_content' => 'required'
        ]
    ],
    /*------------ Posts page ------------------- */
    'posts' => [
        'list_title' => 'Danh mục bài viết',
        'create_title' => 'Đăng ký bài viết',
        'edit_title' => 'Chỉnh sửa bài viết',
        'table_header' => [
            
            'id' => [
                'text' => 'ID',
                'width' => '3%'
            ],
            'name' => [
                'text' => 'Tựa đề',
                'width' => '15%'
            ],
            'photo' => [
                'text' => 'Hình ảnh',
                'width' => '10%'
            ],
            'description' => [
                'text' => 'Mô tả ngắn',
                'width' => '10%'
            ],
            'status' => [
                'text' => 'Trạng thái',
                'width' => '10%'
            ],
            'published_at' => [
                'text' => 'Ngày xuất bản',
                'width' => '10%'
            ],
            'created_at' => [
                'text' => 'Ngày đăng ký',
                'width' => '10%'
            ],
            'remove_action' => [
                'text' => '',
                'width' => '5%'
            ],
            'edit_action' => [
                'text' => '',
                'width' => '5%'
            ]
        ],
        'search_form' => [
            'id' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo ID bài viết'
            ],
            'name' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo tựa đề'
            ],
            'status' => [
                'type' => 'status_select',
                'empty_text' => 'Lọc theo trạng thái'
            ]
        ],
        'tab_form' => [
            'tab_form_1' => [
                'title' => 'Thông tin bài viết',
                'name' => [
                    'type' => 'text',
                    'text' => 'Tựa đề',
                    'maxlength' => \App\Constants\Common::NAME_MAXLENGTH
                ],
                'upload_photo' => [
                    'type' => 'file_simple',
                    'text' => 'Hình ảnh'
                ],
                'description' => [
                    'type' => 'textarea',
                    'text' => 'Mô tả ngắn',
                    'maxlength' => \App\Constants\Common::DESC_MAXLENGTH
                ],
                'content' => [
                    'type' => 'editor',
                    'text' => 'Nội dung',
                    'editor' => 'full',
                    'height' => 400
                ],
                'post_group_id' => [
                    'type' => 'select',
                    'text' => 'Nhóm',
                    'empty_text' => '--- Không thuộc nhóm nào ---',
                    'table' => 'POST_GROUPS'
                ],
                'status' => [
                    'type' => 'checkbox',
                    'text' => 'Xuất bản',
                    'checked' => true
                ]
            ],
            'tab_form_2' => [
                'title' => 'SEO',
                'view' => 'auth.common.seo'
            ]
        ],
        'rules' => [
            'name' => 'required|max:' . \App\Constants\Common::NAME_MAXLENGTH,
            'description' => 'required',
            'content' => 'required',
        ]
    ],
    'about' => [
        'edit_title' => 'Giới thiệu',
        'form' => [
            'content' => [
                'type' => 'editor',
                'text' => 'Nội dung'
            ]
        ]
    ],
    'delivery' => [
        'edit_title' => 'Phương thức giao hàng',
        'form' => [
            'content' => [
                'type' => 'editor',
                'text' => 'Nội dung'
            ]
        ]
    ],
    /*------------ PostGroups page ------------------- */
    'postgroups' => [
        'list_title' => 'Danh mục bài viết',
        'create_title' => 'Đăng ký bài viết',
        'edit_title' => 'Chỉnh sửa bài viết',
        'table_header' => [
            'id' => [
                'text' => 'ID',
                'width' => '3%'
            ],
            'name' => [
                'text' => 'Tên nhóm',
                'width' => '20%'
            ],
            'status' => [
                'text' => 'Trạng thái',
                'width' => '20%'
            ],
            'created_at' => [
                'text' => 'Ngày đăng ký',
                'width' => '20%'
            ],
            'updated_at' => [
                'text' => 'Ngày cập nhật',
                'width' => '20%'
            ],
            'remove_action' => [
                'text' => '',
                'width' => '5%'
            ],
            'edit_action' => [
                'text' => '',
                'width' => '5%'
            ]
        ],
        'search_form' => [
            'id' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo ID'
            ],
            'name' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo tên'
            ],
            'status' => [
                'type' => 'status_select',
                'empty_text' => 'Lọc theo trạng thái'
            ]
        ],
        'form' => [
            'name' => [
                'type' => 'text',
                'text' => 'Tên nhóm',
                'maxlength' => \App\Constants\Common::NAME_MAXLENGTH
            ],
            'status' => [
                'type' => 'checkbox',
                'text' => 'Đang hoạt động',
                'checked' => true
            ]
        ],
        'rules' => [
            'name' => 'required|max:' . \App\Constants\Common::NAME_MAXLENGTH,
        ]
    ],
    'about' => [
        'edit_title' => 'Giới thiệu',
        'form' => [
            'content' => [
                'type' => 'editor',
                'text' => 'Nội dung'
            ]
        ]
    ],
    'delivery' => [
        'edit_title' => 'Phương thức giao hàng',
        'form' => [
            'content' => [
                'type' => 'editor',
                'text' => 'Nội dung'
            ]
        ]
    ],
    /*------------ Orders page ------------------- */
    'orders' => [
        'list_title' => 'Danh mục đơn hàng',
        'edit_title' => 'Cập nhật đơn hàng',
        'order_info_title' => 'Thông tin đơn hàng',
        'table_header' => [
            'id' => [
                'text' => 'ID',
                'width' => '3%'
            ],
            'customer_name' => [
                'text' => 'Tên khách hàng',
                'width' => '10%'
            ],
            'customer_email' => [
                'text' => 'E-mail',
                'width' => '15%'
            ],
            'customer_address' => [
                'text' => 'Địa chỉ',
                'width' => '15%'
            ],
            'customer_phone' => [
                'text' => 'Điện thoại',
                'width' => '10%'
            ],
            'order_status' => [
                'text' => 'Trạng thái',
                'width' => '10%'
            ],
            'created_at' => [
                'text' => 'Ngày đặt hàng',
                'width' => '10%'
            ],
            'updated_at' => [
                'text' => 'Ngày cập nhật',
                'width' => '10%'
            ],
            'remove_action' => [
                'text' => '',
                'width' => '5%',
            ],
            'edit_action' => [
                'text' => '',
                'width' => '5%'
            ]
        ],
        'table_product_header' => [
            'product_id' => [
                'text' => 'ID',
                'width' => '5%'
            ],
            'product_name' => [
                'text' => 'Tên mục',
                'width' => '25%'
            ],
            'qty' => [
                'text' => 'Số lượng',
                'width' => '10%'
            ],
            'price' => [
                'text' => 'Đơn giá',
                'width' => '15%'
            ],
            'cost' => [
                'text' => 'Thành tiền',
                'width' => '15%'
            ],
        ],
        'search_form' => [
            'id' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo mã đơn hàng'
            ],
            'name' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo tên khách hàng'
            ],
            'phone' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo số điện thoại'
            ],
            'status' => [
                'type' => 'data_select',
                'table' => 'STATUS_ORDERS',
                'empty_text' => 'Lọc theo trạng thái'
            ],
            'created_at' => [
                'type' => 'calendar',
                'placeholder' => 'Lọc theo ngày đặt hàng'
            ],
        ],
        'form' => [
            'header' => 'Thông tin khách hàng',
            'customer_name' => [
                'type' => 'label',
                'text' => 'Tên khách hàng: '
            ],
            'customer_email' => [
                'type' => 'label',
                'text' => 'E-mail: '
            ],
            'customer_address' => [
                'type' => 'label',
                'text' => 'Địa chỉ giao hàng: '
            ],
            'customer_province' => [
                'type' => 'label',
                'text' => 'Tỉnh/thành phố'
            ],
            'customer_district' => [
                'type' => 'label',
                'text' => 'Quận/huyện'
            ],
            'customer_phone' => [
                'type' => 'label',
                'text' => 'Số điện thoại: '
            ],
            'payment_method' => [
                'type' => 'label',
                'text' => 'Phương thức chi trả: '
            ],
            'customer_note' => [
                'type' => 'label',
                'text' => 'Ghi chú: '
            ],
            'created_at' => [
                'type' => 'label',
                'text' => 'Ngày đặt hàng'
            ],
            'status' => [
                'type' => 'select',
                'table' => 'STATUS_ORDERS',
                'text' => 'Trạng thái đơn hàng',
                'empty_text'
            ]
        ],
        'subtotal_txt' => 'Tạm tính',
        'ship_fee_txt' => 'Phí ship',
        'total_txt' => 'Tổng tiền'
    ],
    'shipfee' => [
        'list_title' => 'Cập nhật phí ship theo tỉnh/thành hoặc quận/huyện'
    ],
    /*------------ Config page ------------------- */
    'config' => [
        'list_title' => 'Cài đặt hệ thống',
        'edit_title' => 'Cài đặt',
        'tab_form' => [
            'tab_form_1' => [
                'title' => 'Thông tin cơ bản',
                'web_title' => [
                    'type' => 'text',
                    'text' => 'Web name',
                    'maxlength' => 200
                ],
                'upload_web_logo' => [
                    'type' => 'file_simple',
                    'text' => 'Web logo'
                ],
                'upload_web_ico' => [
                    'type' => 'file_simple',
                    'text' => 'Web ico',
                ],
                'upload_web_banner' => [
                    'type' => 'file_simple',
                    'text' => 'Web banner'
                ],
                'web_email' => [
                    'type' => 'text',
                    'text' => 'Web mail',
                    'maxlength' => 200
                ],
                'web_address' => [
                    'type' => 'address',
                    'text' => 'Địa chỉ',
                ],
                'web_working_time' => [
                    'type' => 'text',
                    'text' => 'Giờ làm việc',
                    'height' => 100
                ],
                'web_hotline' => [
                    'type' => 'hotline',
                    'text' => 'Hotline mua hàng và tư vấn kĩ thuật:',
                    'maxlength' => 40
                ],
                'web_hotline_cskh' => [
                    'type' => 'hotline',
                    'text' => 'Hotline CSKH:',
                    'maxlength' => 40
                ],
                'freeship' => [
                    'type' => 'textarea',
                    'text' => 'Miễn phí vận chuyển',
                ],
                'web_description' => [
                    'type' => 'textarea',
                    'text' => 'SEO Description'
                ],
                'web_keywords' => [
                    'type' => 'textarea',
                    'text' => 'SEO Keywords'
                ],
                'footer_text' => [
                    'type' => 'editor',
                    'text' => 'Footer text'
                ],
                'url_ext' => [
                    'type' => 'text',
                    'text' => 'URL Extension',
                    'maxlength' => 15
                ],
                'limit_product_show' => [
                    'type' => 'number',
                    'text' => 'Số lượng sản phẩm hiển thị (List)'
                ],
                'limit_product_show_tab' => [
                    'type' => 'number',
                    'text' => 'Số lượng sản phẩm hiển thị (Tab)'
                ],
                'limit_post_show' => [
                    'type' => 'number',
                    'text' => 'Số lượng bài viết hiển thị (List)'
                ],
                'mail_from' => [
                    'type' => 'text',
                    'text' => 'From email',
                    'maxlength' => 150
                ],
                'mail_name' => [
                    'type' => 'text',
                    'text' => 'From name',
                    'maxlength' => 150
                ],
                'off' => [
                    'type' => 'checkbox',
                    'text' => 'Tắt hệ thống'
                ]
            ],
            'tab_form_2' => [
                'title' => 'Upload settings',
                'upload_banner_maximum_upload' => [
                    'type' => 'select',
                    'text' => 'Maximum upload file (Banner) KB',
                    'table' => 'UPLOAD_SIZE_LIMIT'
                ],
                'upload_logo_maximum_upload' => [
                    'type' => 'select',
                    'text' => 'Maximum upload file (Nhà cung cấp) KB',
                    'table' => 'UPLOAD_SIZE_LIMIT'
                ],
                'upload_image_maximum_upload' => [
                    'type' => 'select',
                    'text' => 'Maximum upload file (Sản phẩm) KB',
                    'table' => 'UPLOAD_SIZE_LIMIT'
                ],
                'upload_photo_maximum_upload' => [
                    'type' => 'select',
                    'text' => 'Maximum upload file (Bài viết) KB',
                    'table' => 'UPLOAD_SIZE_LIMIT'
                ],
                'upload_web_logo_maximum_upload' => [
                    'type' => 'select',
                    'text' => 'Maximum upload file (Web logo) KB',
                    'table' => 'UPLOAD_SIZE_LIMIT'
                ],
                'upload_web_ico_maximum_upload' => [
                    'type' => 'select',
                    'text' => 'Maximum upload file (Web ico) KB',
                    'table' => 'UPLOAD_SIZE_LIMIT'
                ],
                'upload_avatar_maximum_upload' => [
                    'type' => 'select',
                    'text' => 'Maximum upload file (Ảnh đại diện) KB',
                    'table' => 'UPLOAD_SIZE_LIMIT'
                ],
                'upload_web_banner_maximum_upload' => [
                    'type' => 'select',
                    'text' => 'Maximum upload file (Web banner) KB',
                    'table' => 'UPLOAD_SIZE_LIMIT'
                ],
                
                'upload_banner_image_size' => [
                    'type' => 'text',
                    'text' => 'Kích thước banner (dài x rộng)'
                ],
                'upload_logo_image_size' => [
                    'type' => 'text',
                    'text' => 'Kích thước logo nhà cung cấp (dài x rộng)'
                ],
                'upload_image_image_size' => [
                    'type' => 'text',
                    'text' => 'Kích thước hình sản phẩm (dài x rộng)'
                ],
                'upload_photo_image_size' => [
                    'type' => 'text',
                    'text' => 'Kích thước hình bài viết (dài x rộng)'
                ],
                'upload_web_logo_image_size' => [
                    'type' => 'text',
                    'text' => 'Kích thước web logo (dài x rộng)'
                ],
                'upload_web_ico_image_size' => [
                    'type' => 'text',
                    'text' => 'Kích thước web icon (dài x rộng)'
                ],
                'upload_avatar_image_size' => [
                    'type' => 'text',
                    'text' => 'Kích thước ảnh đại diện (dài x rộng)'
                ],
                'upload_web_banner_image_size' => [
                    'type' => 'text',
                    'text' => 'Kích thước web banner (dài x rộng)'
                ]
            ],
            'tab_form_3' => [
                'title' => 'Phương thức thanh toán',
                'cash_info' => [
                    'type' => 'editor',
                    'text' => 'Thanh toán khi giao hàng (COD)'
                ],
                'bank_info' => [
                    'type' => 'editor',
                    'text' => 'Chuyển khoản ngân hàng'
                ],
            ],
            'tab_form_4' => [
                'title' => 'Các mạng xã hội',
                'facebook_fanpage' => [
                    'type' => 'text',
                    'text' => 'Facebook page',
                    'maxlength' => 150
                ],
                'youtube_channel' => [
                    'type' => 'text',
                    'text' => 'Youtube channel',
                    'maxlength' => 150
                ],
                'zalo_page' => [
                    'type' => 'text',
                    'text' => 'Zalo page',
                    'maxlength' => 150
                ],
                'shopee_page' => [
                    'type' => 'text',
                    'text' => 'Shopee page',
                    'maxlength' => 150
                ],
            ],
        ],
        
    ],
    /*------------ Products page ------------------- */
    'products' => [
        'list_title' => 'Danh mục sản phẩm',
        'create_title' => 'Đăng ký sản phẩm',
        'edit_title' => 'Chỉnh sửa sản phẩm',
        'table_header' => [
            'id' => [
                'text' => 'ID',
                'width' => '3%'
            ],
            'name' => [
                'text' => 'Tên sản phẩm',
                'width' => '15%'
            ],
            'image' => [
                'text' => 'Hình ảnh',
                'width' => '10%'
            ],
            'category' => [
                'text' => 'Loại SP',
                'width' => '10%'
            ],
            'price' => [
                'text' => 'Giá bán (VNĐ)',
                'width' => '10%'
            ],
            'product_status' => [
                'text' => 'Trạng thái',
                'width' => '10%'
            ],
            'product_avail_flg' => [
                'text' => 'Còn/Hết hàng',
                'width' => '10%'
            ],
            'created_at' => [
                'text' => 'Ngày đăng ký',
                'width' => '15%'
            ],
            'remove_action' => [
                'text' => '',
                'width' => '5%'
            ],
            'edit_action' => [
                'text' => '',
                'width' => '5%'
            ]
        ],
        'search_form' => [
            'id' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo Id sản phẩm'
            ],
            'name' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo tên sản phẩm'
            ],
            'status' => [
                'type' => 'status_select',
                'empty_text' => 'Lọc theo trạng thái'
            ],
            'category_id' => [
                'type' => 'data_select',
                'table' => 'CATEGORY_PRODUCT',
                'empty_text' => 'Lọc theo loại'
            ],
            'vendor_id' => [
                'type' => 'data_select',
                'table' => \App\Constants\Common::VENDORS,
                'empty_text' => 'Lọc theo nhà cung cấp'
            ]
        ],
        'tab_form' => [
            'tab_form_1' => [
                'title' => 'Thông tin sản phẩm',
                'name' => [
                    'type' => 'text',
                    'text' => 'Tên sản phẩm',
                    'maxlength' => \App\Constants\Common::NAME_MAXLENGTH
                ],
                'price' => [
                    'type' => 'text',
                    'text' => 'Giá bán',
                    'maxlength' => \App\Constants\Common::PRICE_PRODUCT_MAXLENGTH
                ],
                'discount' => [
                    'type' => 'discount',
                    'text' => 'Tỷ lệ giảm giá (%)',
                    'value' => 0,
                    'maxlength' => \App\Constants\Common::DISCOUNT_MAXLENGTH
                ],
                'category_id' => [
                    'type' => 'select',
                    'text' => 'Loại sản phẩm',
                    'empty_text' => '---',
                    'table' => 'CATEGORY_PRODUCT'
                ],
                'vendor_id' => [
                    'type' => 'select',
                    'text' => 'Nhà cung cấp',
                    'empty_text' => '---',
                    'table' => 'VENDOR_PRODUCT'
                ],
                'upload_image' => [
                    'type' => 'file_multiple',
                    'text' => 'Hình sản phẩm',
                ],
                'summary' => [
                    'type' => 'textarea',
                    'text' => 'Mô tả',
                    'maxlength' => \App\Constants\Common::DESC_MAXLENGTH,
                ],
                'description' => [
                    'type' => 'editor',
                    'text' => 'Thông tin chi tiết',
                    'editor' => 'full',
                    'height' => '400'
                ],
                'status' => [
                    'type' => 'checkbox',
                    'text' => 'Đang hoạt động',
                    'checked' => true,
                ],
                'avail_flg' => [
                    'type' => 'checkbox',
                    'text' => $product_status['available'],
                    'checked' => true,
                    'value' => ProductStatus::AVAILABLE
                ],
                'is_new' => [
                    'type' => 'checkbox',
                    'text' => 'Sản phẩm mới',
                    'checked' => true,
                    'value' => \App\Constants\ProductType::IS_NEW
                ],
                'is_popular' => [
                    'type' => 'checkbox',
                    'text' => 'Sản phẩm được quan tâm',
                    'checked' => true,
                    'value' => \App\Constants\ProductType::IS_POPULAR
                ],
                'is_best_selling' => [
                    'type' => 'checkbox',
                    'text' => 'Sản phẩm bán chạy',
                    'checked' => true,
                    'value' => \App\Constants\ProductType::IS_BEST_SELLING
                ]
            ],
            'tab_form_2' => [
                'title' => 'Các phụ kiện đi kèm',
                'view' => 'auth.products.tab_form_2'
            ],
            'tab_form_3' => [
                'title' => 'SEO',
                'view' => 'auth.common.seo'
            ],
        ],
        'rules' => [
            'name' => 'required|max:' . \App\Constants\Common::NAME_MAXLENGTH,
            'price' => 'max:' . \App\Constants\Common::PRICE_PRODUCT_MAXLENGTH,
            'discount' => 'max:' . \App\Constants\Common::DISCOUNT_MAXLENGTH,
        ]
    ],
    /*------------ Users page ------------------- */
    'users' => [
        'list_title' => 'Danh mục tài khoản',
        'create_title' => 'Đăng ký tài khoản',
        'edit_title' => 'Chỉnh sửa tài khoản',
        'table_header' => [
            'id' => [
                'text' => 'ID',
                'width' => '3%'
            ],
            'name' => [
                'text' => 'Tên',
                'width' => '10%'
            ],
            'avatar' => [
                'text' => 'Ảnh đại diện',
                'width' => '10%'
            ],
            'email' => [
                'text' => 'E-mail',
                'width' => '15%'
            ],
            'role_id' => [
                'text' => 'Quyền hạn',
                'width' => '10%'
            ],
            'status' => [
                'text' => 'Trạng thái',
                'width' => '10%'
            ],
            'created_at' => [
                'text' => 'Ngày đăng ký',
                'width' => '15%'
            ],
            'last_login' => [
                'text' => 'Lần cuối đăng nhập',
                'width' => '15%'
            ],
            'remove_action' => [
                'text' => '',
                'width' => '5%'
            ],
            'edit_action' => [
                'text' => '',
                'width' => '5%'
            ]
        ],
        'search_form' => [
            'id' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo ID tài khoản'
            ],
            'name' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo tên'
            ],
            'phone' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo số điện thoại'
            ],
            'email' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo địa chỉ e-mail'
            ],
            'status' => [
                'type' => 'status_select',
                'empty_text' => 'Lọc theo trạng thái'
            ]
        ],
        'form' => [
            'name' => [
                'type' => 'text',
                'text' => 'Tên tài khoản'
            ],
            'upload_avatar' => [
                'type' => 'file_simple',
                'text' => 'Ảnh đại diện',
            ],
            'email' => [
                'type' => 'email',
                'text' => 'E-mail',
                'maxlength' => \App\Constants\Common::EMAIL_MAXLENGTH
            ],
            'password' => [
                'type' => 'password',
                'text' => 'Mật khẩu',
                'maxlength' => \App\Constants\Common::PASSWORD_MAXLENGTH
            ],
            'conf_password' => [
                'type' => 'password',
                'text' => 'Xác nhận mật khẩu'
            ],
            'role_id' => [
                'type' => 'select',
                'text' => 'Quyền hạn',
                'empty_text' => '--- Chọn quyền hạn ---',
                'table' => 'ROLE_USERS'
            ],
            'status' => [
                'type' => 'checkbox',
                'text' => 'Đang hoạt động',
                'checked' => true
            ]
        ],
        'rules' => [
            'name' => 'required|max:' . \App\Constants\Common::NAME_MAXLENGTH,
            'email' => 'required|email|max:' . \App\Constants\Common::EMAIL_MAXLENGTH,
            'password' => 'required|max:' . \App\Constants\Common::PASSWORD_MAXLENGTH . '|min:' . \App\Constants\Common::PASSWORD_MINLENGTH,
            'conf_password' => 'required|max:' . \App\Constants\Common::PASSWORD_MAXLENGTH . '|min:' . \App\Constants\Common::PASSWORD_MINLENGTH . '|same:password',
            'role_id' => 'required'
        ]
    ],
    /*------------ Profile page ------------------- */
    'profile' => [
        'list_title' => 'Chỉnh sửa tài khoản',
        'edit_title' => 'Chỉnh sửa',
        'form' => [
            'name' => [
                'type' => 'text',
                'text' => 'Tên tài khoản'
            ],
            'upload_avatar' => [
                'type' => 'file_simple',
                'text' => 'Ảnh đại diện',
            ],
            'password' => [
                'type' => 'password',
                'text' => 'Mật khẩu'
            ],
            'conf_password' => [
                'type' => 'password',
                'text' => 'Xác nhận mật khẩu'
            ]
        ],
        'rules' => [
            'name' => 'required|max:' . \App\Constants\Common::NAME_MAXLENGTH,
            'password' => 'required|max:' . \App\Constants\Common::PASSWORD_MAXLENGTH . '|min:' . \App\Constants\Common::PASSWORD_MINLENGTH,
            'conf_password' => 'required|max:' . \App\Constants\Common::PASSWORD_MAXLENGTH . '|min:' . \App\Constants\Common::PASSWORD_MINLENGTH . '|same:password'
        ]
    ],
    /*------------ Threads page ------------------- */
    'threads' => [
        'list_title' => 'Danh mục chủ đề',
        'create_title' => 'Đăng ký chủ đề',
        'edit_title' => 'Chỉnh sửa chủ đề',
        'edit_title' => 'Chỉnh sửa chủ đề',
        'search_placeholder' => 'Mã, tên chủ đề',
        'table_header' => [
            'id' => [
                'text' => 'ID',
                'width' => '3%'
            ],
            'name' => [
                'text' => 'Tên chủ đề',
                'width' => '20%'
            ],
            'status' => [
                'text' => 'Trạng thái',
                'width' => '10%'
            ],
            'author' => [
                'text' => 'Người đăng',
                'width' => '10%'
            ],
            'created_at' => [
                'text' => 'Ngày đăng ký',
                'width' => '10%'
            ],
            'updated_at' => [
                'text' => 'Ngày cập nhật',
                'width' => '10%'
            ],
            'remove_action' => [
                'text' => '',
                'width' => '5%'
            ],
            'edit_action' => [
                'text' => '',
                'width' => '5%'
            ]
        ],
        'search_form' => [
            'id' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo ID bài viết'
            ],
            'name' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo tựa đề'
            ],
            'status' => [
                'type' => 'status_select',
                'empty_text' => 'Lọc theo trạng thái'
            ]
        ],
        'form' => [
            'name' => [
                'type' => 'text',
                'text' => 'Chủ đề'
            ],
            'content' => [
                'type' => 'editor',
                'text' => 'Nội dung'
            ],
            'status' => [
                'type' => 'checkbox',
                'text' => 'Đang hoạt động'
            ]
        ]
    ],
    /*------------ Pages page ------------------- */
    'pages' => [
        'list_title' => 'Danh mục trang',
        'edit_title' => 'Chỉnh sửa trang nội dung',
        'table_header' => [
            'id' => [
                'text' => 'ID',
                'width' => '3%'
            ],
            'name' => [
                'text' => 'Trang',
                'width' => '20%'
            ],
            'created_at' => [
                'text' => 'Ngày đăng ký',
                'width' => '10%'
            ],
            'updated_at' => [
                'text' => 'Ngày cập nhật',
                'width' => '10%'
            ],
            'remove_action' => [
                'text' => '',
                'width' => '5%'
            ],
            'edit_action' => [
                'text' => '',
                'width' => '5%'
            ]
        ],
        'form' => [
            'name' => [
                'type' => 'text',
                'text' => 'Tên trang'
            ],
            'content' => [
                'type' => 'editor',
                'text' => 'Nội dung',
                'editor' => 'full',
                'height' => 400
            ]
        ],
        'rules' => [
            'content' => 'required'
        ]
    ],
    /*------------ Members page ------------------- */
    'members' => [
        'list_title' => 'Danh mục thành viên',
        'create_title' => 'Đăng ký thành viên',
        'edit_title' => 'Chỉnh sửa thành viên',
        'edit_title' => 'Chỉnh sửa thành viên',
        'search_placeholder' => 'Mã, tên thành viên',
        'table_header' => [
            'id' => [
                'text' => 'ID',
                'width' => '3%'
            ],
            'name' => [
                'text' => 'Tên',
                'width' => '20%'
            ],
            'avatar' => [
                'text' => 'Ảnh đại diện',
                'width' => '10%'
            ],
            'email' => [
                'text' => 'E-mail',
                'width' => '15%'
            ],
            'status' => [
                'text' => 'Trạng thái',
                'width' => '10%'
            ],
            'created_at' => [
                'text' => 'Ngày đăng ký',
                'width' => '10%'
            ],
            'remove_action' => [
                'text' => '',
                'width' => '5%'
            ],
            'edit_action' => [
                'text' => '',
                'width' => '5%'
            ]
        ],
        'search_form' => [
            'id' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo Id thành viên'
            ],
            'name' => [
                'type' => 'text',
                'placeholder' => 'Lọc theo tên thành viên'
            ],
            'status' => [
                'type' => 'status_select'
            ]
        ],
        'form' => [
            'name' => [
                'type' => 'text',
                'text' => 'Tên thành viên'
            ],
            'email' => [
                'type' => 'email',
                'text' => 'E-mail'
            ],
            'password' => [
                'type' => 'password',
                'text' => 'Mật khẩu'
            ],
            'conf_password' => [
                'type' => 'password',
                'text' => 'Xác nhận mật khẩu'
            ],
            'upload_avatar' => [
                'upload_type' => 'file_simple',
                'text' => 'Ảnh đại diện',
            ],
            'status' => [
                'type' => 'checkbox',
                'text' => 'Đang hoạt động',
                'checked' => true
            ]
        ],
        'rules' => [
            'name' => 'required|max:' . \App\Constants\Common::NAME_MAXLENGTH,
            'email' => 'required|email|max:' . \App\Constants\Common::EMAIL_MAXLENGTH,
            'password' => 'required|max:' . \App\Constants\Common::PASSWORD_MAXLENGTH . '|min:' . \App\Constants\Common::PASSWORD_MINLENGTH,
            'conf_password' => 'required|max:' . \App\Constants\Common::PASSWORD_MAXLENGTH . '|min:' . \App\Constants\Common::PASSWORD_MINLENGTH . '|same:password'
        ]
    ],
    'product_type' => $productType,
    'text_image_small' => ' (Tập tin *.jpg, *.jpeg, *.gif, *.png.Tối đa :limit_upload)',
    'select_empty_text' => 'Vui lòng chọn',
    'price_empty_text' => 'Liên hệ',
    'preview_image' => 'Hình đang sử dụng:',
    'no_data_found' => '(Chưa có dữ liệu)',
    'create_box_title' => 'Thông tin đăng ký',
    'edit_box_title' => 'Thông tin cập nhật',
    'length_text' => ' (Tối đã {0} ký tự)',
    'product_info' => 'Thông tin sản phẩm',
    'upload_check_txt' => 'Uploading...',
    'status' => [
        'unactive' => 'Tạm dừng',
        'active' => 'Đang hoạt động',
        'new' => 'Thư mới',
        'replied' => 'Đã trả lời',
        'published' => 'Đã xuất bản',
        'not_published' => 'Chưa xuất bản',
        'order_new' => 'Đơn hàng mới',
        'order_shipping' => 'Đang giao hàng',
        'order_done' => 'Hoàn tất',
        'order_cancel' => 'Đã hủy',
        'out_of_stock' => $product_status['out_of_stock'],
        'available' => $product_status['available'],
        'booking_cancel' => 'Đã hủy',
        'booking_confirm' => 'Đang đợi xác nhận',
        'booking_available' => 'Đã chốt lịch',
        'booking_done' => 'Đã hoàn thành'
    ],
    'role' => [
        'super_admin' => 'Kỹ thuật viên',
        'admin' => 'Quản trị hệ thống',
        'mod' => 'Quản trị viên',
        'member' => 'Thành viên'
    ],
    'payment_methods' => $paymentMethods,
    'button' => [
        'login' => 'Đăng nhập',
        'profile' => 'Thông tin tài khoản',
        'logout' => 'Thoát',
        'create' => 'Đăng ký',
        'search' => 'Tìm kiếm',
        'submit' => 'Lưu',
        'back' => 'Quay về',
        'send' => 'Gửi',
        'remove' => 'Xóa',
        'add_image' => 'Tải file',
        'upload_image' => 'Chọn file',
        'close' => 'Đóng',
        'select' => 'Chọn',
        'remove_all_data' => 'Xóa toàn bộ dữ liệu',
        'clear_config_cache' => 'Xóa cache',
        'add_service' => 'Đăng ký thông tin',
        'add_item' => 'Thêm',
        'copy_service' => 'Sử dụng dịch vụ của sản phẩm khác'
    ]
];

return $auth;
