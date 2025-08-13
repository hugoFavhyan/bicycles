-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               9.1.0 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for qr_bicicles
CREATE DATABASE IF NOT EXISTS `qr_bicicles` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `qr_bicicles`;

-- Dumping structure for table qr_bicicles.bicycles
CREATE TABLE IF NOT EXISTS `bicycles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `brand` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `serial` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bicycles_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table qr_bicicles.bicycles: 3 rows
/*!40000 ALTER TABLE `bicycles` DISABLE KEYS */;
INSERT IGNORE INTO `bicycles` (`id`, `user_id`, `brand`, `color`, `created_at`, `updated_at`, `serial`) VALUES
	(1, 1, 'racer', 'negra', '2025-08-12 04:32:10', '2025-08-12 04:32:10', '1234s'),
	(2, 1, 'drive', 'azul', '2025-08-12 04:56:42', '2025-08-12 04:56:42', '666'),
	(3, 1, 'lllb', 'roja', '2025-08-12 14:19:26', '2025-08-12 14:19:26', '1234sj');
/*!40000 ALTER TABLE `bicycles` ENABLE KEYS */;

-- Dumping structure for table qr_bicicles.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table qr_bicicles.migrations: 7 rows
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT IGNORE INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2025-08-12-013330', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1754962542, 1),
	(2, '2025-08-12-013406', 'App\\Database\\Migrations\\CreateBicyclesTable', 'default', 'App', 1754962542, 1),
	(3, '2025-08-12-013448', 'App\\Database\\Migrations\\CreateParkingTable', 'default', 'App', 1754962542, 1),
	(4, '2025-08-12-015102', 'App\\Database\\Migrations\\AddPasswordToUsers', 'default', 'App', 1754963496, 2),
	(5, '2025-08-12-030607', 'App\\Database\\Migrations\\AddSerialToBicycles', 'default', 'App', 1754968019, 3),
	(6, '2025-08-12-031434', 'App\\Database\\Migrations\\CreateOrdersTable', 'default', 'App', 1754968505, 4),
	(7, '2025-08-12-051747', 'App\\Database\\Migrations\\AddStatusToOrders', 'default', 'App', 1754975976, 5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table qr_bicicles.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `parking_id` int unsigned NOT NULL,
  `order_data` json NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_parking_id_foreign` (`parking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table qr_bicicles.orders: 5 rows
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT IGNORE INTO `orders` (`id`, `user_id`, `parking_id`, `order_data`, `total_amount`, `created_at`, `updated_at`, `status`) VALUES
	(27, 1, 18, '{"date": "2025-08-12 14:19:43", "bicycle": {"id": "3", "brand": "lllb", "color": "roja", "serial": "1234sj", "user_id": "1", "created_at": "2025-08-12 14:19:26", "updated_at": "2025-08-12 14:19:26"}}', 1500.00, '2025-08-12 14:19:43', '2025-08-12 14:19:43', 'pending'),
	(26, 1, 17, '{"date": "2025-08-12 14:18:15", "bicycle": {"id": "1", "brand": "racer", "color": "negra", "serial": "1234s", "user_id": "1", "created_at": "2025-08-12 04:32:10", "updated_at": "2025-08-12 04:32:10"}}', 1500.00, '2025-08-12 14:18:15', '2025-08-12 14:18:15', 'pending'),
	(25, 1, 16, '{"date": "2025-08-12 12:55:18", "bicycle": {"id": "1", "brand": "racer", "color": "negra", "serial": "1234s", "user_id": "1", "created_at": "2025-08-12 04:32:10", "updated_at": "2025-08-12 04:32:10"}}', 938.33, '2025-08-12 12:55:18', '2025-08-12 12:55:18', 'pending'),
	(24, 1, 1, '{"date": "2025-08-12 06:07:39", "bicycle": {"id": "1", "brand": "racer", "color": "negra", "serial": "1234s", "user_id": "1", "created_at": "2025-08-12 04:32:10", "updated_at": "2025-08-12 04:32:10"}}', 9531.67, '2025-08-12 06:07:39', '2025-08-12 06:07:39', 'pending'),
	(23, 1, 1, '{"date": "2025-08-12 05:55:24", "bicycle": {"id": "1", "brand": "racer", "color": "negra", "serial": "1234s", "user_id": "1", "created_at": "2025-08-12 04:32:10", "updated_at": "2025-08-12 04:32:10"}}', 8306.67, '2025-08-12 05:55:24', '2025-08-12 05:55:24', 'approved');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table qr_bicicles.parking
CREATE TABLE IF NOT EXISTS `parking` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `bicycle_id` int unsigned NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime DEFAULT NULL,
  `total_paid` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parking_bicycle_id_foreign` (`bicycle_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table qr_bicicles.parking: 6 rows
/*!40000 ALTER TABLE `parking` DISABLE KEYS */;
INSERT IGNORE INTO `parking` (`id`, `bicycle_id`, `start_time`, `end_time`, `total_paid`, `created_at`, `updated_at`) VALUES
	(18, 3, '2025-08-12 14:19:32', '2025-08-12 14:19:43', NULL, '2025-08-12 14:19:32', '2025-08-12 14:19:43'),
	(17, 1, '2025-08-12 14:18:12', '2025-08-12 14:18:15', NULL, '2025-08-12 14:18:12', '2025-08-12 14:18:15'),
	(16, 1, '2025-08-12 12:45:55', '2025-08-12 12:47:58', NULL, '2025-08-12 12:45:55', '2025-08-12 12:47:58'),
	(15, 1, '2025-08-12 12:34:29', '2025-08-12 12:34:33', NULL, '2025-08-12 12:34:29', '2025-08-12 12:34:33'),
	(14, 1, '2025-08-12 12:34:02', '2025-08-12 12:34:05', NULL, '2025-08-12 12:34:02', '2025-08-12 12:34:05'),
	(13, 1, '2025-08-12 12:22:58', '2025-08-12 12:32:08', NULL, '2025-08-12 12:22:58', '2025-08-12 12:32:08');
/*!40000 ALTER TABLE `parking` ENABLE KEYS */;

-- Dumping structure for table qr_bicicles.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table qr_bicicles.users: 1 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `created_at`, `updated_at`, `password`) VALUES
	(1, 'favhyan', 'favhyan@gmail.com', '2025-08-12 02:58:53', '2025-08-12 02:58:53', '$2y$10$eQa0SV9a0kH2hLjec2NX9eofOHxZ3Q7oXTkNpHeFtLxqTgye92L4u');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
