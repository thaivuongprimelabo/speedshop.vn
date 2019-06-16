-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th4 03, 2019 lúc 09:22 PM
-- Phiên bản máy phục vụ: 5.6.41-cll-lve
-- Phiên bản PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tha91806_store`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avail_flg` smallint(5) UNSIGNED DEFAULT '1',
  `status` smallint(5) UNSIGNED DEFAULT '0',
  `select_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`id`, `banner`, `description`, `link`, `youtube_id`, `avail_flg`, `status`, `select_type`, `created_at`, `updated_at`) VALUES
(14, 'https://bizweb.dktcdn.net/100/308/325/themes/665783/assets/slider_2.jpg?1547035845538', '', 'https://news.zing.vn/', NULL, 1, 1, 'use_image', '2019-04-02 23:20:41', '2019-04-02 23:20:41'),
(15, NULL, '', NULL, 'LVQxfALfTe4', 1, 1, 'use_youtube', '2019-04-02 23:38:22', '2019-04-02 23:38:22'),
(13, 'https://bizweb.dktcdn.net/100/308/325/themes/665783/assets/slider_1.jpg?1547035845538', '', 'https://www.facebook.com/', '', 1, 1, 'use_image', '2019-03-30 09:27:48', '2019-04-01 20:02:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` smallint(5) UNSIGNED DEFAULT '0',
  `avail_flg` smallint(5) UNSIGNED DEFAULT '1',
  `status` smallint(5) UNSIGNED DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `name_url`, `parent_id`, `avail_flg`, `status`, `created_at`, `updated_at`) VALUES
