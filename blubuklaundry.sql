-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.27-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for blubuklaundry
CREATE DATABASE IF NOT EXISTS `blubuklaundry` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `blubuklaundry`;

-- Dumping structure for table blubuklaundry.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table blubuklaundry.admin: ~2 rows (approximately)
REPLACE INTO `admin` (`id`, `name`, `phone_number`, `email`, `password`, `address`) VALUES
	(3, 'Bayu Fadayan Update', '085716042693', 'bayufadayan@gmail.com', '123456', 'Jalan Juga Manusia');

-- Dumping structure for table blubuklaundry.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `first_order` datetime DEFAULT current_timestamp(),
  `last_order` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone_number` (`phone_number`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table blubuklaundry.customer: ~5 rows (approximately)
REPLACE INTO `customer` (`id`, `name`, `phone_number`, `first_order`, `last_order`) VALUES
	(1, 'Berus', '3128372', '2025-02-06 14:25:41', '2025-02-06 14:25:41'),
	(2, 'Bismillah', 'sasa', '2025-02-06 16:28:47', '2025-02-06 16:28:47'),
	(3, 'Magitas', '09494300', '2025-02-07 14:24:49', '2025-02-07 14:25:48'),
	(10, 'Ruby Jane', 'dsdsds', '2025-02-07 15:18:06', '2025-02-07 15:18:06'),
	(13, 'Enaqs Sumantox', '0881011422380', '2025-02-08 23:41:56', '2025-02-08 23:41:56'),
	(14, 'Bima Yahya', '088211630351', '2025-02-09 01:04:22', '2025-02-09 01:04:22');

-- Dumping structure for table blubuklaundry.item_category
CREATE TABLE IF NOT EXISTS `item_category` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `category` enum('Kiloan','Satuan') NOT NULL DEFAULT 'Satuan',
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table blubuklaundry.item_category: ~20 rows (approximately)
REPLACE INTO `item_category` (`id`, `category`, `nama`, `harga`) VALUES
	(1, 'Satuan', 'Bed Cover Besar', 35000),
	(2, 'Satuan', 'Bed Cover Kecil', 25000),
	(3, 'Satuan', 'Selimut', 15000),
	(4, 'Satuan', 'Sprei Biasa', 10000),
	(5, 'Satuan', 'Sprei Rumbai', 15000),
	(6, 'Satuan', 'Boneka Besar', 50000),
	(7, 'Satuan', 'Boneka Sedang', 30000),
	(8, 'Satuan', 'Boneka Kecil', 15000),
	(9, 'Satuan', 'Gordyn Tebal/Meter', 7000),
	(10, 'Satuan', 'Gordyn Tipis/Meter', 5000),
	(11, 'Satuan', 'Tas Ransel', 25000),
	(12, 'Satuan', 'Koper Besar', 60000),
	(13, 'Satuan', 'Koper Kecil', 45000),
	(14, 'Satuan', 'Jaket Kulit', 45000),
	(15, 'Satuan', 'Long Dress', 25000),
	(16, 'Satuan', 'Pakaian Pengantin', 125000),
	(17, 'Satuan', 'Baju Pesta', 75000),
	(18, 'Satuan', 'Jas', 25000),
	(19, 'Satuan', 'Karpet/meter', 10000),
	(20, 'Kiloan', 'Item Kiloan', 7000);

-- Dumping structure for table blubuklaundry.item_laundry
CREATE TABLE IF NOT EXISTS `item_laundry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `id_item_category` int(100) NOT NULL,
  `id_transaction` int(11) unsigned NOT NULL,
  `berat/qty` decimal(10,2) NOT NULL,
  `total_harga_item` int(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_item_category` (`id_item_category`),
  KEY `id_customer` (`id_customer`),
  KEY `FK_item_laundry_transaction` (`id_transaction`),
  CONSTRAINT `FK_item_laundry_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_item_laundry_item_category` FOREIGN KEY (`id_item_category`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_item_laundry_transaction` FOREIGN KEY (`id_transaction`) REFERENCES `transaction` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table blubuklaundry.item_laundry: ~15 rows (approximately)
REPLACE INTO `item_laundry` (`id`, `id_customer`, `id_item_category`, `id_transaction`, `berat/qty`, `total_harga_item`) VALUES
	(1, 1, 1, 1, 1.00, 35000),
	(4, 1, 20, 1, 1.00, 7000),
	(68, 13, 20, 54, 3.52, 24640),
	(69, 13, 11, 54, 1.00, 25000),
	(76, 3, 20, 58, 2.32, 16239),
	(78, 3, 2, 58, 2.00, 50000),
	(81, 13, 18, 61, 2.00, 50000),
	(82, 14, 20, 62, 3.52, 24640),
	(84, 14, 3, 62, 1.00, 15000),
	(86, 13, 18, 64, 1.00, 25000),
	(87, 14, 15, 65, 1.00, 25000),
	(88, 14, 13, 66, 2.00, 90000),
	(90, 1, 16, 68, 2.00, 250000),
	(91, 1, 18, 69, 4.00, 100000),
	(92, 1, 13, 69, 7.00, 315000),
	(93, 13, 20, 70, 4.24, 29680),
	(94, 13, 18, 70, 1.00, 25000);

-- Dumping structure for table blubuklaundry.transaction
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice` varchar(20) NOT NULL,
  `tanggal_order` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_customer` int(11) NOT NULL,
  `layanan` enum('Express','Regular') NOT NULL DEFAULT 'Regular',
  `status_laundry` enum('Dalam Antrian','Cuci (Proses 1)','Setrika (Proses 2)','Siap Ambil','Transaksi Selesai') NOT NULL DEFAULT 'Dalam Antrian',
  `tanggal_bayar` datetime DEFAULT NULL,
  `status_bayar` enum('Lunas','Belum Lunas') NOT NULL DEFAULT 'Belum Lunas',
  `total_tagihan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice` (`invoice`),
  KEY `id_customer` (`id_customer`),
  CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table blubuklaundry.transaction: ~10 rows (approximately)
REPLACE INTO `transaction` (`id`, `invoice`, `tanggal_order`, `id_customer`, `layanan`, `status_laundry`, `tanggal_bayar`, `status_bayar`, `total_tagihan`) VALUES
	(1, 'dfsvdg', '2025-02-06 08:45:06', 1, 'Regular', 'Dalam Antrian', '2025-02-09 04:07:53', 'Lunas', 34000),
	(54, 'MS-3055156', '2025-02-08 16:44:15', 13, 'Regular', 'Cuci (Proses 1)', '2025-02-09 04:07:36', 'Lunas', NULL),
	(58, 'PQ-6487694', '2025-02-08 17:41:28', 3, 'Regular', 'Transaksi Selesai', '2025-02-09 03:47:30', 'Lunas', NULL),
	(61, 'RZ-7650181', '2025-02-08 18:00:50', 13, 'Regular', 'Setrika (Proses 2)', '2025-02-09 04:46:27', 'Lunas', NULL),
	(62, 'TJ-7862472', '2025-02-08 18:04:22', 14, 'Regular', 'Dalam Antrian', '2025-02-09 04:46:28', 'Lunas', NULL),
	(64, 'RD-8528216', '2025-02-08 18:15:28', 13, 'Express', 'Dalam Antrian', '2025-02-09 04:46:30', 'Lunas', 25000),
	(65, 'FM-8592979', '2025-02-08 18:16:33', 14, 'Regular', 'Setrika (Proses 2)', NULL, 'Belum Lunas', 25000),
	(66, 'UV-8613661', '2025-02-08 18:16:53', 14, 'Regular', 'Dalam Antrian', NULL, 'Belum Lunas', NULL),
	(68, 'MK-8693426', '2025-02-08 18:18:13', 1, 'Regular', 'Cuci (Proses 1)', NULL, 'Belum Lunas', 250000),
	(69, 'QX-8696022', '2025-02-08 21:04:56', 1, 'Regular', 'Cuci (Proses 1)', NULL, 'Belum Lunas', 415000),
	(70, 'DJ-1113489', '2025-02-08 21:45:13', 13, 'Regular', 'Dalam Antrian', NULL, 'Belum Lunas', 54680);

-- Dumping structure for table blubuklaundry.transaction_detail
CREATE TABLE IF NOT EXISTS `transaction_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) unsigned NOT NULL,
  `id_item_laundry` int(11) unsigned NOT NULL,
  `total_bayar` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_transaksi` (`id_transaksi`),
  KEY `FK_transaction_detail_item_laundry` (`id_item_laundry`),
  CONSTRAINT `FK_transaction_detail_item_laundry` FOREIGN KEY (`id_item_laundry`) REFERENCES `item_laundry` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_transaction_detail_transaction` FOREIGN KEY (`id_transaksi`) REFERENCES `transaction` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table blubuklaundry.transaction_detail: ~15 rows (approximately)
REPLACE INTO `transaction_detail` (`id`, `id_transaksi`, `id_item_laundry`, `total_bayar`) VALUES
	(1, 1, 1, 35000),
	(2, 1, 4, 7000),
	(54, 54, 68, 24640),
	(55, 54, 69, 25000),
	(62, 58, 76, 16239),
	(64, 58, 78, 50000),
	(67, 61, 81, 50000),
	(68, 62, 82, 24640),
	(70, 62, 84, 15000),
	(72, 64, 86, 25000),
	(73, 65, 87, 25000),
	(74, 66, 88, 90000),
	(76, 68, 90, 250000),
	(77, 69, 91, 100000),
	(78, 69, 92, 315000),
	(79, 70, 93, 29680),
	(80, 70, 94, 25000);

-- Dumping structure for table blubuklaundry.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `invoice` int(4) NOT NULL AUTO_INCREMENT,
  `waktu` varchar(6) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `metode_ambil` varchar(10) NOT NULL,
  `jenis_layanan` varchar(10) NOT NULL,
  `jenis_bahan` varchar(10) NOT NULL,
  `berat` int(3) NOT NULL,
  `harga_pokok` int(6) NOT NULL,
  PRIMARY KEY (`invoice`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table blubuklaundry.transaksi: ~12 rows (approximately)
REPLACE INTO `transaksi` (`invoice`, `waktu`, `tanggal`, `metode_ambil`, `jenis_layanan`, `jenis_bahan`, `berat`, `harga_pokok`) VALUES
	(6, '08.00', '23 Septe', 'on store', 'ekonomis', 'karpret', 4, 10000),
	(11, '21.00', '9 Oktoer', 'with kurir', 'reguler', 'baju', 2, 8000),
	(12, '19.00', '7 Maret ', 'on store', 'express', 'baju', 2, 8000),
	(30, '12.00', '16 July 2021', 'duel', 'reguler', 'Gorden', 2, 12000),
	(36, '09.00', '23 Januari 2021', 'Kurir', 'Express', 'Selimut', 1, 13000),
	(38, '10.00', '14 April 2022', 'COD', 'Reguler', 'Jeans', 90, 10000),
	(39, '', '', '', '', '', 0, 0),
	(40, '1', '2', 'duel', 'reguler', 'jeans', 12, 10),
	(41, '1', '10', 'duel', 'reguler', 'jeans', 0, 0),
	(42, '', '', '', '', '', 0, 0),
	(43, '', '', '', '', '', 0, 0),
	(44, '', '', '', '', '', 0, 0),
	(45, '', '', '', '', '', 0, 0);

-- Dumping structure for trigger blubuklaundry.update_tanggal_bayar
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER update_tanggal_bayar
BEFORE UPDATE ON transaction
FOR EACH ROW
BEGIN
    IF NEW.status_bayar = 'Lunas' THEN
        SET NEW.tanggal_bayar = CURRENT_TIMESTAMP;
    ELSEIF NEW.status_bayar = 'Belum Lunas' THEN
        SET NEW.tanggal_bayar = NULL; -- Atau gunakan '00:00:00' jika kolom bertipe TIME
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
