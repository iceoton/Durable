-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jun 07, 2016 at 06:18 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `repair`
--

-- --------------------------------------------------------

--
-- Table structure for table `autonumber`
--

CREATE TABLE `autonumber` (
  `item_number` int(4) UNSIGNED ZEROFILL NOT NULL,
  `finance_number` int(4) UNSIGNED ZEROFILL NOT NULL,
  `quotation_number` int(4) UNSIGNED ZEROFILL NOT NULL,
  `invoice_number` int(4) UNSIGNED ZEROFILL NOT NULL,
  `year` int(4) UNSIGNED ZEROFILL NOT NULL,
  `month` int(2) UNSIGNED ZEROFILL NOT NULL,
  `day` int(2) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `autonumber`
--

INSERT INTO `autonumber` (`item_number`, `finance_number`, `quotation_number`, `invoice_number`, `year`, `month`, `day`) VALUES
(0001, 0001, 0001, 0001, 2016, 05, 18);

-- --------------------------------------------------------

--
-- Table structure for table `backup_logs`
--

CREATE TABLE `backup_logs` (
  `backup_key` varchar(32) NOT NULL,
  `backup_file` varchar(256) NOT NULL,
  `backup_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_key` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `card_info`
--

CREATE TABLE `card_info` (
  `card_key` char(32) NOT NULL,
  `card_code` varchar(16) NOT NULL,
  `card_customer_name` varchar(64) NOT NULL,
  `card_customer_lastname` varchar(64) NOT NULL,
  `card_customer_address` text NOT NULL,
  `card_customer_phone` varchar(128) NOT NULL,
  `card_customer_email` varchar(128) NOT NULL,
  `card_note` text NOT NULL,
  `card_done_aprox` date NOT NULL,
  `user_key` varchar(32) NOT NULL,
  `card_status` varchar(32) NOT NULL,
  `card_insert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `card_info`
--

INSERT INTO `card_info` (`card_key`, `card_code`, `card_customer_name`, `card_customer_lastname`, `card_customer_address`, `card_customer_phone`, `card_customer_email`, `card_note`, `card_done_aprox`, `user_key`, `card_status`, `card_insert`) VALUES
('302adb66891990043f361402c7098222', 'C5U077N1', 'อำนวย', 'รวยล้ำ', '123 หมู่ 1 ', '0812345678', 'test@email.com', '', '2016-05-20', 'c37d695c6f1144abdefa8890a921b8fb', '', '2016-05-18 16:46:49'),
('c3545cddc7ee7f92ee4e2977bbaf97f1', 'CCEHC26L', 'บุญมา', 'ลาภมี', '123 หมู่ 1', '0812345678', 'test@email.com', '', '0000-00-00', '', '', '2016-05-18 16:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `card_item`
--

CREATE TABLE `card_item` (
  `item_key` char(32) NOT NULL,
  `card_key` varchar(32) NOT NULL,
  `item_number` int(11) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `item_note` text NOT NULL,
  `item_price_aprox` float NOT NULL,
  `item_insert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `card_status`
--

CREATE TABLE `card_status` (
  `cstatus_key` char(32) NOT NULL,
  `card_key` varchar(32) NOT NULL,
  `card_status` varchar(32) NOT NULL,
  `card_status_note` text NOT NULL,
  `user_key` varchar(32) NOT NULL,
  `cstatus_insert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `card_status`
--

INSERT INTO `card_status` (`cstatus_key`, `card_key`, `card_status`, `card_status_note`, `user_key`, `cstatus_insert`) VALUES
('18f4e042e428ff1db68eb0c5c6354c49', '302adb66891990043f361402c7098222', '4973069504e1be2a5bdcf7162ade8a16', '', 'c37d695c6f1144abdefa8890a921b8fb', '2016-05-18 16:51:30'),
('aa481003107e6caa06c796ddf3f2b72a', '302adb66891990043f361402c7098222', '89da7d193f3c67e4310f50cbb5b36b90', '', 'c37d695c6f1144abdefa8890a921b8fb', '2016-05-18 16:48:23');

-- --------------------------------------------------------

--
-- Table structure for table `card_type`
--

CREATE TABLE `card_type` (
  `ctype_key` char(32) NOT NULL,
  `ctype_name` varchar(128) NOT NULL,
  `ctype_color` varchar(16) NOT NULL,
  `ctype_status` tinyint(1) NOT NULL,
  `ctype_insert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `card_type`
--

INSERT INTO `card_type` (`ctype_key`, `ctype_name`, `ctype_color`, `ctype_status`, `ctype_insert`) VALUES
('2fdf411856947d19708cf4da19aa3af3', 'เปลี่ยนสินค้าชิ้นใหม่', '#ff6969', 1, '2016-04-25 13:50:59'),
('31c1891444b8e5734bee09165953bca1', 'ไม่สามารถซ่อมได้', '#9e9806', 1, '2016-04-25 13:49:41'),
('4973069504e1be2a5bdcf7162ade8a16', 'ซ่อม/เคลม เสร็จ', '#06d628', 1, '2016-04-25 13:49:21'),
('58dc6633d9c14d0189efd328fc119591', 'ส่งมอบสินค้าคืนลูกค้าเรียบร้อย', '#2958ff', 1, '2016-04-25 13:52:56'),
('89da7d193f3c67e4310f50cbb5b36b90', 'นำรายการซ่อม/เคลม เข้าระบบ', '#29ccff', 1, '2016-04-25 13:23:50'),
('a5eb0dd1c5065bb9fe0cb05d61f03f4a', 'ยกเลิกการซ่อม/เคลม', '#753709', 1, '2016-04-25 13:51:39'),
('b090c4112da52d40a08349b9000dab88', 'ตรวจสอบรายการซ่อม/เคลม', '#c9c9c9', 1, '2016-04-25 13:11:34'),
('b1f4d8a6d50a01b4211fd877f7ae464f', 'ดำเนินการซ่อม/เคลม', '#120eeb', 1, '2016-04-25 13:48:05'),
('c382e352e2e620a3c60a2cc7c6a7fa35', 'ส่งต่อการซ่อม/เคลม', '#d940ff', 1, '2016-04-25 13:48:42'),
('c9934ed002b3a365088862d85604b765', 'เปลี่ยนอะไหล่', '#9c9c9c', 1, '2016-04-25 13:51:16'),
('da144a84c0660c67f115eeefa93dc56f', 'ชำระเงิน', '#ff5c00', 1, '2016-04-25 13:52:35');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `language_code` varchar(16) NOT NULL,
  `language_name` varchar(32) NOT NULL,
  `language_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`language_code`, `language_name`, `language_status`) VALUES
('en', 'English', 0),
('th', 'ภาษาไทย', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `cases` varchar(64) NOT NULL,
  `menu` varchar(64) NOT NULL,
  `pages` varchar(128) NOT NULL,
  `case_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`cases`, `menu`, `pages`, `case_status`) VALUES
('setting', 'setting', 'settings/setting.php', 1),
('member', 'member', 'members/member.php', 1),
('cashier', 'cashier', 'cashier/cashier.php', 1),
('report', 'report', 'report/report.php', 1),
('report_export', 'report', 'report/report_export.php', 1),
('report_movement', 'report', 'report/report_movement.php', 1),
('report_income', 'report', 'report/report_income.php', 1),
('report_income_detail', 'report', 'report/report_income_detail.php', 1),
('report_booking', 'report', 'report/report_booking.php', 1),
('report_logs', 'report', 'report/report_logs.php', 1),
('report_delivery', 'report', 'report/report_delivery.php', 1),
('report_delivery_detail', 'report', 'report/report_delivery_detail.php', 1),
('setting_users', 'setting', 'settings/setting_users.php', 1),
('setting_backup', 'setting', 'settings/setting_backup.php', 1),
('setting_unit', 'setting', 'settings/setting_unit.php', 0),
('setting_categories', 'setting', 'settings/setting_categories.php', 1),
('setting_member_group', 'setting', 'settings/setting_member_group.php', 1),
('setting_promotions', 'setting', 'settings/setting_promotions.php', 1),
('report_debt', 'report', 'report/report_debt.php', 1),
('report_creditor', 'report', 'report/report_creditor.php', 1),
('setting_info', 'setting', 'settings/setting_info.php', 1),
('setting_system', 'setting', 'settings/setting_system.php', 1),
('setting_user_access', 'setting', 'settings/setting_user_access.php', 1),
('administrator_access_list', 'setting', 'administrator/administrator_access_list.php', 1),
('administrator_cases', 'setting', 'administrator/administrator_cases.php', 1),
('administrator_menus', 'setting', 'administrator/administrator_menus.php', 1),
('administrator_modules', 'setting', 'administrator/administrator_modules.php', 1),
('administrator_helper', 'seting', 'administrator/administrator_helper.php', 1),
('cashier_member', 'cashier', 'cashier/cashier_member.php', 1),
('cashier_booking', 'cashier', 'cashier/cashier_booking.php', 1),
('product_detail', 'product', 'products/product_detail.php', 1),
('member_detail', 'member', 'members/member_detail.php', 1),
('new_member', 'member', 'members/new_member.php', 1),
('member_history', 'member', 'members/member_history.php', 1),
('setting_promotion_member', 'setting', 'settings/setting_promotion_member.php', 1),
('report_cancel', 'report', 'report/report_cancel.php', 1),
('card_all_status', 'card', 'card/card_all_status.php', 1),
('search', '', 'main/search.php', 1),
('card', 'card', 'card/card.php', 1),
('setting_card_status', 'setting', 'settings/setting_card_status.php', 1),
('card_create_detail', 'card_create', 'card/card_create_detail.php', 1),
('search_code', '', 'main/search.php', 1),
('card_create', 'card_create', 'card/main.php', 1),
('setting_products', 'setting', 'settings/setting_products.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_key` varchar(16) NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_ipaddress` varchar(32) NOT NULL,
  `log_text` varchar(256) NOT NULL,
  `log_user` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_key`, `log_date`, `log_ipaddress`, `log_text`, `log_user`) VALUES
('44d0a3cce355a5ed', '2016-05-18 15:45:50', '::1', 'dump เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('198f4996db34b087', '2016-05-18 15:48:20', '::1', 'dump ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('ae644b35183b1504', '2016-05-18 15:53:14', '::1', 'iceoton เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('e98b4b97b10bb808', '2016-05-18 16:17:08', '::1', 'iceoton ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('0eca5dddb58d05f0', '2016-05-18 16:17:20', '::1', 'user เข้าสู่ระบบ.', '4928155fe1db71a8065fe0b986c0af8b'),
('d99333836b23d8b4', '2016-05-18 16:20:05', '::1', 'user ออกจากระบบ.', '4928155fe1db71a8065fe0b986c0af8b'),
('dbca7a6db841aee6', '2016-05-18 16:20:18', '::1', 'iceoton เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('237ef3883f0d83d6', '2016-05-25 09:07:53', '::1', 'admin เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('3c5fe776f68b08e4', '2016-05-25 09:11:07', '::1', 'admin ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('28d4b0e30aedaabf', '2016-05-25 09:11:18', '::1', 'admin เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('72a6e1fb586204fb', '2016-05-25 09:48:05', '::1', 'admin เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('ec7bd9d7bf7d99f8', '2016-05-25 10:01:56', '::1', 'admin เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('8662b9cbd949086e', '2016-05-25 10:20:57', '::1', 'admin ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('1c510c6ada044cdb', '2016-05-25 10:21:49', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('cea9ba4ecece6a91', '2016-05-25 10:21:58', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('9c88f5adaf1d8cf3', '2016-05-25 10:22:06', '::1', 'admin เข้าสู่ระบบ.', '4928155fe1db71a8065fe0b986c0af8b'),
('565283287464cb64', '2016-05-25 10:22:31', '::1', 'admin ออกจากระบบ.', '4928155fe1db71a8065fe0b986c0af8b'),
('1522025cb983ba43', '2016-05-25 10:22:35', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('c67561d4eca01915', '2016-05-25 10:22:59', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('5f0dc621b347f39d', '2016-05-25 10:23:12', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('bd89bf1551ee912b', '2016-05-25 10:23:18', '::1', 'admin เข้าสู่ระบบ.', '4928155fe1db71a8065fe0b986c0af8b'),
('eb6291282884ade0', '2016-06-01 02:38:55', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('ba69651010de973b', '2016-06-01 02:49:33', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('bb161a2e8a19b2b2', '2016-06-01 02:49:37', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('c8dee9255f59dfa4', '2016-06-01 02:49:40', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('199b5d6e4afb83da', '2016-06-01 02:49:42', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('7ed5bb91f7c2ece4', '2016-06-01 02:49:44', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('53a64585c53b0414', '2016-06-01 02:49:45', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('c014cb59d80054b2', '2016-06-01 02:49:47', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('cb84ac184229feaa', '2016-06-01 02:49:48', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('71d774e77aa1c872', '2016-06-01 02:49:50', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('0c04b772dac75743', '2016-06-01 02:49:51', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('7bfd0a4c6b144d08', '2016-06-01 02:49:52', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('458a5ebaa62e4e5d', '2016-06-01 02:49:54', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('c30695ca516017b2', '2016-06-01 02:49:55', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('340c3c2bb63bf6d3', '2016-06-01 02:49:56', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('b3b4a015cc188c03', '2016-06-01 02:49:57', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('19bb8a9ebc4b9385', '2016-06-01 02:49:58', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('e5d356e3c92f7ac0', '2016-06-01 02:50:03', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('22600d5fe08bd294', '2016-06-01 02:50:04', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('2b20a24ed43badbe', '2016-06-01 02:50:05', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('7423d3657eda6340', '2016-06-01 02:50:06', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('677c47cfe8a32ce9', '2016-06-01 02:50:07', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('f17a0fb0701ffe73', '2016-06-01 02:50:08', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('b4c0a5ac5c660db2', '2016-06-01 02:50:10', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('a15d0a27dd86cd19', '2016-06-01 02:50:11', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('3af59553d329ccfa', '2016-06-01 02:50:12', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('f6083425c232df5a', '2016-06-01 02:50:49', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('d7eb26ab84962a8c', '2016-06-01 02:50:51', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('0d4cec83927e548d', '2016-06-01 02:50:52', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('16d3a8cea9d2cd12', '2016-06-01 02:50:53', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('7c1d87f15048d7a9', '2016-06-01 02:50:55', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('89313de48f77b79a', '2016-06-01 02:50:56', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('028eba5351758d31', '2016-06-01 02:50:57', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('02338d3c3a97c5be', '2016-06-01 02:50:59', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('25ace0d1f36aa92f', '2016-06-01 02:51:00', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('dc8dcdc9a86cebd3', '2016-06-01 02:51:01', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('c5bc3fedf02d21eb', '2016-06-01 02:51:02', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('4f713ee1c9900561', '2016-06-01 02:51:03', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('3c8cdcae919096e7', '2016-06-01 02:51:29', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('34a22931fc83630c', '2016-06-01 02:51:31', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('213837997916c7f7', '2016-06-01 03:03:51', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('037e9da546d3fdc4', '2016-06-07 15:42:29', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('96bcddf69accdb8c', '2016-06-07 15:50:55', '::1', 'root ออกจากระบบ.', 'c37d695c6f1144abdefa8890a921b8fb'),
('8663ce8b281b008d', '2016-06-07 15:50:57', '::1', 'root เข้าสู่ระบบ.', 'c37d695c6f1144abdefa8890a921b8fb');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_key` char(32) NOT NULL,
  `menu_upkey` char(32) NOT NULL,
  `menu_icon` varchar(256) NOT NULL,
  `menu_name` varchar(128) NOT NULL,
  `menu_case` varchar(128) NOT NULL,
  `menu_link` varchar(256) NOT NULL,
  `menu_status` tinyint(1) NOT NULL,
  `menu_sorting` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_key`, `menu_upkey`, `menu_icon`, `menu_name`, `menu_case`, `menu_link`, `menu_status`, `menu_sorting`) VALUES
('0a3c8aabc6cdbce67a157ba1701b3fa9', '0a3c8aabc6cdbce67a157ba1701b3fa9', '<i class="fa fa-pie-chart fa-fw"></i>', 'LA_MN_REPORT', 'report', '?p=report', 1, 3),
('2309e0cdb2c541bf7cb8ef0dee7b7eba', '2309e0cdb2c541bf7cb8ef0dee7b7eba', '<i class="fa fa-gear  fa-fw"></i>', 'LA_MN_SETTING', 'setting', '?p=setting', 1, 5),
('26f7e62109e2566eaec8b01fe8e3598d', '26f7e62109e2566eaec8b01fe8e3598d', '<i class="fa fa-edit fa-fw"></i>', 'ส่งซ่อมสินค้า/เคลม', 'card_create', '?p=card_create', 1, 98),
('295744c466c17b46170f88b5c1b9104d', '295744c466c17b46170f88b5c1b9104d', '<i class="fa fa-list fa-fw"></i>', 'รายการส่งซ่อม/เคลม<span class=', 'card', '?p=card', 1, 99),
('439c4113b058975e22f776669bb36bf0', 'ff7d5a554f4300b09f2de2e06d523be9', '<i class="fa flaticon-stack4 fa-fw"></i>', 'LA_MN_PRODUCTS_DATA', 'product', '?p=product', 1, 31),
('a16043256ea5ca0ea86995e2b69ec238', 'a16043256ea5ca0ea86995e2b69ec238', '<i class="fa fa-home fa-fw"></i>', 'LA_MN_HOME', '', 'index.php', 1, 1),
('b15612beeab346d8359a66a03d9e00a2', 'b15612beeab346d8359a66a03d9e00a2', '<i class="fa fa-edit fa-fw"></i>', 'ครุภัณฑ์', 'durable', '?p=durable', 1, 2),
('c6c8729b45d1fec563f8453c16ff03b8', 'c6c8729b45d1fec563f8453c16ff03b8', '<i class="fa fa-lock fa-fw"></i>', 'LA_MN_LOGOUT', 'logout', '../core/logout.core.php', 1, 6),
('f1344bc0fb9c5594fa0e3d3f37a56957', 'f1344bc0fb9c5594fa0e3d3f37a56957', '<i class="fa fa-users fa-fw"></i>', 'LA_MN_MEMBERS', 'member', '?p=member', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `system_font_size`
--

CREATE TABLE `system_font_size` (
  `font_key` char(32) NOT NULL,
  `font_name` varchar(128) NOT NULL,
  `font_size_text` text NOT NULL,
  `font_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_font_size`
--

INSERT INTO `system_font_size` (`font_key`, `font_name`, `font_size_text`, `font_status`) VALUES
('6c3ca25445248c1dff79d51ad9fa4082', '14px', 'font-size:14px;', 1),
('74af75636b4e933684d63b617c97f398', '24px', 'font-size:24px;', 1),
('bffeb9ae0d04ffc7affc3701f9858932', '22px', 'font-size:22px;', 1),
('dd7e28065e654467be0f9c16f3bd987d', '16px', 'font-size:16px;', 1),
('e215155479796a0bdcad2326ffca09c7', '18px', 'font-size:18px;', 1),
('ff9ec5b758824e67edcf5ecc7e635f6f', '20px', 'font-size:20px;', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `site_key` char(32) NOT NULL,
  `site_logo` varchar(256) NOT NULL,
  `site_favicon` varchar(256) NOT NULL,
  `time_zone` varchar(128) NOT NULL,
  `year_type` varchar(16) NOT NULL,
  `year_format` varchar(32) NOT NULL,
  `booking_logo_en` varchar(128) NOT NULL,
  `booking_title_en` varchar(128) NOT NULL,
  `booking_note1_en` text NOT NULL,
  `booking_note2_en` text NOT NULL,
  `booking_logo_th` varchar(128) NOT NULL,
  `booking_title_th` varchar(128) NOT NULL,
  `booking_note1_th` text NOT NULL,
  `booking_note2_th` text NOT NULL,
  `reciept_logo_en` varchar(128) NOT NULL,
  `reciept_title_en` varchar(128) NOT NULL,
  `reciept_note1_en` text NOT NULL,
  `reciept_note2_en` text NOT NULL,
  `reciept_logo_th` varchar(128) NOT NULL,
  `reciept_title_th` varchar(128) NOT NULL,
  `reciept_note1_th` text NOT NULL,
  `reciept_note2_th` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`site_key`, `site_logo`, `site_favicon`, `time_zone`, `year_type`, `year_format`, `booking_logo_en`, `booking_title_en`, `booking_note1_en`, `booking_note2_en`, `booking_logo_th`, `booking_title_th`, `booking_note1_th`, `booking_note2_th`, `reciept_logo_en`, `reciept_title_en`, `reciept_note1_en`, `reciept_note2_en`, `reciept_logo_th`, `reciept_title_th`, `reciept_note1_th`, `reciept_note2_th`) VALUES
('8f411b77c389d5de467af8f2c0e91cda', 'Banner.png', 'Logo_64px.png', 'Asia/Bangkok', 'BE', '3', 'logo.png', 'Booking Slip', 'Name..............................................<br/>Address..............................................................................<br/>Tel................................................................', '', 'logo.png', 'ใบจองห้องพัก', 'ชื่อ..............................................<br/>ที่อยู่..............................................................................<br/>โทร................................................................', '', 'logo.png', 'Reciept', 'Name..............................................<br/>Address..............................................................................<br/>Tel................................................................', '', 'logo.png', 'ใบเสร็จรับเงิน', 'ชื่อ..............................................<br/>ที่อยู่..............................................................................<br/>โทร................................................................', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_key` char(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `user_photo` varchar(128) NOT NULL DEFAULT 'noimg.jpg',
  `user_class` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=user,2=admin,3=super admin',
  `bed_view` varchar(64) NOT NULL DEFAULT 'box_view',
  `user_language` varchar(8) NOT NULL DEFAULT 'th',
  `system_font_size` varchar(32) NOT NULL DEFAULT 'dd7e28065e654467be0f9c16f3bd987d',
  `email` varchar(128) NOT NULL,
  `user_status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_key`, `name`, `lastname`, `username`, `password`, `user_photo`, `user_class`, `bed_view`, `user_language`, `system_font_size`, `email`, `user_status`) VALUES
('c37d695c6f1144abdefa8890a921b8fb', 'Super', 'Admin', 'root', 'deaad792606928825c0bf85cd46e9edf', '13308775c29bbbd010880760de37b03c.jpeg', 3, 'box_view', 'th', 'dd7e28065e654467be0f9c16f3bd987d', 'iceoton@gmail.com', 1),
('4928155fe1db71a8065fe0b986c0af8b', 'Admin', 'Naja', 'admin', 'deaad792606928825c0bf85cd46e9edf', 'noimg.jpg', 2, 'box_view', 'th', 'dd7e28065e654467be0f9c16f3bd987d', 'admin@email.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_online`
--

CREATE TABLE `user_online` (
  `osession` varchar(128) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `user_key` varchar(32) CHARACTER SET utf8 NOT NULL,
  `otime` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_online`
--

INSERT INTO `user_online` (`osession`, `user_key`, `otime`) VALUES
('e2a8b3fca61b48a21480f1ea44c84e2e', 'c37d695c6f1144abdefa8890a921b8fb', 1465315735);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autonumber`
--
ALTER TABLE `autonumber`
  ADD PRIMARY KEY (`finance_number`);

--
-- Indexes for table `backup_logs`
--
ALTER TABLE `backup_logs`
  ADD PRIMARY KEY (`backup_key`);

--
-- Indexes for table `card_info`
--
ALTER TABLE `card_info`
  ADD PRIMARY KEY (`card_key`);

--
-- Indexes for table `card_item`
--
ALTER TABLE `card_item`
  ADD PRIMARY KEY (`item_key`);

--
-- Indexes for table `card_status`
--
ALTER TABLE `card_status`
  ADD PRIMARY KEY (`cstatus_key`);

--
-- Indexes for table `card_type`
--
ALTER TABLE `card_type`
  ADD PRIMARY KEY (`ctype_key`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`language_code`);

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`cases`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_key`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_key`),
  ADD UNIQUE KEY `user_key` (`user_key`),
  ADD UNIQUE KEY `user_key_2` (`user_key`);
