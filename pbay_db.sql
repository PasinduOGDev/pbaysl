-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.37 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.7.0.6868
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.brand: ~9 rows (approximately)
INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
	(1, 'Apple'),
	(2, 'Samsung'),
	(3, 'Asus'),
	(4, 'Xiaomi'),
	(5, 'Vivo'),
	(6, 'MSI'),
	(7, 'Huawei'),
	(8, 'HP'),
	(10, 'Nokia');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.cart: ~1 rows (approximately)
INSERT INTO `cart` (`cart_id`, `qty`, `user_email`, `product_id`) VALUES
	(8, 6, 'ogpmadhuwantha678@gmail.com', 13);

-- Dumping structure for table pbay_db.category
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.category: ~2 rows (approximately)
INSERT INTO `category` (`cat_id`, `category_name`) VALUES
	(1, 'Mobiles'),
	(13, 'Laptops');

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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.city: ~50 rows (approximately)
INSERT INTO `city` (`city_id`, `city_name`, `district_district_id`) VALUES
	(1, 'Colombo', 1),
	(2, 'Dehiwala', 1),
	(3, 'Mount Lavinia', 1),
	(4, 'Negombo', 2),
	(5, 'Gampaha', 2),
	(6, 'Kalutara', 3),
	(7, 'Kandy', 4),
	(8, 'Peradeniya', 4),
	(9, 'Matale', 5),
	(10, 'Nuwara Eliya', 6),
	(11, 'Galle', 7),
	(12, 'Matara', 8),
	(13, 'Hambantota', 9),
	(14, 'Jaffna', 10),
	(15, 'Kilinochchi', 11),
	(16, 'Mannar', 12),
	(17, 'Mullaitivu', 13),
	(18, 'Vavuniya', 14),
	(19, 'Batticaloa', 15),
	(20, 'Ampara', 16),
	(21, 'Trincomalee', 17),
	(22, 'Kurunegala', 18),
	(23, 'Puttalam', 19),
	(24, 'Anuradhapura', 20),
	(25, 'Polonnaruwa', 21),
	(26, 'Badulla', 22),
	(27, 'Monaragala', 23),
	(28, 'Kegalle', 24),
	(29, 'Ratnapura', 25),
	(30, 'Moratuwa', 1),
	(31, 'Panadura', 3),
	(32, 'Kadawatha', 2),
	(33, 'Katunayake', 2),
	(34, 'Gampola', 4),
	(35, 'Ella', 8),
	(36, 'Weligama', 7),
	(37, 'Polonnaruwa', 21),
	(38, 'Dambulla', 20),
	(39, 'Kurunegala', 18),
	(40, 'Balangoda', 25),
	(41, 'Wattala', 1),
	(42, 'Maharagama', 1),
	(43, 'Ragama', 2),
	(44, 'Kotte', 1),
	(45, 'Kandy', 4),
	(46, 'Kalutara', 3),
	(47, 'Matara', 8),
	(48, 'Galle', 7),
	(49, 'Dambulla', 20),
	(50, 'Tangalle', 8);

