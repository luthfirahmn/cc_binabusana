-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1,	'admin',	'Administrator');

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `login` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `time` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `url` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `icon` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `active` int NOT NULL,
  `parent` int NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `menu` (`id`, `name`, `url`, `icon`, `active`, `parent`, `is_admin`) VALUES
(6,	'Asset',	'asset',	'fas fa-building',	1,	7,	1),
(7,	'Master',	'-',	'fas fa-database',	1,	0,	1),
(8,	'Status',	'status',	'fas fa-check-double',	1,	7,	1),
(9,	'Asset Type',	'asset_type',	'fab fa-typo3',	1,	7,	1),
(10,	'Customer',	'customer',	'fas fa-user',	1,	7,	1),
(11,	'Area',	'area',	'far fa-compass',	1,	7,	1),
(12,	'Transaction',	'-',	'fas fa-shopping-cart',	1,	0,	1),
(13,	'Booking',	'booking',	'fas fa-book-open',	1,	12,	1);

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `ms_area`;
CREATE TABLE `ms_area` (
  `id` int NOT NULL AUTO_INCREMENT,
  `area_code` varchar(20) NOT NULL,
  `area_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `ms_area` (`id`, `area_code`, `area_name`) VALUES
(1,	'AR00001',	'Tangerang'),
(2,	'AR00002',	'Jakarta'),
(3,	'AR00003',	'Bandung');

DROP TABLE IF EXISTS `ms_asset`;
CREATE TABLE `ms_asset` (
  `id` int NOT NULL AUTO_INCREMENT,
  `asset_code` varchar(20) NOT NULL,
  `asset_name` varchar(50) NOT NULL,
  `asset_type_code` varchar(20) NOT NULL,
  `area_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status_id` tinyint(1) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `ms_asset` (`id`, `asset_code`, `asset_name`, `asset_type_code`, `area_code`, `price`, `status_id`, `created_time`, `updated_time`) VALUES
(4,	'ASE00001',	'Gedung Jakarta',	'AST00001',	'AR00002',	1000000.00,	1,	'2022-11-17 16:03:40',	'2022-11-17 16:03:40'),
(5,	'ASE00002',	'Gedung Serba Guna Jakarta',	'AST00002',	'AR00002',	700000.00,	1,	'2022-11-17 16:03:34',	'2022-11-17 16:03:34'),
(6,	'ASE00003',	'Gedung Atlass',	'AST00001',	'AR00003',	500000.00,	1,	'2022-11-17 16:03:24',	'2022-11-17 16:03:24'),
(7,	'ASE00004',	'Gedung Pertiwi',	'AST00001',	'AR00002',	1500000.00,	1,	'2022-11-19 04:15:45',	'2022-11-19 04:15:45'),
(8,	'ASE00005',	'Gedung Pertiwi',	'AST00003',	'AR00002',	1000000.00,	4,	'2022-11-17 16:03:10',	'2022-11-19 05:14:57');

DROP TABLE IF EXISTS `ms_asset_type`;
CREATE TABLE `ms_asset_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `asset_type_code` varchar(20) NOT NULL,
  `desc` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `ms_asset_type` (`id`, `asset_type_code`, `desc`) VALUES
(5,	'AST00001',	'Open Office'),
(6,	'AST00002',	'Hall'),
(7,	'AST00003',	'Meeting');

DROP TABLE IF EXISTS `ms_customer`;
CREATE TABLE `ms_customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `ms_customer` (`id`, `customer_code`, `name`, `email`, `phone`, `created_time`, `updated_time`) VALUES
(2,	'CST00001',	'Dadang Suranjana',	'luthfirrahman696@gmail.com',	412412412,	'2022-11-19 02:24:01',	'2022-11-19 02:24:01'),
(3,	'CST00002',	'Muhamad Luthfi',	'luthfirrahman696@gmail.com',	2147483647,	'2022-11-19 05:06:35',	'2022-11-19 05:06:35');

DROP TABLE IF EXISTS `ms_status`;
CREATE TABLE `ms_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status_type` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `ms_status` (`id`, `status_type`, `status`) VALUES
(1,	'ASSET',	'Vaccant'),
(4,	'ASSET',	'Booked'),
(5,	'ASSET',	'Rent'),
(6,	'SEWA',	'Accepted'),
(7,	'SEWA',	'Reject'),
(8,	'SEWA',	'Pending');

DROP TABLE IF EXISTS `tr_booking`;
CREATE TABLE `tr_booking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trx_code` varchar(20) NOT NULL,
  `customer_code` varchar(20) NOT NULL,
  `asset_code` varchar(20) NOT NULL,
  `trx_date_from` date NOT NULL,
  `trx_date_to` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status_id` tinyint(1) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tr_booking` (`id`, `trx_code`, `customer_code`, `asset_code`, `trx_date_from`, `trx_date_to`, `total_price`, `status_id`, `created_time`, `updated_time`) VALUES
(2,	'TRX00002',	'CST00002',	'ASE00005',	'2022-11-19',	'2022-11-20',	1000000.00,	6,	'2022-11-19 05:06:36',	'2022-11-19 05:14:56');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `salt` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `activation_code` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `active_code` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `forgotten_password_code` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `forgotten_password_time` int unsigned DEFAULT NULL,
  `remember_code` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `created_on` int unsigned NOT NULL,
  `last_login` int unsigned DEFAULT NULL,
  `active` tinyint unsigned DEFAULT NULL,
  `activation` tinyint(1) DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `company` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `img_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `active_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `activation`, `first_name`, `last_name`, `company`, `phone`, `img_name`) VALUES
(1,	'::1',	'admin',	'$2y$08$TjLyGrbOtG9tKSs5j8dkqekWBVmrInCkfmkY6ZKbSwXSyeYjBR9pG',	NULL,	'ruang.public@rp.com',	NULL,	'FE6878',	NULL,	NULL,	'wY3MwP9gxCL05c23eFl0te',	1589403512,	1668792304,	1,	1,	'RUANG',	'PUBLIC',	'PT Ruang Public',	'02215521',	'user_X7ZVFhLdm6.jpg');

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `group_id` mediumint unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1,	1,	1);

-- 2022-11-18 22:42:35
