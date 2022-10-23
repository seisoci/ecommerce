-- -------------------------------------------------------------
-- TablePlus 5.0.2(458)
--
-- https://tableplus.com/
--
-- Database: ecommerce
-- Generation Time: 2022-10-23 13:14:03.3400
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


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