-- Dumping structure for table pbay_db.color
CREATE TABLE IF NOT EXISTS `color` (
  `clr_id` int NOT NULL AUTO_INCREMENT,
  `clr_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`clr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.color: ~8 rows (approximately)
INSERT INTO `color` (`clr_id`, `clr_name`) VALUES
	(1, 'Black'),
	(2, 'Purple'),
	(3, 'Blue'),
	(4, 'Red'),
	(6, 'Pink'),
	(7, 'Gold'),
	(8, 'Yellow'),
	(9, 'Light Blue');

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.district: ~25 rows (approximately)
INSERT INTO `district` (`district_id`, `district_name`, `province_province_id`) VALUES
	(1, 'Colombo', 1),
	(2, 'Gampaha', 1),
	(3, 'Kalutara', 1),
	(4, 'Kandy', 2),
	(5, 'Matale', 2),
	(6, 'Nuwara Eliya', 2),
	(7, 'Galle', 3),
	(8, 'Matara', 3),
	(9, 'Hambantota', 3),
	(10, 'Jaffna', 4),
	(11, 'Kilinochchi', 4),
	(12, 'Mannar', 4),
	(13, 'Mullaitivu', 4),
	(14, 'Vavuniya', 4),
	(15, 'Batticaloa', 5),
	(16, 'Ampara', 5),
	(17, 'Trincomalee', 5),
	(18, 'Kurunegala', 6),
	(19, 'Puttalam', 6),
	(20, 'Anuradhapura', 7),
	(21, 'Polonnaruwa', 7),
	(22, 'Badulla', 8),
	(23, 'Monaragala', 8),
	(24, 'Kegalle', 9),
	(25, 'Rathnapura', 9);

-- Dumping structure for table pbay_db.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `fk_invoice_product1_idx` (`product_id`),
  KEY `fk_invoice_user1_idx` (`user_email`),
  CONSTRAINT `fk_invoice_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.invoice: ~9 rows (approximately)
INSERT INTO `invoice` (`invoice_id`, `order_id`, `date`, `total`, `qty`, `status`, `product_id`, `user_email`) VALUES
	(1, '6661131d4b734', '2024-06-06 07:09:09', 45250, 1, 0, 1, 'pasinduogdev@gmail.com'),
	(2, '666116c470cb5', '2024-06-06 07:24:54', 35250, 1, 0, 10, 'pasinduogdev@gmail.com'),
	(3, '666117282a1ee', '2024-06-06 07:26:26', 40250, 2, 0, 10, 'pasinduogdev@gmail.com'),
	(4, '6661181ef33fe', '2024-06-06 07:30:33', 40250, 2, 0, 10, 'ogpmadhuwantha678@gmail.com'),
	(5, '6661190ae3c75', '2024-06-06 07:34:36', 45250, 1, 0, 1, 'ogpmadhuwantha678@gmail.com'),
	(6, '6662379bed2eb', '2024-06-07 03:58:05', 45250, 1, 0, 1, 'wickramasinghekawindya@gmail.com'),
	(7, '666318dd8de34', '2024-06-07 20:00:10', 20250, 1, 0, 10, 'ogpmadhuwantha678@gmail.com'),
	(8, '66639f33c6c7a', '2024-06-08 05:31:49', 17430, 2, 0, 12, 'ogpmadhuwantha678@gmail.com'),
	(9, '6663ae033aa84', '2024-06-08 06:34:40', 42200, 5, 0, 14, 'ogpmadhuwantha678@gmail.com');

-- Dumping structure for table pbay_db.model
CREATE TABLE IF NOT EXISTS `model` (
  `model_id` int NOT NULL AUTO_INCREMENT,
  `model_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.model: ~10 rows (approximately)
INSERT INTO `model` (`model_id`, `model_name`) VALUES
	(1, 'iPhone 8'),
	(3, 'iPhone 14 Pro'),
	(4, 'ROG 7'),
	(5, 'POCO M3 Pro'),
	(6, 'Galaxy S22'),
	(7, 'Katana 17'),
	(8, 'Thin GF66'),
	(9, 'Nokia 150'),
	(10, 'Nokia 110'),
	(11, 'Nokia 105');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.model_has_brand: ~10 rows (approximately)
INSERT INTO `model_has_brand` (`model_model_id`, `brand_brand_id`, `id`) VALUES
	(1, 1, 1),
	(6, 2, 2),
	(4, 3, 3),
	(3, 1, 4),
	(7, 6, 5),
	(8, 6, 6),
	(5, 4, 7),
	(9, 10, 8),
	(10, 10, 9),
	(11, 10, 10);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.product: ~11 rows (approximately)
INSERT INTO `product` (`id`, `price`, `qty`, `description`, `title`, `datetime_added`, `delivery_fee_colombo`, `delivery_fee_other`, `category_cat_id`, `model_has_brand_id`, `condition_condition_id`, `status_status_id`, `user_email`) VALUES
	(1, 45000, 96, 'The iPhone 8 combines timeless design with advanced features to deliver a seamless user experience. Encased in durable glass and aluminum, this device offers both style and substance, making it a perfect choice for anyone seeking a balance of functionality and elegance.', 'Apple iPhone 8', '2024-06-05 18:08:54', 250, 250, 1, 1, 2, 1, 'pasinduogdev@gmail.com'),
	(2, 450000, 50, 'The Samsung Galaxy S22 is perfect for those who demand top-notch performance, exceptional camera capabilities, and a visually stunning display in a sleek, compact form. Whether you’re a photography enthusiast, a mobile gamer, or someone who needs a reliable device for everyday use, the Galaxy S22 is designed to exceed your expectations.', 'Samsung Galaxy S22', '2024-06-05 18:10:55', 250, 250, 1, 2, 1, 1, 'pasinduogdev@gmail.com'),
	(3, 680000, 70, 'The Asus ROG Phone 7 is a powerhouse designed specifically for gamers, combining cutting-edge hardware with software features that elevate the mobile gaming experience', 'Asus ROG 7', '2024-06-05 18:19:40', 250, 250, 1, 3, 1, 1, 'pasinduogdev@gmail.com'),
	(4, 520000, 120, 'The iPhone 14 Pro combines powerful hardware, sophisticated software, and advanced camera capabilities, making it a leading choice for users seeking a premium smartphone experience.', 'Apple iPhone 14 Pro', '2024-06-05 18:22:06', 250, 250, 1, 4, 1, 1, 'pasinduogdev@gmail.com'),
	(5, 350000, 50, 'The MSI Katana 17 is designed for gamers who demand high performance, a large and vibrant display, and customizable features. Its powerful hardware and advanced cooling system make it a strong contender for both casual and competitive gaming, while its design and build quality ensure durability and a premium feel.', 'MSI Katana 17', '2024-06-05 23:12:22', 250, 250, 13, 5, 1, 1, 'pasinduogdev@gmail.com'),
	(6, 250000, 10, 'The MSI Thin GF66 is a well-rounded gaming laptop that balances performance, portability, and design, making it a suitable choice for gamers and power users on the go.', 'MSI Thin GF66', '2024-06-05 23:17:05', 250, 250, 13, 6, 1, 1, 'pasinduogdev@gmail.com'),
	(10, 20000, 44, 'The POCO M3 Pro aims to provide a balanced mix of performance, camera capabilities, and battery life, all while supporting the latest connectivity standard of 5G, making it a strong contender in the budget smartphone segment.', 'POCO M3 Pro', '2024-06-05 23:26:08', 250, 250, 1, 7, 2, 1, 'pasinduogdev@gmail.com'),
	(11, 11990, 50, 'Technology	\r\nGSM\r\n2G bands	GSM 900 / 1800 - SIM 1 & SIM 2 (dual-SIM model only)\r\nGPRS	Yes\r\nEDGE	Yes\r\nLAUNCH	Announced	2016, December\r\nStatus	Available. Released 2017, January\r\nBODY	Dimensions	118 x 50.2 x 13.5 mm (4.65 x 1.98 x 0.53 in)\r\nWeight	81 g (2.86 oz)\r\nSIM	Single SIM (Mini-SIM) or Dual SIM (Mini-SIM, dual stand-by)\r\n 	- Flashlight\r\nDISPLAY	Type	TFT, 65K colors\r\nSize	2.4 inches, 17.8 cm2 (~30.1% screen-to-body ratio)\r\nResolution	240 x 320 pixels, 4:3 ratio (~167 ppi density)\r\nMEMORY	Card slot	microSD, up to 32 GB (dedicated slot)\r\nPhonebook	Yes\r\nCall records	Yes\r\nMAIN CAMERA	Single	VGA\r\nFeatures	LED flash\r\nVideo	No\r\nSELFIE CAMERA	 	No\r\nSOUND	Loudspeaker	Yes\r\n3.5mm jack	Yes\r\nCOMMS	WLAN	No\r\nBluetooth	3.0\r\nGPS	No\r\nRadio	FM radio\r\nUSB	microUSB\r\nFEATURES	Sensors	\r\nMessaging	SMS\r\nGames	Yes\r\nJava	No\r\nBATTERY	 	Removable Li-Ion 1020 mAh battery (BL-5C)\r\nStand-by	Up to 744 h\r\nTalk time	Up to 22 h\r\nMusic play	Up to 40 h\r\n 	Removable Li-Ion 1020 mAh battery (Dual-SIM)\r\nStand-by	Up to 600 h\r\nTalk time	Up to 22 h\r\nMISC	Colors	Black, White\r\nSAR EU	0.83 W/kg (head)     0.92 W/kg (body)    \r\nPrice	About 30 EUR', 'Nokia 150', '2024-06-08 05:20:04', 250, 250, 1, 8, 1, 1, 'pasinduogdev@gmail.com'),
	(12, 8590, 58, 'NETWORK	Technology	GSM\r\n2G bands	GSM 900 / 1800 - SIM 1 & SIM 2\r\nGPRS	No\r\nEDGE	No\r\nLAUNCH	Announced	2019, September\r\nStatus	Available. Released 2019, September\r\nBODY	Dimensions	115.2 x 49.9 x 14.3 mm (4.54 x 1.96 x 0.56 in)\r\nWeight	75 g (2.65 oz)\r\nSIM	Dual SIM (Mini-SIM, dual stand-by)\r\n 	Flashlight\r\nDISPLAY	Type	TFT, 65K colors\r\nSize	1.77 inches, 9.7 cm2 (~16.9% screen-to-body ratio)\r\nResolution	120 x 160 pixels, 4:3 ratio (~113 ppi density)\r\nMEMORY	Card slot	microSDHC\r\nPhonebook	Yes\r\nCall records	Yes\r\nInternal	4MB\r\nMAIN CAMERA	Single	QVGA\r\nVideo	Yes\r\nSELFIE CAMERA	 	No\r\nSOUND	Loudspeaker	Yes\r\n3.5mm jack	Yes\r\nCOMMS	WLAN	No\r\nBluetooth	No\r\nGPS	No\r\nRadio	FM radio\r\nUSB	microUSB 2.0\r\nFEATURES	Sensors	\r\nMessaging	SMS\r\nGames	Yes\r\nJava	No\r\n 	MP3 player\r\nBATTERY	 	Removable Li-Ion 800 mAh battery\r\nStand-by	Up to 444 h\r\nMISC	Colors	Ocean Blue, Pink, Black\r\nModels	TA-1192\r\nSAR EU	1.23 W/kg (head)     1.19 W/kg (body)    \r\nPrice	About 20 EUR', 'Nokia 110 (2019)', '2024-06-08 05:23:34', 250, 250, 1, 9, 1, 1, 'pasinduogdev@gmail.com'),
	(13, 6990, 30, 'NETWORK	Technology	GSM\r\n2G bands	GSM 900 / 1800 - SIM 1 & SIM 2 (dual-SIM model only)\r\nGPRS	Yes\r\nEDGE	Yes\r\nLAUNCH	Announced	2023, May 18\r\nStatus	Available. Released 2023, May 18\r\nBODY	Dimensions	115.1 x 49.4 x 14.5 mm (4.53 x 1.94 x 0.57 in)\r\nWeight	78.7 g (2.75 oz)\r\nSIM	Single SIM (Mini-SIM) or Dual SIM (Mini-SIM, dual stand-by)\r\n 	Flashlight\r\nSplash resistant\r\nDISPLAY	Type	TFT LCD, 65K colors\r\nSize	1.8 inches, 10.0 cm2 (~17.6% screen-to-body ratio)\r\nResolution	120 x 160 pixels, 4:3 ratio (~111 ppi density)\r\nMEMORY	Card slot	No\r\nPhonebook	Yes\r\nCall records	Yes\r\nInternal	Unspecified\r\nCAMERA	 	No\r\nSOUND	Loudspeaker	Yes\r\n3.5mm jack	Yes\r\nCOMMS	WLAN	No\r\nBluetooth	No\r\nPositioning	No\r\nNFC	No\r\nRadio	Wireless FM radio\r\nUSB	microUSB 1.1\r\nFEATURES	Sensors	\r\nMessaging	SMS\r\nGames	Yes\r\nJava	No\r\nBATTERY	Type	Li-Ion 1000 mAh\r\nMISC	Colors	Red Terracotta, Cyan, Charcoal', 'Nokia 105 (2023)', '2024-06-08 05:27:00', 250, 250, 1, 10, 1, 1, 'pasinduogdev@gmail.com'),
	(14, 8390, 45, 'NETWORK	Technology	GSM\r\n2G bands	GSM 900 / 1800 - SIM 1 & SIM 2 (dual-SIM model only)\r\nGPRS	No\r\nEDGE	No\r\nLAUNCH	Announced	2022, April 26\r\nStatus	Available. Released 2022, April 26\r\nBODY	Dimensions	115.2 x 49.9 x 14.3 mm (4.54 x 1.96 x 0.56 in)\r\nWeight	70 g (2.47 oz)\r\nSIM	Single SIM (Mini-SIM) or Dual SIM (Mini-SIM, dual stand-by)\r\n 	Flashlight\r\nDISPLAY	Type	TFT LCD, 65K colors\r\nSize	1.77 inches, 9.7 cm2 (~16.9% screen-to-body ratio)\r\nResolution	120 x 160 pixels, 4:3 ratio (~113 ppi density)\r\nPLATFORM	Chipset	Mediatek MT6261D\r\nMEMORY	Card slot	No\r\nPhonebook	Yes\r\nCall records	Yes\r\nInternal	4MB, 4MB RAM\r\nCAMERA	 	No\r\nSOUND	Loudspeaker	Yes\r\n3.5mm jack	Yes\r\nCOMMS	WLAN	No\r\nBluetooth	No\r\nPositioning	No\r\nNFC	No\r\nRadio	Wireless FM radio\r\nUSB	microUSB 1.1\r\nFEATURES	Sensors	\r\nMessaging	SMS\r\nGames	Yes\r\nJava	No\r\nBATTERY	Type	Li-Ion 800 mAh, removable\r\nMISC	Colors	Blue, Charcoal\r\nModels	TA-1464, TA-1435, TA-1203, TA-1174, TA-1037, TA-1010\r\nSAR	1.20 W/kg (head)     0.79 W/kg (body)    \r\nSAR EU	1.50 W/kg (head)     1.38 W/kg (body)', 'Nokia 105 (2022)', '2024-06-08 05:28:42', 250, 250, 1, 10, 1, 1, 'pasinduogdev@gmail.com');

-- Dumping structure for table pbay_db.product_has_color
CREATE TABLE IF NOT EXISTS `product_has_color` (
  `product_id` int NOT NULL,
  `color_clr_id` int NOT NULL,
  KEY `fk_product_has_color_color1_idx` (`color_clr_id`),
  KEY `fk_product_has_color_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_has_color_color1` FOREIGN KEY (`color_clr_id`) REFERENCES `color` (`clr_id`),
  CONSTRAINT `fk_product_has_color_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.product_has_color: ~11 rows (approximately)
INSERT INTO `product_has_color` (`product_id`, `color_clr_id`) VALUES
	(1, 7),
	(2, 1),
	(3, 1),
	(4, 2),
	(5, 1),
	(6, 1),
	(10, 8),
	(11, 1),
	(12, 3),
	(13, 9),
	(14, 3);

-- Dumping structure for table pbay_db.product_img
CREATE TABLE IF NOT EXISTS `product_img` (
  `img_path` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`img_path`),
  KEY `fk_product_img_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_img_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.product_img: ~11 rows (approximately)
INSERT INTO `product_img` (`img_path`, `product_id`) VALUES
	('resources/product_img//Apple iPhone 8_0_66605c5e3ecc2.jpeg', 1),
	('resources/product_img//Samsung Galaxy S22_0_66605cd737be2.png', 2),
	('resources/product_img//Asus ROG 7_0_66605ee4bd660.png', 3),
	('resources/product_img//Apple iPhone 14 Pro_0_66605f765f99e.png', 4),
	('resources/product_img//MSI Katana 17_0_6660a37e2b69b.png', 5),
	('resources/product_img//MSI Thin GF66_0_6660a4999496c.png', 6),
	('resources/product_img//POCO M3 Pro_0_6660a6b81b19e.png', 10),
	('resources/product_img//Nokia 150_0_66639cac144d0.jpeg', 11),
	('resources/product_img//Nokia 110 (2019)_0_66639d7e0d922.jpeg', 12),
	('resources/product_img//Nokia 105 (2023)_0_66639e4c50a91.jpeg', 13),
	('resources/product_img//Nokia 105 (2022)_0_66639eb2b7f62.jpeg', 14);

-- Dumping structure for table pbay_db.province
CREATE TABLE IF NOT EXISTS `province` (
  `province_id` int NOT NULL AUTO_INCREMENT,
  `province_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.province: ~9 rows (approximately)
INSERT INTO `province` (`province_id`, `province_name`) VALUES
	(1, 'Western'),
	(2, 'Central'),
	(3, 'Southern'),
	(4, 'Northern'),
	(5, 'Eastern'),
	(6, 'North Western'),
	(7, 'North Central'),
	(8, 'Uva'),
	(9, 'Sambaragamuwa');

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

-- Dumping structure for table pbay_db.theme
CREATE TABLE IF NOT EXISTS `theme` (
  `id` int NOT NULL,
  `mode` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.theme: ~2 rows (approximately)
INSERT INTO `theme` (`id`, `mode`) VALUES
	(1, 'light'),
	(2, 'dark');

-- Dumping structure for table pbay_db.user
CREATE TABLE IF NOT EXISTS `user` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `joined_date` datetime DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `status_status_id` int NOT NULL DEFAULT '1',
  `user_type_id` int NOT NULL DEFAULT '2',
  `theme_id` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`email`),
  KEY `fk_user_status1_idx` (`status_status_id`),
  KEY `fk_user_user_type1_idx` (`user_type_id`),
  KEY `fk_user_theme1_idx` (`theme_id`),
  CONSTRAINT `fk_user_status1` FOREIGN KEY (`status_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `fk_user_theme1` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`),
  CONSTRAINT `fk_user_user_type1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.user: ~4 rows (approximately)
INSERT INTO `user` (`fname`, `lname`, `email`, `password`, `mobile`, `joined_date`, `verification_code`, `status_status_id`, `user_type_id`, `theme_id`) VALUES
	('Pasindu', 'Madhuwantha', 'ogpmadhuwantha678@gmail.com', '$2y$10$gw6rBxtZZhtl9WpUpM8ee.qJMUGCuV36ZzzGrnzCjYZE1sloGdRKS', '0715518744', '2024-05-29 15:57:46', '806308', 1, 2, 2),
	('OG', 'Mobile', 'pasinduogdev@gmail.com', '$2y$10$fxCbcN6foO3V51HE8UBC2.d5.aLK78mSu.i6PUTqfEgvhu4wbRwZu', '0766035744', '2024-05-27 17:19:07', '786717', 1, 1, 1),
	('Ashan', 'Mobile', 'rraskrocky@gmail.com', '$2y$10$a.KB2uvMH/ZmLwRv0BdPcOGppoOMd3lGQA5eAk3D4Ebjk3elSKg8G', '0764652465', '2024-05-26 21:44:40', NULL, 1, 2, 1),
	('Kavindya', 'Wickramasinghe', 'wickramasinghekawindya@gmail.com', '$2y$10$1uHyzNudCueFMqi2aA10y.5.dFt6100zfQ7KK.0G6cwjPC9qcoQea', '0777659491', '2024-06-07 03:16:50', NULL, 2, 2, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.user_has_address: ~3 rows (approximately)
INSERT INTO `user_has_address` (`user_email`, `city_city_id`, `address_id`, `line1`, `line2`, `postal_code`) VALUES
	('ogpmadhuwantha678@gmail.com', 46, 3, 'No.68, Andunwenna 1st Mawatha, Horawala,', 'Welipenna.', '12108'),
	('pasinduogdev@gmail.com', 46, 4, 'No.68, Andunwenna Rd', 'Horawala, Welipenna', '12108'),
	('wickramasinghekawindya@gmail.com', 20, 5, '8/121, Rajagama, Digamadulla', 'Weeragoda', '56321');

-- Dumping structure for table pbay_db.user_img
CREATE TABLE IF NOT EXISTS `user_img` (
  `path` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_user_img_user1_idx` (`user_email`),
  CONSTRAINT `fk_user_img_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.user_img: ~3 rows (approximately)
INSERT INTO `user_img` (`path`, `user_email`) VALUES
	('resources//profile_images//Pasindu_665d1b3ab9212.jpeg', 'ogpmadhuwantha678@gmail.com'),
	('resources//profile_images//OG_6660ba71ef138.jpeg', 'pasinduogdev@gmail.com'),
	('resources//profile_images//Kavindya_66623e59bbf0e.jpeg', 'wickramasinghekawindya@gmail.com');

-- Dumping structure for table pbay_db.user_type
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pbay_db.user_type: ~3 rows (approximately)
INSERT INTO `user_type` (`id`, `type`) VALUES
	(1, 'Admin'),
	(2, 'User');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
