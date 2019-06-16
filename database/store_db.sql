-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: store_db
-- ------------------------------------------------------
-- Server version	5.7.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avail_flg` int(10) unsigned DEFAULT '1',
  `status` int(10) unsigned DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'banner/1549082223_01_02_2019_07_27_31_A7-T12-800-300.png','','https://forums.voz.vn/forumdisplay.php?f=17',1,1,'2019-02-01 21:37:03','2019-02-01 21:37:03'),(2,'banner/1549082230_09_01_2019_13_33_43_Phu-kien-800-300.png','','https://forums.voz.vn/forumdisplay.php?f=17',1,1,'2019-02-01 21:37:10','2019-02-01 21:37:10'),(3,'banner/1549082236_24_01_2019_10_51_01_Xiaomi-800-300.png','','https://forums.voz.vn/forumdisplay.php?f=17',1,1,'2019-02-01 21:37:16','2019-02-01 21:37:16'),(4,'banner/1549082247_30_12_2018_18_01_33_BigSS-800-300.png','','https://forums.voz.vn/forumdisplay.php?f=17',1,1,'2019-02-01 21:37:27','2019-02-01 21:37:27'),(5,'banner/1549082253_31_01_2019_16_39_54_Hotsaleiphone-800-300.png','','https://forums.voz.vn/forumdisplay.php?f=17',1,1,'2019-02-01 21:37:33','2019-02-01 21:37:33'),(6,'banner/1549082261_31_12_2018_16_39_45_Vinsmart-tet-800-300.png','','https://forums.voz.vn/forumdisplay.php?f=17',1,1,'2019-02-01 21:37:41','2019-02-01 21:37:41');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) unsigned DEFAULT '0',
  `avail_flg` int(10) unsigned DEFAULT '1',
  `status` int(10) unsigned DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Điện thoại','dien-thoai',0,1,1,'2019-02-01 21:33:11','2019-02-01 21:33:11'),(2,'Tablet','tablet',0,1,1,'2019-02-01 21:33:20','2019-02-01 21:33:20'),(3,'Laptop','laptop',0,1,1,'2019-02-01 21:33:30','2019-02-01 21:33:30'),(4,'Phụ kiện','phu-kien',0,1,1,'2019-02-01 21:33:37','2019-02-01 21:33:37'),(5,'Đồng hồ','dong-ho',0,1,1,'2019-02-01 21:33:43','2019-02-01 21:33:43'),(6,'Cũ giá rẻ','cu-gia-re',0,1,1,'2019-02-01 21:33:56','2019-02-01 21:33:56'),(7,'Sim số đẹp','sim-so-dep',0,1,1,'2019-02-02 01:02:27','2019-02-02 01:02:27');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) unsigned DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colors`
--

