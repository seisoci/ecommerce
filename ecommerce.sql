-- -------------------------------------------------------------
-- TablePlus 5.0.2(458)
--
-- https://tableplus.com/
--
-- Database: ecommerce
-- Generation Time: 2022-10-23 13:11:29.4810
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_item_id` bigint(20) unsigned zerofill NOT NULL,
  `poster` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `published` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `items_category_item_id_foreign` (`category_item_id`),
  CONSTRAINT `items_category_item_id_foreign` FOREIGN KEY (`category_item_id`) REFERENCES `category_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dashboard_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint unsigned DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `app_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` json NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_global` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_settings_user_id_foreign` (`user_id`),
  CONSTRAINT `app_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_manager_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`),
  KEY `permissions_menu_manager_id_foreign` (`menu_manager_id`),
  CONSTRAINT `permissions_menu_manager_id_foreign` FOREIGN KEY (`menu_manager_id`) REFERENCES `menu_managers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `menu_managers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` tinyint NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('module','header','line','static') COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_managers_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `category_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `permission_role` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `purchase_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `grand_total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `status` enum('cancel','pending','success') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_orders_user_id_foreign` (`user_id`),
  CONSTRAINT `purchase_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `menu_manager_role` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_manager_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_manager_role_menu_manager_id_foreign` (`menu_manager_id`),
  KEY `menu_manager_role_role_id_foreign` (`role_id`),
  CONSTRAINT `menu_manager_role_menu_manager_id_foreign` FOREIGN KEY (`menu_manager_id`) REFERENCES `menu_managers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_manager_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `purchase_order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchase_order_id` bigint unsigned NOT NULL,
  `item_id` bigint unsigned NOT NULL,
  `qty` int NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_order_items_purchase_order_id_foreign` (`purchase_order_id`),
  KEY `purchase_order_items_item_id_foreign` (`item_id`),
  CONSTRAINT `purchase_order_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `purchase_order_items_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `slug`, `dashboard_url`) VALUES
(1, 'Super Admin', 'super-admin', '/backend/users'),
(2, 'Users', 'users', '/backend/dashboard');

INSERT INTO `users` (`id`, `name`, `username`, `email`, `role_id`, `image`, `email_verified_at`, `password`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin', 'admin@example.com', 1, NULL, '2022-10-08 16:07:54', '$2y$10$888TRJwum25JDUZUPkWZ0.xKocEW9RgrcCK6erRGZtkXlARZPh41q', 1, 'cPLkMUp2nV3UhkMa7uC5Ro1al1FY3hVM5VXar70Hb5ifbo2MpPbzRvDLR0ow', '2022-10-08 16:07:54', '2022-10-08 16:07:54'),
(2, 'Users', 'users', 'users@gmail.com', 2, NULL, NULL, '$2y$10$TW8Ak/C9X4iix6jQeqluSer/eZvGVPNjIoU663R.eU6uICRvyO3bG', 1, NULL, '2022-10-11 18:10:29', '2022-10-11 18:10:29'),
(4, 'TEs', 'zyjezijody', 'kuvehucin@gmail.com', 2, NULL, NULL, '$2y$10$NZY4ExeJTQ5peAt1POAyuuwk5q8jStCUExNamWmapeADRP6N9xv1e', 1, NULL, '2022-10-15 19:09:38', '2022-10-15 19:11:30'),
(5, 'Customer', 'customer', 'customer@gmail.com', 2, NULL, NULL, '$2y$10$DGHEayd7.VJx0sVNxn8wzO.iOponbjBqm4FMGvF6J3WaGO7bGsS.C', 1, NULL, '2022-10-23 05:27:21', '2022-10-23 05:27:21');

INSERT INTO `profiles` (`id`, `user_id`, `city`, `address`, `phone`, `postcode`, `created_at`, `updated_at`) VALUES
(1, 2, 'Quasi aliquam et cul', 'Alias sunt eius offi', '+1 (185) 218-1474', 'dsa', '2022-10-11 18:43:57', '2022-10-11 18:49:29'),
(3, 4, 'dsa', 'dsa', '213', 'dsa', '2022-10-15 19:11:30', '2022-10-15 19:11:30'),
(4, 5, 'bandar lampung', 'bandar lampung', '08123456', '123', '2022-10-23 05:28:16', '2022-10-23 05:28:16');

INSERT INTO `app_settings` (`id`, `user_id`, `type`, `name`, `value`, `status`, `is_global`, `created_at`, `updated_at`) VALUES
(1, 1, 'setting', 'layout_setting', '{\"setting\": {\"footer\": {\"value\": \"default\"}, \"app_name\": {\"value\": \"Hope UI\"}, \"card_color\": {\"value\": \"card-default\"}, \"page_layout\": {\"value\": \"container-fluid\"}, \"theme_color\": {\"value\": \"theme-color-default\"}, \"sidebar_type\": {\"value\": []}, \"theme_scheme\": {\"value\": \"light\"}, \"header_banner\": {\"value\": \"default\"}, \"header_navbar\": {\"value\": \"default\"}, \"sidebar_color\": {\"value\": \"sidebar-white\"}, \"theme_font_size\": {\"value\": \"theme-fs-md\"}, \"body_font_family\": {\"value\": null}, \"theme_transition\": {\"value\": null}, \"sidebar_menu_style\": {\"value\": \"left-bordered\"}, \"heading_font_family\": {\"value\": null}, \"theme_scheme_direction\": {\"value\": \"ltr\"}, \"theme_style_appearance\": {\"value\": []}}, \"storeKey\": \"huisetting\", \"saveLocal\": \"\"}', 1, 1, '2022-10-08 16:07:54', '2022-10-08 16:07:54'),
(2, 2, 'setting', 'layout_setting', '{\"setting\": {\"footer\": {\"value\": \"default\"}, \"app_name\": {\"value\": \"Tes\"}, \"card_color\": {\"value\": \"card-default\"}, \"page_layout\": {\"value\": \"container-fluid\"}, \"theme_color\": {\"value\": \"custom\", \"colors\": {\"--{{prefix}}info\": \"#08B1BA\", \"--{{prefix}}primary\": \"#581b98\"}}, \"sidebar_type\": {\"value\": []}, \"theme_scheme\": {\"value\": \"light\"}, \"header_banner\": {\"value\": \"default\"}, \"header_navbar\": {\"value\": \"default\"}, \"sidebar_color\": {\"value\": \"sidebar-white\"}, \"theme_font_size\": {\"value\": \"theme-fs-sm\"}, \"body_font_family\": {\"value\": \"Poppins\"}, \"theme_transition\": {\"value\": \"theme-with-animation\"}, \"sidebar_menu_style\": {\"value\": \"navs-pill-all\"}, \"heading_font_family\": {\"value\": null}, \"theme_scheme_direction\": {\"value\": \"ltr\"}, \"theme_style_appearance\": {\"value\": []}}, \"storeKey\": \"huisetting\", \"saveLocal\": \"\"}', 1, 1, '2022-10-11 18:10:29', '2022-10-11 18:10:29'),
(4, 4, 'setting', 'layout_setting', '{\"setting\": {\"footer\": {\"value\": \"default\"}, \"app_name\": {\"value\": \"Tes\"}, \"card_color\": {\"value\": \"card-default\"}, \"page_layout\": {\"value\": \"container-fluid\"}, \"theme_color\": {\"value\": \"custom\", \"colors\": {\"--{{prefix}}info\": \"#08B1BA\", \"--{{prefix}}primary\": \"#581b98\"}}, \"sidebar_type\": {\"value\": []}, \"theme_scheme\": {\"value\": \"light\"}, \"header_banner\": {\"value\": \"default\"}, \"header_navbar\": {\"value\": \"default\"}, \"sidebar_color\": {\"value\": \"sidebar-white\"}, \"theme_font_size\": {\"value\": \"theme-fs-sm\"}, \"body_font_family\": {\"value\": \"Poppins\"}, \"theme_transition\": {\"value\": \"theme-with-animation\"}, \"sidebar_menu_style\": {\"value\": \"navs-pill-all\"}, \"heading_font_family\": {\"value\": null}, \"theme_scheme_direction\": {\"value\": \"ltr\"}, \"theme_style_appearance\": {\"value\": []}}, \"storeKey\": \"huisetting\", \"saveLocal\": \"\"}', 1, 1, '2022-10-15 19:09:38', '2022-10-15 19:09:38'),
(5, 5, 'setting', 'layout_setting', '{\"setting\": {\"footer\": {\"value\": \"default\"}, \"app_name\": {\"value\": \"Tes\"}, \"card_color\": {\"value\": \"card-default\"}, \"page_layout\": {\"value\": \"container-fluid\"}, \"theme_color\": {\"value\": \"custom\", \"colors\": {\"--{{prefix}}info\": \"#08B1BA\", \"--{{prefix}}primary\": \"#581b98\"}}, \"sidebar_type\": {\"value\": []}, \"theme_scheme\": {\"value\": \"light\"}, \"header_banner\": {\"value\": \"default\"}, \"header_navbar\": {\"value\": \"default\"}, \"sidebar_color\": {\"value\": \"sidebar-white\"}, \"theme_font_size\": {\"value\": \"theme-fs-sm\"}, \"body_font_family\": {\"value\": \"Poppins\"}, \"theme_transition\": {\"value\": \"theme-with-animation\"}, \"sidebar_menu_style\": {\"value\": \"navs-pill-all\"}, \"heading_font_family\": {\"value\": null}, \"theme_scheme_direction\": {\"value\": \"ltr\"}, \"theme_style_appearance\": {\"value\": []}}, \"storeKey\": \"huisetting\", \"saveLocal\": \"\"}', 1, 1, '2022-10-23 05:27:21', '2022-10-23 05:27:21');

INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES
(1, 1, 'Pengguna List', 'users-list'),
(2, 1, 'Pengguna Create', 'users-create'),
(3, 1, 'Pengguna Edit', 'users-edit'),
(4, 1, 'Pengguna Delete', 'users-delete'),
(5, 2, 'Barang List', 'items-list'),
(6, 2, 'Barang Create', 'items-create'),
(7, 2, 'Barang Edit', 'items-edit'),
(8, 2, 'Barang Delete', 'items-delete'),
(9, 3, 'Kategori Barang List', 'category-items-list'),
(10, 3, 'Kategori Barang Create', 'category-items-create'),
(11, 3, 'Kategori Barang Edit', 'category-items-edit'),
(12, 3, 'Kategori Barang Delete', 'category-items-delete'),
(13, 4, 'History Pembelian List', 'history-list'),
(14, 4, 'History Pembelian Create', 'history-create'),
(15, 4, 'History Pembelian Edit', 'history-edit'),
(16, 4, 'History Pembelian Delete', 'history-delete');

INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES
(1, 0, 'Pengguna', 'users', '/backend/users', 'fa-duotone fa-users', 'module', NULL, 1),
(2, 0, 'Barang', 'items', '/backend/items', 'fa-duotone fa-box-archive', 'module', NULL, 3),
(3, 0, 'Kategori Barang', 'category-items', '/backend/category-items', 'fa-duotone fa-thumbtack', 'module', NULL, 2),
(4, 0, 'History Pembelian', 'history', '/backend/history', 'fa-duotone fa-shop', 'module', NULL, 4);

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
(13, 1, 1),
(14, 2, 1),
(15, 3, 1),
(16, 4, 1),
(17, 9, 1),
(18, 10, 1),
(19, 11, 1),
(20, 12, 1),
(21, 5, 1),
(22, 6, 1),
(23, 7, 1),
(24, 8, 1),
(25, 13, 1),
(26, 14, 1),
(27, 15, 1),
(28, 16, 1);

INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES
(4, 1, 1),
(5, 3, 1),
(6, 2, 1),
(7, 4, 1);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;