(10, 'Rau củ', 'rau-cu', 0, 1, 1, '2019-04-02 21:17:15', '2019-04-02 21:17:15'),
(11, 'Hoa quả', 'hoa-qua', 0, 1, 1, '2019-04-02 21:17:19', '2019-04-02 21:17:19'),
(12, 'Thịt', 'thit', 0, 1, 1, '2019-04-02 21:17:24', '2019-04-02 21:17:24'),
(13, 'Hải sản', 'hai-san', 0, 1, 1, '2019-04-02 21:17:28', '2019-04-02 21:17:28'),
(14, 'Rau tươi', 'rau-tuoi', 10, 1, 1, '2019-04-02 21:18:27', '2019-04-02 21:18:27'),
(15, 'Rau vườn', 'rau-vuon', 10, 1, 1, '2019-04-02 21:18:32', '2019-04-02 21:18:32'),
(16, 'Rau sạch', 'rau-sach', 10, 1, 1, '2019-04-02 21:18:37', '2019-04-02 21:18:37'),
(17, 'Củ nhập khẩu', 'cu-nhap-khau', 10, 1, 1, '2019-04-02 21:18:44', '2019-04-02 21:18:44'),
(18, 'Trái cây tươi', 'trai-cay-tuoi', 11, 1, 1, '2019-04-02 21:19:08', '2019-04-02 21:19:08'),
(19, 'Hoa quả sạch', 'hoa-qua-sach', 11, 1, 1, '2019-04-02 21:19:17', '2019-04-02 21:19:17'),
(20, 'Hoa quả nhập khẩu', 'hoa-qua-nhap-khau', 11, 1, 1, '2019-04-02 21:19:24', '2019-04-02 21:19:24'),
(21, 'Hoa quả tươi', 'hoa-qua-tuoi', 11, 1, 1, '2019-04-02 21:19:33', '2019-04-02 21:19:33'),
(22, 'Thịt gà', 'thit-ga', 12, 1, 1, '2019-04-02 21:19:44', '2019-04-02 21:19:44'),
(23, 'Thịt lợn', 'thit-lon', 12, 1, 1, '2019-04-02 21:19:49', '2019-04-02 21:19:49'),
(24, 'Thịt bò', 'thit-bo', 12, 1, 1, '2019-04-02 21:19:57', '2019-04-02 21:19:57'),
(25, 'Thịt vịt', 'thit-vit', 12, 1, 1, '2019-04-02 21:20:01', '2019-04-02 21:20:01'),
(26, 'Ngao', 'ngao', 13, 1, 1, '2019-04-02 21:20:14', '2019-04-02 21:20:14'),
(27, 'Sò huyết', 'so-huyet', 13, 1, 1, '2019-04-02 21:20:19', '2019-04-02 21:20:19'),
(28, 'Cua', 'cua', 13, 1, 1, '2019-04-02 21:20:22', '2019-04-02 21:20:22'),
(29, 'Tôm', 'tom', 13, 1, 1, '2019-04-02 21:20:26', '2019-04-02 21:20:26'),
(30, 'Xe máy', 'xe-may', 0, 1, 1, '2019-04-03 01:21:16', '2019-04-03 01:21:16'),
(31, 'Bô', 'bo', 0, 1, 1, '2019-04-03 01:21:20', '2019-04-03 01:21:20'),
(32, 'Đèn', 'den', 0, 1, 1, '2019-04-03 01:21:24', '2019-04-03 01:21:24'),
(33, 'Phuộc nhún', 'phuoc-nhun', 0, 1, 1, '2019-04-03 01:21:32', '2019-04-03 01:21:32'),
(34, 'Bánh xe', 'banh-xe', 0, 1, 1, '2019-04-03 01:22:19', '2019-04-03 01:22:19'),
(35, 'Cam xăng nồi', 'cam-xang-noi', 0, 1, 1, '2019-04-03 01:22:43', '2019-04-03 01:22:43'),
(36, 'Điện thoại', 'dien-thoai', 0, 1, 1, '2019-04-03 04:46:12', '2019-04-03 04:46:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(5) UNSIGNED DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `colors`
--

INSERT INTO `colors` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, '#572727', 1, '2019-03-24 19:41:21', '2019-03-24 19:41:21'),
(2, '#2fd115', 1, '2019-03-24 19:41:32', '2019-03-24 19:41:32'),
(3, '#421b30', 1, '2019-03-24 19:41:42', '2019-03-24 19:41:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `author_id` int(10) UNSIGNED DEFAULT NULL,
  `thread_id` int(10) UNSIGNED DEFAULT NULL,
  `reply_id` int(10) UNSIGNED DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `config`
--

CREATE TABLE `config` (
  `id` int(10) UNSIGNED NOT NULL,
  `web_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `web_description` text COLLATE utf8mb4_unicode_ci,
  `web_keywords` text COLLATE utf8mb4_unicode_ci,
  `web_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `web_ico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `web_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `mail_driver` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'smtp',
  `mail_host` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'smtp.gmail.com',
  `mail_port` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '587',
  `mail_from` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'admin@admin.com',
  `mail_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'System',
  `mail_encryption` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'tls',
  `mail_account` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT 'admin@gmail.com',
  `mail_password` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT '123456789',
  `banners_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '698x328',
  `vendors_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '120x45',
  `products_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '207x268',
  `posts_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '100x100',
  `web_logo_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '224x151',
  `users_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '25x25',
  `banners_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `vendors_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `products_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `posts_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `attachment_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `web_logo_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `users_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `off` int(11) DEFAULT '1',
  `url_ext` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '.html',
  `bank_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `cash_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `web_ico_image_size` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web_ico_maximum_upload` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web_hotline` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web_working_time` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `config`
--

INSERT INTO `config` (`id`, `web_title`, `web_description`, `web_keywords`, `web_logo`, `web_ico`, `web_email`, `mail_driver`, `mail_host`, `mail_port`, `mail_from`, `mail_name`, `mail_encryption`, `mail_account`, `mail_password`, `banners_image_size`, `vendors_image_size`, `products_image_size`, `posts_image_size`, `web_logo_image_size`, `users_image_size`, `banners_maximum_upload`, `vendors_maximum_upload`, `products_maximum_upload`, `posts_maximum_upload`, `attachment_maximum_upload`, `web_logo_maximum_upload`, `users_maximum_upload`, `off`, `url_ext`, `bank_info`, `cash_info`, `created_at`, `updated_at`, `web_ico_image_size`, `web_ico_maximum_upload`, `web_hotline`, `web_working_time`, `web_address`) VALUES
(1, 'Store Local', 'A', 'B', 'https://bizweb.dktcdn.net/100/308/325/themes/665783/assets/logo.png?1547035845538', 'ico/1553497712_ico.png', 'thai.vuong@primelabo.com.vn', 'smtp', 'smtp.gmail.com', '587', 'admin@admin.com', 'System', 'tls', 'admin@gmail.com', '123456789', '847x412', '120x45', '200x200', '100x100', '232x58', '160x160', '51200', '51200', '51200', '51200', '51200', '51200', '51200', 0, '.html', '<p>C</p>', '<p>D</p>', NULL, NULL, '90x90', '51200', '19001560', 'T2-T7 Giờ hành chính', '185/16 Nguyễn Lâm P6 Q10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci,
  `reply_content` text COLLATE utf8mb4_unicode_ci,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avail_flg` smallint(5) UNSIGNED DEFAULT '1',
  `status` smallint(5) UNSIGNED DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images_product`
--

CREATE TABLE `images_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `images_product`
--

INSERT INTO `images_product` (`id`, `product_id`, `image`) VALUES
(9, 1, 'https://cdn.tgdd.vn/Products/Images/42/190321/iphone-xs-max-gray-400x400.jpg'),
(10, 1, 'https://cdn.tgdd.vn/Products/Images/42/190323/iphone-xs-gold-400x400.jpg'),
(11, 2, 'https://cdn.tgdd.vn/Products/Images/42/190323/iphone-xs-gold-400x400.jpg'),
(12, 2, 'https://cdn.tgdd.vn/Products/Images/42/190324/iphone-xs-256gb-white-600x600.jpg'),
(13, 2, 'https://cdn.tgdd.vn/Products/Images/42/190321/iphone-xs-max-gray-400x400.jpg'),
(14, 6, 'image/1553489386_iphone-8-plus-hh-600x600.jpg'),
(16, 6, 'https://cdn.tgdd.vn/Products/Images/42/114114/iphone-8-plus-256gb-red-600x600.jpg'),
(21, 10, 'https://cdn.tgdd.vn/Products/Images/42/196963/samsung-galaxy-a50-black-400x400.jpg'),
(23, 11, 'https://cdn.tgdd.vn/Products/Images/42/198791/oppo-f11-pro-mtp-400x400.jpg'),
(24, 12, 'https://cdn.tgdd.vn/Products/Images/58/86507/cap-micro-1m-esaver-ds118br-tb-avatar-1-600x600.jpg'),
(25, 13, 'https://cdn.tgdd.vn/Products/Images/42/198985/huawei-p30-lite-1-400x400.jpg'),
(26, 23, 'http://bizweb.dktcdn.net/thumb/medium/100/308/325/products/kf57fd708888943c073792a327aeb5.jpg?v=1524537033277'),
(27, 24, 'https://bizweb.dktcdn.net/thumb/medium/100/308/325/products/x.jpg?v=1524537031717'),
(28, 25, 'https://bizweb.dktcdn.net/thumb/medium/100/308/325/products/43350e0a3ce5e4aa54ddaf90d33728.jpg?v=1524537029390'),
(29, 26, 'https://bizweb.dktcdn.net/thumb/medium/100/308/325/products/sss.jpg?v=1524537027550'),
(30, 27, 'https://bizweb.dktcdn.net/thumb/medium/100/308/325/products/sss.jpg?v=1524537027550'),
(31, 28, 'https://bizweb.dktcdn.net/thumb/medium/100/308/325/products/sss.jpg?v=1524537027550'),
(32, 29, 'https://bizweb.dktcdn.net/thumb/medium/100/308/325/products/sss.jpg?v=1524537027550'),
(33, 30, 'https://bizweb.dktcdn.net/thumb/medium/100/308/325/products/sss.jpg?v=1524537027550'),
(34, 31, 'https://bizweb.dktcdn.net/thumb/medium/100/308/325/products/43350e0a3ce5e4aa54ddaf90d33728.jpg?v=1524537029390'),
(35, 32, 'https://bizweb.dktcdn.net/thumb/medium/100/308/325/products/x.jpg?v=1524537031717'),
(36, 33, 'https://bizweb.dktcdn.net/100/308/325/products/h.jpg?v=1524537022723'),
(37, 34, 'https://bizweb.dktcdn.net/100/308/325/products/m80cacd71f2eb4db07280bf0bdfc8c.jpg?v=1524537020977'),
(38, 35, 'https://bizweb.dktcdn.net/100/308/325/products/nho1.jpg?v=1524537026310'),
(39, 36, 'image/1554292040_iphone-xs-max-64gb-tet-400x400.jpg'),
(40, 36, 'image/1554292040_iphone-8-plus-256gb-red-600x600.jpg'),
(41, 36, 'image/1554292040_iphone-x-256gb-20-600x600.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(5) UNSIGNED DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `password`, `avatar`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Lưu An Nhiên', 'annhien@gmail.com', '$2y$10$7G4oqdC9csfUag8mK.zlP.epWkiOg5kAQCRKJA9RcVVofwFa1PvH2', 'https://scontent.fsgn5-3.fna.fbcdn.net/v/t1.0-1/p160x160/30739181_785746534949274_5513401757931487562_n.jpg?_nc_cat=110&_nc_oc=AQn759zcnPgZCKg75W96SZzaVyiAqwC-edJD-Bcc9QprqVQtex196JNIMouvo86Tj5V2gYTtWF7P6jtNr4p86NPM&_nc_ht=scontent.fsgn5-3.fna&oh=c3208b1e429d00ea3b88cb29a859aa32&oe=5D3FA411', 1, NULL, '2019-03-30 01:05:00', '2019-03-30 01:05:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_01_21_135603_create_products_table', 1),
(4, '2019_01_21_135616_create_categories_table', 1),
(5, '2019_01_21_135626_create_vendors_table', 1),
(6, '2019_01_21_135638_create_banners_table', 1),
(7, '2019_01_21_135650_create_contacts_table', 1),
(8, '2019_01_21_135701_create_posts_table', 1),
(9, '2019_01_21_135729_create_config_table', 1),
(10, '2019_01_28_071200_create_images_product_table', 1),
(11, '2019_02_04_140819_create_colors_table', 1),
(12, '2019_02_04_140831_create_sizes_table', 1),
(13, '2019_02_07_090624_create_pages_table', 1),
(14, '2019_02_10_040500_create_orders_table', 1),
(15, '2019_02_10_040558_create_order_details_table', 1),
(16, '2019_02_22_134709_create_customers_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `customer_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `payment_method` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status` smallint(6) DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `customer_email`, `customer_address`, `customer_phone`, `payment_method`, `status`, `total`, `created_at`, `updated_at`) VALUES
(1, 'Phạm Văn Hai', 'phamvanhai@gmail.com', '185/16 Nguyễn Lâm P6 Q10', '0779924902', 'cash', 3, '29990000', '2019-03-25 01:51:00', '2019-03-25 02:06:33'),
(5, 'Mai Văn Dễ', 'maivande@gmail.com', '259 Nguyễn Tiểu La Q10', '0779935647', 'cash', 1, '52780000', '2019-03-25 01:56:22', '2019-03-25 02:05:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `qty` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  `sizes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `colors` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`order_id`, `product_id`, `qty`, `price`, `cost`, `sizes`, `colors`, `created_at`, `updated_at`) VALUES
(4, 1, 1, '29990000', '29990000', '', '', '2019-03-25 01:52:55', '2019-03-25 01:52:55'),
(5, 6, 1, '25790000', '25790000', '', '', '2019-03-25 01:56:22', '2019-03-25 01:56:22'),
(5, 2, 1, '26990000', '26990000', '', '', '2019-03-25 01:56:22', '2019-03-25 01:56:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `pages`
--

INSERT INTO `pages` (`id`, `name`, `name_url`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Giới thiệu', '', '<p>Trưa 2/4, C&ocirc;ng an tỉnh Bắc Ninh tiếp tục tạm giữ Ng&ocirc; B&aacute; Kh&aacute; (Kh&aacute; Bảnh, 26 tuổi, ở thị x&atilde; Từ Sơn) để điều tra h&agrave;nh vi Tổ chức đ&aacute;nh bạc.</p>\r\n\r\n<p>L&agrave;m việc với cảnh s&aacute;t, Kh&aacute; Bảnh tỏ ra kiệm lời. Khi l&atilde;nh đạo C&ocirc;ng an tỉnh Bắc Ninh động vi&ecirc;n, khuy&ecirc;n nhủ khai b&aacute;o th&agrave;nh khẩn, anh ta c&uacute;i đầu, lắng nghe.</p>\r\n\r\n<p>Nghe cảnh s&aacute;t nhắc đến người th&acirc;n, Kh&aacute; Bảnh kh&oacute;c th&uacute;t th&iacute;t v&agrave; đưa tay lau nước mắt. Tiếp tục được động vi&ecirc;n, Kh&aacute; Bảnh xưng &quot;ch&aacute;u&quot; với người đối diện v&agrave; thừa nhận thời gian qua, bản th&acirc;n đ&atilde; l&agrave;m điều sai.</p>\r\n\r\n<table align=\"center\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"Kha Banh khoc thut thit, nhan nhu nguoi than cung \'anh em xa hoi\' hinh anh 1 \" src=\"https://znews-photo.zadn.vn/w660/Uploaded/pwivovlb/2019_04_02/kb.jpg\" style=\"height:963px; width:1567px\" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kh&aacute; Bảnh đưa tay lau nước mắt khi cảnh s&aacute;t nhắc đến người th&acirc;n.&nbsp;<em>Ảnh cắt từ clip.</em></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Nhắc đến người mẹ, Ng&ocirc; B&aacute; Kh&aacute; nghẹn giọng khiến lời n&oacute;i bị ngắt qu&atilde;ng. &quot;Nhắn nhủ g&igrave; cho mẹ kh&ocirc;ng?&quot;, l&atilde;nh đạo c&ocirc;ng an tỉnh hỏi.</p>\r\n\r\n<p>&quot;Nhắn nhủ mẹ ch&aacute;u ở nh&agrave; giữ g&igrave;n sức khỏe, ch&aacute;u sẽ cố gắng sớm trở về với mẹ&quot;, Kh&aacute; Bảnh n&oacute;i v&agrave; tiếp tục nhắn c&aacute;c chị ở nh&agrave; &quot;kh&ocirc;ng cần lo cho em qu&aacute;, sống tốt l&agrave; được&quot;.</p>\r\n\r\n<p>Tiếp đ&oacute;, thanh ni&ecirc;n 26 tuổi gửi lời nhắn tới &quot;anh em x&atilde; hội&quot;, đặc biệt, Kh&aacute; Bảnh nhấn mạnh đến &quot;c&aacute;c em&quot; v&agrave; khuy&ecirc;n c&aacute;c em &quot;n&ecirc;n l&agrave;m những việc xứng đ&aacute;ng, đừng l&agrave;m việc g&igrave; sai&quot;.</p>', '2019-03-31 06:02:58', '2019-03-31 06:02:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_time_at` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avail_flg` smallint(5) UNSIGNED DEFAULT '1',
  `status` smallint(5) UNSIGNED DEFAULT '0',
  `post_group_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `name`, `name_url`, `description`, `content`, `photo`, `published_at`, `published_time_at`, `avail_flg`, `status`, `post_group_id`, `created_at`, `updated_at`) VALUES
(1, 'Quang Liêm giữ mạch thắng ở giải cờ vua Sharjah', 'quang-liem-giu-mach-thang-o-giai-co-vua-sharjah', 'Kỳ thủ số một Việt Nam cầm trắng hạ Ventakesh sau 57 nước cờ, ở ván ba hôm qua 24/3.', '<p>L&ecirc; Quang Li&ecirc;m (Elo 2.715) tiếp tục chọn khai cuộc e4 trước Đại kiện tướng người Ấn Độ. Sau hơn chục năm gần như chỉ d&ugrave;ng khai cuộc d4, Si&ecirc;u đại kiện tướng dần thay đổi kể từ cuối năm 2018. Quang Li&ecirc;m hơn tốt ở trung cuộc v&agrave; giữ lợi thế để thắng trong t&agrave;n cuộc.</p>\r\n\r\n<table align=\"center\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"Quang Liêm toàn thắng ba ván đầu ở giải cờ Sharjah 2019.\" data-natural-h=\"338\" data-natural-width=\"500\" data-pwidth=\"500\" data-width=\"500\" src=\"https://i-thethao.vnecdn.net/2019/03/25/quang-liem-1553496957-1280-1553496986.png\" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Quang Li&ecirc;m to&agrave;n thắng ba v&aacute;n đầu ở giải cờ Sharjah 2019.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Với ba điểm trọn vẹn, Quang Li&ecirc;m đứng ở nh&oacute;m đầu c&ugrave;ng Ernesto Inarkiev (2.692), Alexandr Fier (2.551), Eduardo Iturrizaga (2.639) v&agrave; Nihal Sarin (2.578). Anh c&oacute; th&ecirc;m năm điểm Elo để b&ugrave; đắp cho số điểm bị mất ở&nbsp;<a href=\"https://vnexpress.net/the-thao/quang-liem-thang-ivanchuk-o-giai-co-vua-my-3892671.html\">giải cờ M&ugrave;a Xu&acirc;n</a>. Ở v&aacute;n bốn, Quang Li&ecirc;m cầm đen gặp Iturrizaga - Đại kiện tướng người Venezuela vừa dự giải cờ vua HDBank 2019.</p>\r\n\r\n<p>Đại diện c&ograve;n lại của Việt Nam - Kiện tướng quốc tế Nguyễn Anh Kh&ocirc;i (2.484) cầm đen h&ograve;a Alexander Zubov (2.605). Đ&acirc;y c&oacute; thể coi l&agrave; kết quả th&agrave;nh c&ocirc;ng với t&agrave;i năng trẻ của Việt Nam. Anh Kh&ocirc;i đang c&oacute; 2,5 điểm v&agrave; hiệu quả thi đấu (rating performance) 2.559. Để c&oacute; chuẩn Đại kiện tướng đầu ti&ecirc;n, kỳ thủ 17 tuổi cần cải thiện hiệu quả l&ecirc;n 2.600. Ở v&aacute;n bốn, Anh Kh&ocirc;i cầm trắng gặp Đại kiện tướng Surya Ganguly (2.633).</p>', 'https://i-thethao.vnecdn.net/2019/03/25/quang-liem-1553496957-1280-1553496986.png', '20190403', '0844', 1, 1, 19, '2019-04-03 01:44:26', '2019-04-03 01:44:26'),
(2, 'Nữ VĐV trượt băng lập kỳ tích xoay bốn vòng trên không', 'nu-vdv-truot-bang-lap-ky-tich-xoay-bon-vong-tren-khong', 'Elizabet Tursynbaeva là VĐV đầu tiên trên thế giới thực hiện thành công động tác quad Salchow tại giải VĐTG diễn ra ở Saitama, Nhật Bản hôm 22/3.', '<p>&quot;Kh&ocirc;ng thể tin được l&agrave; t&ocirc;i đ&atilde; l&agrave;m được&quot;, Tursynbaeva n&oacute;i sau m&agrave;n tr&igrave;nh diễn gi&agrave;u&nbsp; cảm x&uacute;c. &quot;S&aacute;ng nay, t&ocirc;i tập luyện động t&aacute;c n&agrave;y ổn. Nhưng l&agrave;m được n&oacute; khi thi đấu l&agrave; điều ho&agrave;n to&agrave;n kh&aacute;c. T&ocirc;i đ&atilde; kh&ocirc;ng thể thực hiện quad Salchow ở hai kỳ giải v&ocirc; địch thế giới gần nhất. Vậy n&ecirc;n, t&ocirc;i rất hạnh ph&uacute;c với kỳ t&iacute;ch lần n&agrave;y&quot;.&nbsp;</p>\r\n\r\n<p>G&acirc;y ấn tượng mạnh với động t&aacute;c chưa ai l&agrave;m được trong lịch sử trượt băng nghệ thuật đỉnh cao, nhưng VĐV Kazakhstan lại kh&ocirc;ng thể với tới tấm HC v&agrave;ng. C&ocirc; g&aacute;i 19 tuổi gi&agrave;nh HC bạc với điểm 224,76. ĐKVĐ Olympic Alina Zagitova l&agrave; nh&agrave; v&ocirc; địch, với 237,5 điểm.</p>\r\n\r\n<table align=\"center\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"Nhà vô địch trượt băng thế giới 2019 Alina Zagitova mừng chiến thắng. Ảnh: AP.\" data-natural-h=\"500\" data-natural-width=\"500\" data-pwidth=\"500\" data-width=\"500\" src=\"https://i-thethao.vnecdn.net/2019/03/23/screen-shot-2019-03-23-at-9-31-2242-9445-1553351660.png\" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Nh&agrave; v&ocirc; địch trượt băng thế giới 2019 Alina Zagitova mừng chiến thắng. Ảnh:&nbsp;<em>AP</em>.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Tiếng vang tại giải thế giới tuần n&agrave;y c&oacute; thể đ&aacute;nh dấu bước tiến lớn trong sự nghiệp của Tursynbaeva. Trước khi dự giải đấu danh gi&aacute; nhất l&agrave;ng trượt băng, c&ocirc; đang xếp thứ 11 tr&ecirc;n bảng thứ bậc thế giới. Ở Olympic m&ugrave;a đ&ocirc;ng 2018, Tursynbaeva chỉ đứng thứ 12 trong số c&aacute;c VĐV tham dự.</p>', 'https://i-thethao.vnecdn.net/2019/03/23/screen-shot-2019-03-23-at-9-31-2242-9445-1553351660.png', '20190403', '0844', 1, 1, 20, '2019-04-03 01:44:13', '2019-04-03 01:44:13'),
(3, 'Tự chế món thạch sữa chua thanh long lung linh sắc màu', 'tu-che-mon-thach-sua-chua-thanh-long-lung-linh-sac-mau', 'Thạch sữa chua thanh long là món ăn tráng miệng tuyệt vời cho các mẹ. Đặc biệt là các bạn trẻ. Bởi vì món ăn này rất thanh mát, dễ ăn, đẹp da và trông rất màu sắc bắt...', '', 'https://bizweb.dktcdn.net/thumb/large/100/308/325/articles/blog-img-7.jpg?v=1524568735397', '', '', 1, 1, 18, '2019-04-03 01:46:09', '2019-04-03 01:46:09'),
(4, 'Kỹ thuật trồng rau sạch trong chậu xốp tại nhà đơn giản', 'ky-thuat-trong-rau-sach-trong-chau-xop-tai-nha-don-gian', 'Tự trồng rau trong thùng xốp tại nhà là sự lựa chọn của rất nhiều gia đình trong thành phố bởi phương pháp trồng rau đơn giản, dễ trồng, dễ quản lý, an toàn và tiện lợi. Nhưng người trồng cũng cần phải đảm bảo đúng kỹ thuật trồng rau để đảm bảo vệ sinh an toàn thực phẩm và giá trị dinh dưỡng của rau', '<p>Tự trồng rau trong th&ugrave;ng xốp tại nh&agrave; l&agrave; sự lựa chọn của rất nhiều gia đ&igrave;nh trong th&agrave;nh phố bởi phương ph&aacute;p trồng rau đơn giản, dễ trồng, dễ quản l&yacute;, an to&agrave;n v&agrave; tiện lợi.&nbsp;Nhưng người trồng cũng cần phải đảm bảo đ&uacute;ng kỹ thuật trồng rau để đảm bảo vệ sinh an to&agrave;n thực phẩm v&agrave; gi&aacute; trị dinh dưỡng của rau.</p>\r\n\r\n<p>Kỹ thuật trồng c&acirc;y rau sạch trong hộp xốp rất dễ thực hiện, chỉ cần bỏ ch&uacute;t c&ocirc;ng sức v&agrave; thời gian chờ đợi, những đợt rau sạch tự tay trồng đảm bảo an to&agrave;n sẽ đến ng&agrave;y thu hoạch.</p>', 'https://bizweb.dktcdn.net/100/308/325/articles/blog-img-6.jpg?v=1524568705587', '', '', 1, 1, 18, '2019-04-03 01:47:39', '2019-04-03 01:47:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_groups`
--

CREATE TABLE `post_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_groups`
--

INSERT INTO `post_groups` (`id`, `name`, `name_url`, `status`, `created_at`, `updated_at`) VALUES
(18, 'Tin mới', 'tin-moi', 1, '2019-04-02 21:56:02', '2019-04-02 21:56:02'),
(19, 'Tin quốc tế', 'tin-quoc-te', 1, '2019-04-02 21:56:08', '2019-04-02 21:56:08'),
(20, 'Tin trong nước', 'tin-trong-nuoc', 1, '2019-04-02 21:56:13', '2019-04-02 21:56:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sizes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colors` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` smallint(5) UNSIGNED DEFAULT '0',
  `avail_flg` smallint(5) UNSIGNED DEFAULT '1',
  `status` smallint(5) UNSIGNED DEFAULT '0',
  `is_new` smallint(5) UNSIGNED DEFAULT '0',
  `is_popular` smallint(5) UNSIGNED DEFAULT '0',
  `is_best_selling` smallint(5) UNSIGNED DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `name_url`, `price`, `category_id`, `vendor_id`, `description`, `sizes`, `colors`, `discount`, `avail_flg`, `status`, `is_new`, `is_popular`, `is_best_selling`, `created_at`, `updated_at`) VALUES
(30, 'Cà chua xanh', 'ca-chua-xanh', '89000', 17, 0, '', NULL, NULL, 0, 1, 1, 1, 1, 1, '2019-04-03 00:40:46', NULL),
(31, 'Dưa leo Mỹ', 'dua-leo-my', '60000', 20, 0, '', NULL, NULL, 0, 1, 1, 1, 1, 1, '2019-04-03 00:41:28', NULL),
(32, 'Cam sành', 'cam-sanh', '100000', 14, 0, '', NULL, NULL, 0, 1, 1, 1, 1, 1, '2019-04-03 01:18:50', NULL),
(33, 'Kiwi xanh', 'kiwi-xanh', '52000', 20, 0, '', NULL, NULL, 0, 1, 1, 1, 1, 1, '2019-04-03 01:19:42', NULL),
(34, 'Chanh dây đỏ Úc', 'chanh-day-do-uc', '45000', 17, 0, '', NULL, NULL, 0, 1, 1, 1, 1, 1, '2019-04-03 01:20:10', NULL),
(35, 'Nho mỹ', 'nho-my', '60000', 16, 0, '', NULL, NULL, 0, 1, 1, 1, 1, 1, '2019-04-03 01:20:59', NULL),
(25, 'Dưa leo Đà Lạt', 'dua-leo-da-lat', '65000', 18, 0, '', NULL, NULL, 0, 1, 1, 1, 1, 1, '2019-04-03 00:07:19', '2019-04-03 00:21:54'),
(26, 'Cà chua Đà Lạt', 'ca-chua-da-lat', '30000', 17, 0, '', NULL, NULL, 0, 1, 1, 1, 1, 1, '2019-04-03 00:08:23', '2019-04-03 00:21:38'),
(27, 'Cà chua Vũng Tàu', 'ca-chua-vung-tau', '60000', 16, 0, '', NULL, NULL, 0, 1, 1, 1, 1, 1, '2019-04-03 00:39:46', NULL),
(28, 'Cà chua ngọt', 'ca-chua-ngot', '70000', 15, 0, '', NULL, NULL, 0, 1, 1, 1, 1, 1, '2019-04-03 00:40:01', NULL),
(29, 'Cà chua bi', 'ca-chua-bi', '45000', 14, 0, '', NULL, NULL, 0, 1, 1, 1, 1, 1, '2019-04-03 00:40:19', NULL),
(23, 'Vải thiều loại to', 'vai-thieu-loai-to', '80000', 27, 0, '', NULL, NULL, 0, 1, 1, 1, 1, 1, '2019-04-03 00:04:28', '2019-04-03 00:22:18'),
(24, 'Hồng đỏ mỹ', 'hong-do-my', '150000', 23, 0, '', NULL, NULL, 0, 1, 1, 1, 1, 1, '2019-04-03 00:05:36', '2019-04-03 00:22:07'),
(36, 'Iphone XS Max 64GB', 'iphone-xs-max-64gb', '29990000', 29, 1, '<p>XXXXXXXXXXXXXXXXXXXX</p>', NULL, NULL, 0, 1, 1, 1, 1, 1, '2019-04-03 04:47:20', '2019-04-03 04:53:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_details`
--

CREATE TABLE `product_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_detail_group_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_details`
--

INSERT INTO `product_details` (`id`, `name`, `price`, `image`, `product_id`, `product_detail_group_id`, `created_at`, `updated_at`) VALUES
(26, 'A1', '13', NULL, 22, 18, '2019-04-02 06:18:30', '2019-04-02 06:18:30'),
(27, 'A2', '14', NULL, 22, 18, '2019-04-02 06:18:30', '2019-04-02 06:18:30'),
(28, 'D1', '44', NULL, 22, 19, '2019-04-02 06:18:30', '2019-04-02 06:18:30'),
(29, 'D2', '45', NULL, 22, 19, '2019-04-02 06:18:30', '2019-04-02 06:18:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_detail_groups`
--

CREATE TABLE `product_detail_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_detail_groups`
--

INSERT INTO `product_detail_groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(18, '#1003', '2019-04-01 23:18:30', '2019-04-02 06:18:30'),
(19, '#1004', '2019-04-01 23:18:30', '2019-04-02 06:18:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `service_group_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `image`, `product_id`, `service_group_id`, `created_at`, `updated_at`) VALUES
(8, 'S1', '11', NULL, 0, 10, '2019-04-01 02:38:53', '2019-04-01 09:38:53'),
(9, 'S2', '12', NULL, 0, 10, '2019-04-01 02:38:53', '2019-04-01 09:38:53'),
(10, 'A1', '33', NULL, 0, 11, '2019-04-01 02:38:53', '2019-04-01 09:38:53'),
(11, 'A2', '44', NULL, 0, 11, '2019-04-01 02:38:53', '2019-04-01 09:38:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service_groups`
--

CREATE TABLE `service_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `service_groups`
--

INSERT INTO `service_groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(12, '#1001', '2019-04-01 02:38:53', '2019-04-01 09:38:53'),
(11, '#1002', '2019-04-01 02:38:53', '2019-04-01 09:38:53'),
(10, '#1001', '2019-04-01 02:38:53', '2019-04-01 09:38:53'),
(9, '#1003', '2019-04-01 00:53:03', '2019-04-01 07:53:03'),
(13, '#1002', '2019-04-01 02:38:53', '2019-04-01 09:38:53'),
(14, '#1001', '2019-04-01 03:24:35', '2019-04-01 10:24:35'),
(15, '#1002', '2019-04-01 03:24:35', '2019-04-01 10:24:35'),
(16, 'Quán cháo lòng miền Nam', '2019-04-01 03:26:03', '2019-04-01 10:26:03'),
(17, '#1002', '2019-04-01 03:26:03', '2019-04-01 10:26:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) UNSIGNED DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'M', 1, '2019-03-24 19:41:49', '2019-03-24 19:41:49'),
(2, 'L', 1, '2019-03-24 19:41:54', '2019-03-24 19:41:54'),
(3, 'XL', 1, '2019-03-24 19:41:59', '2019-03-24 19:41:59'),
(4, 'XXL', 1, '2019-03-24 19:42:08', '2019-03-24 19:42:08'),
(5, 'XXXL', 1, '2019-03-30 09:03:11', '2019-03-30 09:03:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `threads`
--

CREATE TABLE `threads` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(10) UNSIGNED DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `group_id` int(11) DEFAULT NULL,
  `view_count` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` smallint(5) UNSIGNED DEFAULT '0',
  `status` smallint(5) UNSIGNED DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `role_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrator', 'super.admin@admin.com', '$2y$10$gWuBI6k3jcV0cQcDg8B3JuuJTwuhNz0nb73oSTqbuY.sxEcRGdZxS', 'https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.0-1/p160x160/36775518_1986722428007575_6243724851618512896_n.jpg?_nc_cat=102&_nc_oc=AQmrIf1jPrphuhm_0mb2I0DZRRYySqgWMIZmi0u5ZryI53cgUSAGzt5benGKhpYTvno&_nc_ht=scontent.fsgn8-1.fna&oh=1c3a6842acfbce0c793ef5699e7bbea7&oe=5D167979', 0, 0, '92gQ7qQzmJXR1tDP7vE8PkyUww2Wl9LI3Ry4Tj8Wm6Iwkdvdi1lSkHht7p7w', '2019-03-24 19:29:10', '2019-04-02 00:03:59'),
(2, 'Quản trị viên', 'admin@admin.com', '$2y$10$47NBELvC/IFRNPyT9Zl0FeF1Gvfq9dtEH4/TyAknuX75vGdH5jF6O', 'https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.0-9/45672266_921657814691478_5571583059867729920_n.jpg?_nc_cat=102&_nc_oc=AQlNg9XyY0c0RruG5RFPkOTCT-K3SDFqwozaToqAt8TISRe-JnMUFt123TW_MwFzIBw&_nc_ht=scontent.fsgn8-1.fna&oh=77ed1fc466d3a05f0a82f1fe6715056a&oe=5D4DFC9B', 1, 1, 'kodYxztAn8KnYqJwcH0YeZX3wL3WqHX4aaNiILrRjZFoHbRj5Kg8KT5YcIQ0', '2019-03-24 19:29:10', '2019-03-25 00:30:44'),
(3, 'Lưu Thái Vượng', 'thaivuong1503@gmail.com', '$2y$10$BqiwtogOb//HAGqEa08fOOi2zZqlcPIB8ebkTopJM622476WlIF6.', 'https://scontent.fsgn2-2.fna.fbcdn.net/v/t1.0-1/p160x160/36775518_1986722428007575_6243724851618512896_n.jpg?_nc_cat=102&_nc_oc=AQl7N8iQvk9mmUbxUCcsbPRELPFFcli5svml2s-M4XRfXStxgqrIslAaNb8LOLyusnU&_nc_ht=scontent.fsgn2-2.fna&oh=4dbe9c1bd463470a4f32d61036057e70&oe=5D167979', 2, 1, 'owqntMthK4TUrMsAiRBQybvtNbQjL6QWrZLetIHIBBOEA7ZMzpIRWThU0Ywn', '2019-03-25 00:19:23', '2019-03-25 00:19:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vendors`
--

CREATE TABLE `vendors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avail_flg` smallint(5) UNSIGNED DEFAULT '1',
  `status` smallint(5) UNSIGNED DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `name_url`, `logo`, `description`, `avail_flg`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Apple', 'apple', 'https://cdn.tgdd.vn/Brand/1/iPhone-(Apple)42-b_16.jpg', '', 1, 1, '2019-03-30 08:22:49', '2019-03-30 08:22:49'),
(2, 'Samsung', 'samsung', 'https://cdn.tgdd.vn/Brand/1/Samsung42-b_25.jpg', '', 1, 1, '2019-03-24 23:11:17', '2019-03-24 23:11:17'),
(3, 'Oppo', 'oppo', 'https://cdn.tgdd.vn/Brand/1/OPPO42-b_23.jpg', '', 1, 1, '2019-03-24 21:37:58', '2019-03-24 21:37:58'),
(4, 'Nokia', 'nokia', 'https://cdn.tgdd.vn/Brand/1/Nokia42-b_21.jpg', '', 1, 1, '2019-03-30 08:22:32', '2019-03-30 08:22:32'),
(5, 'Huawei', 'huawei', 'https://cdn.tgdd.vn/Brand/1/Huawei42-b_22.png', '', 1, 1, '2019-03-27 23:22:29', '2019-03-27 23:22:29'),
(6, 'Xiaomi', 'xiaomi', 'https://cdn.tgdd.vn/Brand/1/Xiaomi42-b_31.png', '', 1, 1, '2019-03-27 23:23:56', '2019-03-27 23:23:56'),
(7, 'Vsmart', 'vsmart', 'https://cdn.tgdd.vn/Brand/1/Vsmart42-b_40.png', 'XXXXXXXXXXXXXXXXXXX', 1, 1, '2019-03-30 00:46:24', '2019-03-30 00:46:24'),
(8, 'Vivo', 'vivo', 'https://cdn.tgdd.vn/Brand/1/Vivo42-b_26.jpg', '', 1, 1, '2019-03-31 00:07:59', '2019-03-31 00:07:59'),
(9, 'Philips', 'philips', 'vendor/1554174479_january.jpg', '', 1, 1, '2019-04-01 20:07:59', '2019-04-01 20:07:59');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `images_product`
--
ALTER TABLE `images_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`,`product_id`);

--
-- Chỉ mục cho bảng `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_groups`
--
ALTER TABLE `post_groups`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_detail_groups`
--
ALTER TABLE `product_detail_groups`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `service_groups`
--
ALTER TABLE `service_groups`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `config`
--
ALTER TABLE `config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `images_product`
--
ALTER TABLE `images_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `post_groups`
--
ALTER TABLE `post_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `product_detail_groups`
--
ALTER TABLE `product_detail_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `service_groups`
--
ALTER TABLE `service_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