LOCK TABLES `colors` WRITE;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
INSERT INTO `colors` VALUES (1,'#475984',1,NULL,NULL),(2,'#8A2454',1,NULL,NULL),(3,'#BF6989',1,NULL,NULL),(4,'#9A54D8',1,NULL,NULL),(5,'#472424',1,'2019-02-05 23:39:01','2019-02-05 23:39:01'),(6,'#2337db',1,'2019-02-05 23:39:27','2019-02-05 23:39:27'),(7,'#0c1f05',0,'2019-02-05 23:40:52','2019-02-05 23:40:52'),(8,'#300a0a',0,'2019-02-05 23:41:15','2019-02-05 23:41:15'),(9,'#4d0f0f',0,'2019-02-06 00:11:42','2019-02-06 00:11:42'),(10,'#c71515',1,'2019-02-06 00:14:27','2019-02-06 00:14:27'),(11,'#5dd63f',0,'2019-02-06 00:14:48','2019-02-06 00:14:48'),(12,'#db0a0a',1,'2019-02-06 00:19:17','2019-02-06 00:20:28');
/*!40000 ALTER TABLE `colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `web_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `web_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `web_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
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
  `banner_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '698x328',
  `logo_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '120x45',
  `image_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '207x268',
  `photo_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '100x100',
  `web_logo_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '224x151',
  `avatar_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '25x25',
  `banner_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `logo_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `image_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `photo_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `attachment_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `web_logo_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `avatar_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `off` int(11) DEFAULT '1',
  `url_ext` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '.html',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bank_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cash_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,'E-shop','AAAAAAAAAAAAAAAA','XXXXXXXXXXXXXXXXXXX','web_logo/1549080673_logo.png','ico/favico.png','thai.vuong@primelabo.com.vn','smtp','smtp.gmail.com','587','admin@admin.com','System','tls','thaivuong1503@gmail.com','thaivuonglegiang9092','800x300','220x48','150x150','100x100','155x70','90x90','102400','51200','51200','51200','51200','51200','51200',1,'.html',NULL,NULL,'<p>Ng&acirc;n h&agrave;ng Vietcombank chi nh&aacute;nh H&ugrave;ng Vương</p>\r\n\r\n<h3>STK: 9999-9999-9999-9999</h3>\r\n\r\n<p>Người nhận: Nguyễn Văn A</p>\r\n\r\n<p>Nội dung: thanh to&aacute;n E-Shop</p>','<p>Nhận tiền khi giao h&agrave;ng</p>');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci,
  `reply_content` text COLLATE utf8mb4_unicode_ci,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avail_flg` int(10) unsigned DEFAULT '1',
  `status` int(10) unsigned DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'Lệ Giang','legiang92@gmail.com','1234567890','Chưa giao hàngChưa giao hàngChưa giao hàngChưa giao hàngChưa giao hàngChưa giao hàngChưa giao hàngChưa giao hàngChưa giao hàngChưa giao hàngChưa giao hàngChưa giao hàngChưa giao hàngChưa giao hàngChưa giao hàngChưa giao hàng','Chưa giao hàng',NULL,NULL,1,0,'2019-02-11 07:31:54','2019-02-11 07:31:54'),(2,'Hoàng Lê','hoangle1950@yahoo.com','456789456','Chưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờChưa tháo cờ','Chưa tháo cờ',NULL,NULL,1,0,'2019-02-11 07:32:21','2019-02-11 07:32:21'),(3,'Con Nhoi','nhoinhoi@gmail.com','4564564564','NhoiiiiiiiiiiiiNhoiiiiiiiiiiiiNhoiiiiiiiiiiiiNhoiiiiiiiiiiiiNhoiiiiiiiiiiiiNhoiiiiiiiiiiiiNhoiiiiiiiiiiiiNhoiiiiiiiiiiiiNhoiiiiiiiiiiiiNhoiiiiiiiiiiiiNhoiiiiiiiiiiiiNhoiiiiiiiiiiiiNhoiiiiiiiiiiiiNhoiiiiiiiiiiii','Nhoiiiiiiiiiiii',NULL,NULL,1,0,'2019-02-11 07:32:55','2019-02-11 07:32:55'),(4,'Vuong Luu','thai.vuong@primelabo.com.vn','1229924902','Cái DKMCái DKMCái DKMCái DKMCái DKM','Cái DKM','<p>Đ&acirc;y l&agrave; một trong những nội dung của c&ocirc;ng điện đ&ocirc;n đốc thực hiện nhiệm vụ sau kỳ nghỉ Tết Nguy&ecirc;n đ&aacute;n Kỷ Hợi từ Thủ tướng Nguyễn Xu&acirc;n Ph&uacute;c.</p>\r\n\r\n<p>Trong c&ocirc;ng điện ng&agrave;y 11/2, Thủ tướng&nbsp;<a href=\"https://news.zing.vn/tieu-diem/nguyen-xuan-phuc.html\" topic-id=\"4013\">Nguyễn Xu&acirc;n Ph&uacute;c</a>&nbsp;y&ecirc;u cầu &quot;Bộ Ngoại giao thực hiện tốt c&aacute;c nhiệm vụ đối ngoại, hội nhập năm 2019. Chủ tr&igrave;, phối hợp với c&aacute;c bộ, ng&agrave;nh li&ecirc;n quan tổ chức tốt cuộc gặp thượng đỉnh&nbsp;<a href=\"https://news.zing.vn/tieu-diem/hop-chung-quoc-hoa-ky.html\" topic-id=\"3909\">Mỹ</a>&nbsp;-&nbsp;<a href=\"https://news.zing.vn/tieu-diem/trieu-tien.html\" topic-id=\"3641\">Triều Ti&ecirc;n</a>&nbsp;lần 2 tại H&agrave; Nội&quot;, theo&nbsp;<em>Cổng th&ocirc;ng tin điện tử Ch&iacute;nh phủ</em>.</p>\r\n\r\n<p>Trước đ&oacute;, Tổng thống Mỹ Donald Trump c&ocirc;ng bố &ocirc;ng v&agrave; nh&agrave; l&atilde;nh đạo Triều Ti&ecirc;n Kim Jong Un sẽ gặp nhau lần hai tại thủ đ&ocirc; Việt Nam trong hai ng&agrave;y 27-28/2.</p>\r\n\r\n<table align=\"center\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"Thu tuong yeu cau phoi hop to chuc tot hoi nghi My - Trieu tai Ha Noi hinh anh 1\" src=\"https://znews-photo.zadn.vn/w660/Uploaded/pgi_dhbpgunat/2019_02_11/51638598_2085584311518745_8103248122290896896_o.jpg\" style=\"height:1323px; width:2000px\" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Thủ tướng Nguyễn Xu&acirc;n Ph&uacute;c đ&atilde; chỉ đạo Bộ Ngoại giao chủ tr&igrave;, phối hợp với c&aacute;c bộ, ng&agrave;nh li&ecirc;n quan tổ chức tốt cuộc gặp thượng đỉnh Mỹ - Triều lần 2 tại H&agrave; Nội. Ảnh:&nbsp;<em>Chinhphu.vn</em></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Hai nh&agrave; l&atilde;nh đạo đ&atilde; gặp nhau lần đầu trong sự kiện lịch sử tại&nbsp;<a href=\"https://news.zing.vn/tieu-diem/singapore.html\" topic-id=\"3915\">Singapore</a>&nbsp;hồi th&aacute;ng 6/2018. Tuy nhi&ecirc;n, hai b&ecirc;n cho đến nay vẫn chưa đạt được nhiều tiến triển cụ thể trong việc triển khai tuy&ecirc;n bố chung, bao gồm qu&aacute; tr&igrave;nh phi hạt nh&acirc;n h&oacute;a b&aacute;n đảo Triều Ti&ecirc;n.</p>\r\n\r\n<p>Để chuẩn bị cho cuộc gặp thượng đỉnh lần hai giữa tổng thống Mỹ v&agrave; nh&agrave; l&atilde;nh đạo Triều Ti&ecirc;n, rất nhiều cuộc gặp ngoại giao ở c&aacute;c cấp giữa c&aacute;c nước li&ecirc;n quan đ&atilde; được thực hiện trong những ng&agrave;y qua.</p>',NULL,1,1,'2019-02-11 07:44:27','2019-02-11 07:51:18');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images_product`
--

DROP TABLE IF EXISTS `images_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_product`
--

LOCK TABLES `images_product` WRITE;
/*!40000 ALTER TABLE `images_product` DISABLE KEYS */;
INSERT INTO `images_product` VALUES (51,1,'image/1549095302_iphone-xs-max-512gb-gold-600x600.jpg'),(54,2,'image/1549095415_iphone-xs-max-512gb-gold-600x600.jpg'),(52,2,'image/1549095415_iphone-xs-max-64gb-tet-400x400.jpg'),(53,2,'image/1549095415_iphone-xs-max-256gb-white-600x600.jpg'),(5,3,'image/1549095480_iphone-xs-max-64gb-tet-400x400.jpg'),(6,3,'image/1549095480_iphone-x-256gb-20-600x600.jpg'),(7,3,'image/1549095480_iphone-xs-max-512gb-gold-600x600.jpg'),(8,4,'image/1549095532_iphone-8-plus-256gb-red-600x600.jpg'),(9,4,'image/1549095532_iphone-7-plus-256gb-hh-600x600.jpg'),(10,5,'image/1549096831_samsung-galaxy-note-9-512gb-tet-600x600.jpg'),(11,5,'image/1549096831_samsung-galaxy-note-9-black-tet-600x600.jpg'),(12,5,'image/1549096831_samsung-galaxy-s9-plus-tet-600x600.jpg'),(13,6,'image/1549096866_samsung-galaxy-s8-plus-hh-600x600-600x600.jpg'),(14,6,'image/1549096866_samsung-galaxy-s9-plus-tet-600x600.jpg'),(15,7,'image/1549096905_samsung-galaxy-a7-2018-gold-400x400copy-600x600.jpg'),(16,7,'image/1549096905_samsung-galaxy-a7-2018-128gb-black-400x400copy-600x600.jpg'),(58,8,'image/1549097101_samsung-galaxy-j4-core-1-400x400-ava2-600x600.jpg'),(57,8,'image/1549097101_samsung-galaxy-j4-14-600x600.jpg'),(56,9,'image/1549264860_ipad-wifi-128-gb-2018-thumb-400x400.jpg'),(55,9,'image/1549264860_ipad-wifi-cellular-128gb-2018-1-1-133397-400x400copy-400x400.jpg'),(21,10,'image/1549266332_samsung-galaxy-tab-a-105-inch-ava-400x400.jpg'),(22,10,'image/1549266332_samsung-galaxy-tab-s4-105-inch-thumb-400x400.jpg'),(42,12,'image/1549285427_636720095219077886_asus-f560-0108.jpg'),(40,12,'image/1549285427_636720095219077886_asus-f560--2.jpg'),(41,12,'image/1549285427_636720095219077886_asus-f560-0107.jpg'),(39,12,'image/1549285427_636710689183153217_Asus-F560UD.png'),(38,11,'image/1549285235_hp-15-da0048tu-4me63pa-33397-ava1-600x600.jpg'),(43,13,'image/1549285485_dell-inspiron-3576-p63f002n76f-thumb-33397-400x400.jpg');
/*!40000 ALTER TABLE `images_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_01_21_135603_create_products_table',1),(4,'2019_01_21_135616_create_categories_table',1),(5,'2019_01_21_135626_create_vendors_table',1),(6,'2019_01_21_135638_create_banners_table',1),(7,'2019_01_21_135650_create_contacts_table',1),(8,'2019_01_21_135701_create_posts_table',1),(11,'2019_01_21_135729_create_config_table',2),(10,'2019_01_28_071200_create_images_product_table',1),(12,'2019_02_04_140819_create_colors_table',3),(13,'2019_02_04_140831_create_sizes_table',3),(14,'2019_02_07_090624_create_pages_table',4),(18,'2019_02_10_040558_create_order_details_table',5),(17,'2019_02_10_040500_create_orders_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_details` (
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `qty` int(10) unsigned NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES (1,9,1,13000000,13000000,'2019-02-09 21:55:03','2019-02-09 21:55:03'),(1,6,1,14490000,14490000,'2019-02-09 21:55:03','2019-02-09 21:55:03'),(2,6,4,14490000,57960000,'2019-02-09 22:05:14','2019-02-09 22:05:14'),(3,9,1,13000000,13000000,'2019-02-09 22:09:52','2019-02-09 22:09:52'),(4,8,1,2690000,2690000,'2019-02-09 22:10:45','2019-02-09 22:10:45'),(5,8,1,2690000,2690000,'2019-02-09 22:11:56','2019-02-09 22:11:56'),(6,8,3,2690000,8070000,'2019-02-09 22:25:53','2019-02-09 22:25:53'),(7,9,1,13000000,13000000,'2019-02-09 22:46:58','2019-02-09 22:46:58'),(8,9,2,13000000,19500000,'2019-02-10 00:47:31','2019-02-10 00:47:31'),(8,8,1,2690000,1614000,'2019-02-10 00:47:31','2019-02-10 00:47:31');
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `customer_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `payment_method` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status` int(11) DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'Vuong Luu','websitemotor@gmail.com','1234567','01229924902','bank_transfer',1,27490000,'2019-02-09 21:55:03','2019-02-10 04:33:02'),(2,'Wonder Woman','thaivuong1503@gmail.com','259 Nguyễn Tiểu La P6 Q10','09872727223','bank_transfer',2,57960000,'2019-02-09 22:05:14','2019-02-10 04:33:25'),(3,'XXXXXXXXXXXXX','admin@admin.com','asdasdasdsadasdasdasd','32132132323','bank_transfer',0,13000000,'2019-02-09 22:09:52','2019-02-09 22:09:52'),(4,'Vuong Luu','websitemotor@gmail.com','1234567','01229924902','bank_transfer',0,2690000,'2019-02-09 22:10:45','2019-02-09 22:10:45'),(5,'Vuong Luu','thai.vuong@primelabo.com.vn','1234567','01229924902','bank_transfer',0,2690000,'2019-02-09 22:11:56','2019-02-09 22:11:56'),(6,'Bùi Tiến Dũng','thaivuong90@gmail.com','25 Nguyễn Trãi Q5','123456789','bank_transfer',0,8070000,'2019-02-09 22:25:53','2019-02-09 22:25:53'),(7,'Hoàng Lê','thai.vuong@primelabo.com.vn','222 AAAAAAAAAAAAAAAAAAAAAAA','2424242424','bank_transfer',0,13000000,'2019-02-09 22:46:58','2019-02-09 22:46:58'),(8,'Nguyễn Quang Hải','thai.vuong@primelabo.com.vn','666 Nguyễn Tri Phương P6 Q10','01229924902','bank_transfer',0,21114000,'2019-02-10 00:47:31','2019-02-10 00:47:31');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Giới thiệu','gioi-thieu','<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n\r\n<h2>Where can I get some?</h2>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>','2019-02-07 02:28:18','2019-02-07 02:29:56'),(2,'','','<h1>Lorem Ipsum</h1>\r\n\r\n<p>&quot;Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...&quot;</p>\r\n\r\n<p>&quot;There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...&quot;</p>\r\n\r\n<hr />\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut facilisis nibh. Quisque at dolor quis arcu tincidunt accumsan. Etiam sed purus non massa ornare ultricies id non elit. Donec aliquet aliquam bibendum. Pellentesque tincidunt ultrices leo ut lobortis. Pellentesque aliquam vel neque ac vestibulum. Duis sagittis, est vitae auctor semper, nunc velit ultricies orci, at accumsan arcu neque vitae erat. Nunc feugiat nunc vulputate nunc semper, sit amet ornare quam placerat. Maecenas sed erat nisl. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n\r\n<p>Phasellus vehicula, neque sit amet malesuada efficitur, dui libero tempor nulla, at condimentum velit tellus non ex. Ut imperdiet sodales egestas. Nullam rutrum orci turpis, at ornare metus congue at. Nulla ullamcorper ut orci non vestibulum. Aliquam lobortis eros et tincidunt posuere. Fusce et justo in neque varius porta. Cras tellus lectus, pharetra vel sagittis et, suscipit vitae sem. Aliquam at vulputate dui, blandit consequat nisl. Mauris vitae nulla et lorem maximus sagittis quis quis justo.</p>\r\n\r\n<p>Integer risus velit, posuere et imperdiet sed, sollicitudin at arcu. Donec feugiat, lorem at vestibulum scelerisque, augue elit accumsan lacus, ac finibus ex erat eu orci. Morbi vestibulum justo quis nisi elementum maximus. Etiam aliquet tellus vel neque fermentum, ac dignissim mauris laoreet. Ut lobortis ipsum id tellus lobortis, id tempor ante volutpat. Nunc lorem dolor, ornare sed hendrerit at, feugiat accumsan nisi. Etiam accumsan ultrices ultricies. Nulla at congue tellus, ac consequat lectus. Donec a magna placerat, semper eros non, cursus felis. Proin accumsan, nulla sed pellentesque condimentum, magna ligula sagittis quam, ut porttitor tellus sapien id lectus. Curabitur aliquam vestibulum dolor ut imperdiet. In mollis nisl ac mauris luctus elementum. Proin euismod erat vitae leo vulputate vehicula. Integer vitae odio dignissim, finibus augue sit amet, vestibulum lorem. Nunc venenatis ligula at risus feugiat semper.</p>\r\n\r\n<p>Phasellus mattis augue turpis, nec vulputate nisl feugiat sit amet. Vivamus id ipsum id nisi sodales vestibulum. Nulla facilisi. Duis gravida enim non interdum gravida. Nullam efficitur eget tellus et volutpat. Maecenas in erat imperdiet, sagittis lectus quis, sodales elit. Praesent varius suscipit felis, vel ultricies felis luctus eget. Fusce vitae turpis efficitur, iaculis felis vitae, lobortis enim. Integer rhoncus mi sed velit placerat efficitur. Nullam egestas nibh ut dui maximus, sed volutpat justo accumsan. Vivamus nec quam nec metus commodo ornare vel et arcu. Duis viverra porttitor tortor non consectetur. Donec ultrices diam nulla, quis rhoncus nibh efficitur non. Nam commodo ullamcorper urna sed tincidunt.</p>\r\n\r\n<p>Suspendisse potenti. Aliquam sit amet massa sem. Morbi sit amet egestas elit. Proin at diam nec libero dictum dictum eu eu tellus. Cras felis turpis, vulputate et sagittis viverra, sodales et magna. Proin id velit at mi mollis pharetra ut vel justo. Curabitur in felis laoreet, porttitor quam sed, mollis odio. Vestibulum nulla sem, ultricies in leo et, mattis pellentesque enim. Duis aliquam elementum sapien, vel pellentesque est euismod id. Morbi vel sollicitudin nunc.</p>','2019-02-07 02:37:04','2019-02-07 02:37:04');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_time_at` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avail_flg` int(10) unsigned DEFAULT '1',
  `status` int(10) unsigned DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `vendor_id` int(10) unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `avail_flg` int(10) unsigned DEFAULT '1',
  `status` int(10) unsigned DEFAULT '0',
  `is_new` int(10) unsigned DEFAULT '0',
  `is_popular` int(10) unsigned DEFAULT '0',
  `is_best_selling` int(10) unsigned DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sizes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colors` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Iphone XS Max 512GB','iphone-xs-max-512gb',37790000,1,1,'<p>Với c&ocirc;ng nghệ Super Retina kết hợp tấm nền OLED tr&ecirc;n&nbsp;iPhone XS Max đem lại dải m&agrave;u sắc cực k&igrave; sống động v&agrave; sắc n&eacute;t đến từng chi tiết.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/191482/iphone-xs-max-512gb-gold-8.jpg\" onclick=\"return false;\"><img alt=\"Màn hình điện thoại iPhone Xs Max chính hãng\" data-original=\"https://cdn.tgdd.vn/Products/Images/42/191482/iphone-xs-max-512gb-gold-8.jpg\" src=\"https://cdn.tgdd.vn/Products/Images/42/191482/iphone-xs-max-512gb-gold-8.jpg\" title=\"Màn hình điện thoại iPhone Xs Max chính hãng\" /></a></p>\r\n\r\n<p>B&ecirc;n cạnh đ&oacute;, Apple c&ograve;n t&iacute;ch hợp th&ecirc;m c&ocirc;ng nghệ HDR10 c&ugrave;ng tần số cảm ứng 120 Hz gi&uacute;p chất lượng h&igrave;nh ảnh được n&acirc;ng cao v&agrave; mượt m&agrave; hơn đ&aacute;ng kể.</p>',1,1,1,1,1,'2019-02-02 01:15:02','2019-02-06 08:18:17','1,2,3,4','1,2,3,4,5,6,10,12',20),(2,'Iphone XS Max 256GB','iphone-xs-max-256gb',34790000,1,1,'<p>iPhone Xs Max được Apple trang bị cho con chip mới toanh h&agrave;ng đầu của h&atilde;ng mang t&ecirc;n&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc/chi-tiet-chip-apple-a12-bionic-ben-trong-iphone-xs-xs-max-1116982\" target=\"_blank\" title=\"Tìm hiểu chip Apple A12\" type=\"Tìm hiểu chip Apple A12\">Apple A12</a>.</p>\r\n\r\n<p>Chip A12 Bionic được x&acirc;y dựng tr&ecirc;n tiến tr&igrave;nh 7nm đầu ti&ecirc;n m&agrave; h&atilde;ng sản xuất với 6 nh&acirc;n đ&aacute;p ứng vượt trội trong việc xử l&yacute; c&aacute;c t&aacute;c vụ v&agrave; khả năng tiết kiệm năng lượng tối ưu.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/190322/iphone-xs-max-256gb-gold-12.jpg\" onclick=\"return false;\"><img alt=\"Trải nghiệm điện thoại iPhone Xs Max chính hãng\" data-original=\"https://cdn.tgdd.vn/Products/Images/42/190322/iphone-xs-max-256gb-gold-12.jpg\" src=\"https://cdn.tgdd.vn/Products/Images/42/190322/iphone-xs-max-256gb-gold-12.jpg\" title=\"Trải nghiệm điện thoại iPhone Xs Max chính hãng\" /></a></p>\r\n\r\n<p>Hơn nữa,&nbsp;chiếc&nbsp;<a href=\"https://www.thegioididong.com/dtdd-apple-iphone\" target=\"_blank\" title=\"Tham khảo các dòng điện thoại iPhone\" type=\"Tham khảo các dòng điện thoại iPhone\">điện thoại iPhone</a>&nbsp;c&ograve;n c&oacute; bộ xử l&yacute; đồ họa mạnh mẽ được Apple thiết kế ri&ecirc;ng gi&uacute;p hiệu năng được cải thiện rất lớn về mặt đồ họa của m&aacute;y.</p>\r\n\r\n<p>Chưa dừng lại ở đ&oacute;, m&aacute;y c&ograve;n được t&iacute;ch hợp tr&iacute; th&ocirc;ng minh nh&acirc;n tạo gi&uacute;p phần cứng tối ưu hiệu suất, nhờ đ&oacute; m&agrave; c&aacute;c thao t&aacute;c của bạn được xử l&yacute; một c&aacute;ch nhanh ch&oacute;ng hơn.</p>',1,1,1,1,1,'2019-02-02 01:16:55','2019-02-06 08:39:07','1','2,12',10),(3,'Iphone XS 256GB','iphone-xs-256gb',29990000,1,1,'',1,1,1,1,1,'2019-02-02 01:18:00',NULL,NULL,NULL,0),(4,'Iphone 8 plus','iphone-8-plus',25790000,1,1,'',1,1,1,1,1,'2019-02-02 01:18:52',NULL,NULL,NULL,0),(5,'Galaxy Note 9','galaxy-note-9',23490000,1,2,'',1,1,1,1,1,'2019-02-02 01:40:31',NULL,NULL,NULL,0),(6,'Galaxy Note 8','galaxy-note-8',14490000,1,2,'',1,1,1,1,1,'2019-02-02 01:41:06',NULL,NULL,NULL,0),(7,'Galaxy Ă7','galaxy-a7',6990000,1,2,'',1,1,1,1,1,'2019-02-02 01:41:45',NULL,NULL,NULL,0),(8,'Galaxy J4','galaxy-j4',2690000,1,2,'',1,1,1,1,1,'2019-02-02 01:45:01','2019-02-06 08:41:04','','',40),(9,'iPad Wifi Cellular 128GB','ipad-wifi-cellular-128gb',13000000,2,1,'<p>AAAAAAAAAAAAAAAAAAAAAAAAA</p>',1,1,1,1,1,'2019-02-04 00:21:00','2019-02-06 08:40:43','','',25),(10,'Samsung Galaxy Tab A','samsung-galaxy-tab-a',9000000,2,2,'',1,1,1,1,1,'2019-02-04 00:45:32',NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sizes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) unsigned DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sizes`
--

LOCK TABLES `sizes` WRITE;
/*!40000 ALTER TABLE `sizes` DISABLE KEYS */;
INSERT INTO `sizes` VALUES (1,'S',1,NULL,'2019-02-05 10:09:42'),(2,'XL',1,NULL,'2019-02-05 10:10:05'),(3,'SL',1,NULL,NULL),(4,'M',1,'2019-02-05 09:30:16','2019-02-05 09:30:16');
/*!40000 ALTER TABLE `sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(10) unsigned DEFAULT '0',
  `status` int(10) unsigned DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Administrator','super.admin@admin.com','$2y$10$oMmoPYr3oTkF18eZ.KOrduqd5wJeu91Iufx5WdT2rfWYMTK5Nfn.6',NULL,0,0,NULL,'2019-02-01 07:56:28','2019-02-01 07:56:28'),(2,'Administrator','admin@admin.com','$2y$10$VTTFIT8PX9OUXgp8yFG2/uhre6lQM8DVs4vjJgrfi0i1XN.TUwJ/C',NULL,1,0,'NHdPLIed7AdnEw4KVkVp4O9womzHiC3vAWbda0adV2LiuvAdVYy0HxhnnJKV','2019-02-01 07:56:28','2019-02-01 07:56:28');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avail_flg` int(10) unsigned DEFAULT '1',
  `status` int(10) unsigned DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors`
--

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
INSERT INTO `vendors` VALUES (1,'Apple','apple','vendor/1549095002_iPhone-(Apple)42-b_16.jpg','',1,1,'2019-02-02 01:10:02','2019-02-02 01:10:02'),(2,'Samsung','samsung','vendor/1549095037_Samsung42-b_25.jpg','',1,1,'2019-02-02 01:10:37','2019-02-02 01:10:37'),(3,'Oppo','oppo','vendor/1549095046_OPPO42-b_23.jpg','',1,1,'2019-02-02 01:10:46','2019-02-02 01:10:46'),(4,'Nokia','nokia','vendor/1549095055_Nokia42-b_21.jpg','',1,1,'2019-02-02 01:10:55','2019-02-02 01:10:55'),(5,'Huawei','huawei','vendor/1549095066_Huawei42-b_22.png','',1,1,'2019-02-02 01:11:06','2019-02-02 01:11:06'),(6,'Vsmart','vsmart','vendor/1549095075_Vsmart42-b_40.png','',1,1,'2019-02-02 01:11:15','2019-02-02 01:11:15'),(7,'Xiaomi','xiaomi','vendor/1549095085_Xiaomi42-b_31.png','',1,1,'2019-02-02 01:11:25','2019-02-02 01:11:25'),(8,'Dell','dell','vendor/1549266538_Dell44-b_34.jpg','',1,1,'2019-02-04 00:48:58','2019-02-04 00:48:58'),(9,'Asus','asus','vendor/1549266551_Asus44-b_35.jpg','',1,1,'2019-02-04 00:49:11','2019-02-04 00:49:11'),(10,'HP','hp','vendor/1549266559_HP-Compaq44-b_36.jpg','',1,1,'2019-02-04 00:49:19','2019-02-04 00:49:19'),(11,'Acer','acer','vendor/1549266570_Acer44-b_37.jpg','',1,1,'2019-02-04 00:49:30','2019-02-04 00:49:30'),(12,'Lenovo','lenovo','vendor/1549266582_Lenovo44-b_36.jpg','',1,1,'2019-02-04 00:49:42','2019-02-04 00:49:42');
/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-19 22:52:03
