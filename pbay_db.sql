-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.37 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for pbay_db
CREATE DATABASE IF NOT EXISTS `pbay_db` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pbay_db`;

-- Dumping structure for table pbay_db.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.brand: ~4 rows (approximately)
INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
	(1, 'Apple'),
	(2, 'Huawei'),
	(3, 'Samsung'),
	(4, 'Asus');

-- Dumping structure for table pbay_db.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `qty` int DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  KEY `fk_cart_product1_idx` (`product_id`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.cart: ~0 rows (approximately)

-- Dumping structure for table pbay_db.category
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.category: ~1 rows (approximately)
INSERT INTO `category` (`cat_id`, `category_name`) VALUES
	(1, 'Mobiles');

-- Dumping structure for table pbay_db.category_has_brand
CREATE TABLE IF NOT EXISTS `category_has_brand` (
  `category_cat_id` int NOT NULL,
  `brand_brand_id` int NOT NULL,
  KEY `fk_category_has_brand_brand1_idx` (`brand_brand_id`),
  KEY `fk_category_has_brand_category1_idx` (`category_cat_id`),
  CONSTRAINT `fk_category_has_brand_brand1` FOREIGN KEY (`brand_brand_id`) REFERENCES `brand` (`brand_id`),
  CONSTRAINT `fk_category_has_brand_category1` FOREIGN KEY (`category_cat_id`) REFERENCES `category` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.category_has_brand: ~4 rows (approximately)
INSERT INTO `category_has_brand` (`category_cat_id`, `brand_brand_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(1, 4);

