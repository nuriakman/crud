-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `kis_kampi_ornekleri`;
CREATE DATABASE `kis_kampi_ornekleri` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_turkish_ci */;
USE `kis_kampi_ornekleri`;

DROP TABLE IF EXISTS `gruplar`;
CREATE TABLE `gruplar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupadi` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `gruplar` (`id`, `grupadi`) VALUES
(1,	'Tedarikçi'),
(2,	'Bilkent hastanesi'),
(3,	'PCB Baskı'),
(4,	'Membrancı'),
(5,	'Çalışanlar');

DROP TABLE IF EXISTS `telefonrehberi`;
CREATE TABLE `telefonrehberi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adisoyadi` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `telefonu` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `grubu` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `telefonrehberi` (`id`, `adisoyadi`, `telefonu`, `grubu`) VALUES
(1,	'Nuri Akman',	'4445566',	'Bilkent Hastanesi'),
(2,	'Kemal Mutlu',	'5556666',	'Bilkent Hastanesi'),
(6,	'Çiğdem Tosun',	'44444',	'Tedarikçi'),
(7,	'Ali',	'Yalçın',	'Kalite');

-- 2019-02-12 08:34:54