-- Dumping structure for table pbay_db.city
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `city_name` varchar(45) DEFAULT NULL,
  `district_district_id` int NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `fk_city_district1_idx` (`district_district_id`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_district_id`) REFERENCES `district` (`district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.city: ~0 rows (approximately)

-- Dumping structure for table pbay_db.color
CREATE TABLE IF NOT EXISTS `color` (
  `clr_id` int NOT NULL AUTO_INCREMENT,
  `clr_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`clr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.color: ~4 rows (approximately)
INSERT INTO `color` (`clr_id`, `clr_name`) VALUES
	(1, 'Black'),
	(2, 'Purple'),
	(3, 'Blue'),
	(4, 'Red');

-- Dumping structure for table pbay_db.condition
CREATE TABLE IF NOT EXISTS `condition` (
  `condition_id` int NOT NULL AUTO_INCREMENT,
  `condition_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`condition_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.condition: ~2 rows (approximately)
INSERT INTO `condition` (`condition_id`, `condition_name`) VALUES
	(1, 'Brand New'),
	(2, 'Used');

-- Dumping structure for table pbay_db.district
CREATE TABLE IF NOT EXISTS `district` (
  `district_id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(45) DEFAULT NULL,
  `province_province_id` int NOT NULL,
  PRIMARY KEY (`district_id`),
  KEY `fk_district_province1_idx` (`province_province_id`),
  CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_province_id`) REFERENCES `province` (`province_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.district: ~0 rows (approximately)

-- Dumping structure for table pbay_db.model
CREATE TABLE IF NOT EXISTS `model` (
  `model_id` int NOT NULL AUTO_INCREMENT,
  `model_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.model: ~12 rows (approximately)
INSERT INTO `model` (`model_id`, `model_name`) VALUES
	(1, 'iPhone 6'),
	(2, 'iPhone 6s'),
	(3, 'iPhone 7'),
	(4, 'iPhone 7 Plus'),
	(5, 'iPhone 8'),
	(6, 'iPhone 8 Plus'),
	(7, 'iPhone X'),
	(8, 'iPhone 11'),
	(9, 'iPhone 12'),
	(10, 'iPhone 13'),
	(11, 'iPhone 14'),
	(12, 'iPhone 14 Pro');

-- Dumping structure for table pbay_db.model_has_brand
CREATE TABLE IF NOT EXISTS `model_has_brand` (
  `model_model_id` int NOT NULL,
  `brand_brand_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_model_has_brand_brand1_idx` (`brand_brand_id`),
  KEY `fk_model_has_brand_model1_idx` (`model_model_id`),
  CONSTRAINT `fk_model_has_brand_brand1` FOREIGN KEY (`brand_brand_id`) REFERENCES `brand` (`brand_id`),
  CONSTRAINT `fk_model_has_brand_model1` FOREIGN KEY (`model_model_id`) REFERENCES `model` (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.model_has_brand: ~1 rows (approximately)
INSERT INTO `model_has_brand` (`model_model_id`, `brand_brand_id`, `id`) VALUES
	(12, 1, 1);

-- Dumping structure for table pbay_db.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `description` text,
  `title` varchar(100) DEFAULT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `delivery_fee_colombo` double DEFAULT NULL,
  `delivery_fee_other` double DEFAULT NULL,
  `category_cat_id` int NOT NULL,
  `model_has_brand_id` int NOT NULL,
  `condition_condition_id` int NOT NULL,
  `status_status_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_cat_id`),
  KEY `fk_product_model_has_brand1_idx` (`model_has_brand_id`),
  KEY `fk_product_condition1_idx` (`condition_condition_id`),
  KEY `fk_product_status1_idx` (`status_status_id`),
  KEY `fk_product_user1_idx` (`user_email`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_cat_id`) REFERENCES `category` (`cat_id`),
  CONSTRAINT `fk_product_condition1` FOREIGN KEY (`condition_condition_id`) REFERENCES `condition` (`condition_id`),
  CONSTRAINT `fk_product_model_has_brand1` FOREIGN KEY (`model_has_brand_id`) REFERENCES `model_has_brand` (`id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `fk_product_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.product: ~1 rows (approximately)
INSERT INTO `product` (`id`, `price`, `qty`, `description`, `title`, `datetime_added`, `delivery_fee_colombo`, `delivery_fee_other`, `category_cat_id`, `model_has_brand_id`, `condition_condition_id`, `status_status_id`, `user_email`) VALUES
	(1, 480000, 10, NULL, 'Apple iPhone 14 Pro', '2024-05-24 09:47:57', 250, 500, 1, 1, 1, 1, 'ogpmadhuwantha678@gmail.com');

-- Dumping structure for table pbay_db.product_has_color
CREATE TABLE IF NOT EXISTS `product_has_color` (
  `product_id` int NOT NULL,
  `color_clr_id` int NOT NULL,
  KEY `fk_product_has_color_color1_idx` (`color_clr_id`),
  KEY `fk_product_has_color_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_has_color_color1` FOREIGN KEY (`color_clr_id`) REFERENCES `color` (`clr_id`),
  CONSTRAINT `fk_product_has_color_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.product_has_color: ~1 rows (approximately)
INSERT INTO `product_has_color` (`product_id`, `color_clr_id`) VALUES
	(1, 2);

-- Dumping structure for table pbay_db.product_img
CREATE TABLE IF NOT EXISTS `product_img` (
  `img_path` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`img_path`),
  KEY `fk_product_img_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_img_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.product_img: ~1 rows (approximately)
INSERT INTO `product_img` (`img_path`, `product_id`) VALUES
	('img/mobile/apple1.png', 1);

-- Dumping structure for table pbay_db.province
CREATE TABLE IF NOT EXISTS `province` (
  `province_id` int NOT NULL AUTO_INCREMENT,
  `province_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.province: ~0 rows (approximately)

-- Dumping structure for table pbay_db.status
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.status: ~2 rows (approximately)
INSERT INTO `status` (`status_id`, `status`) VALUES
	(1, 'Active'),
	(2, 'Inactive');

-- Dumping structure for table pbay_db.user
CREATE TABLE IF NOT EXISTS `user` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `joined_date` datetime DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `status_status_id` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`email`),
  KEY `fk_user_status1_idx` (`status_status_id`),
  CONSTRAINT `fk_user_status1` FOREIGN KEY (`status_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.user: ~2 rows (approximately)
INSERT INTO `user` (`fname`, `lname`, `email`, `password`, `mobile`, `joined_date`, `verification_code`, `status_status_id`) VALUES
	('Heshan', 'Tharusha', 'heshant@gmail.com', '12345h@', '0745163257', NULL, '510717', 1),
	('Pasindu', 'Madhuwantha', 'ogpmadhuwantha678@gmail.com', '12345p@', '0715518744', NULL, NULL, 1);

-- Dumping structure for table pbay_db.user_has_address
CREATE TABLE IF NOT EXISTS `user_has_address` (
  `user_email` varchar(100) NOT NULL,
  `city_city_id` int NOT NULL,
  `address_id` int NOT NULL AUTO_INCREMENT,
  `line1` varchar(45) DEFAULT NULL,
  `line2` varchar(45) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`address_id`),
  KEY `fk_user_has_city_city1_idx` (`city_city_id`),
  KEY `fk_user_has_city_user1_idx` (`user_email`),
  CONSTRAINT `fk_user_has_city_city1` FOREIGN KEY (`city_city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_user_has_city_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.user_has_address: ~0 rows (approximately)

-- Dumping structure for table pbay_db.user_img
CREATE TABLE IF NOT EXISTS `user_img` (
  `path` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_user_img_user1_idx` (`user_email`),
  CONSTRAINT `fk_user_img_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.user_img: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
