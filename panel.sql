-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 29 Eki 2020, 10:52:41
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `panel`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moduleName` text,
  `moduleController` text,
  `moduleLink` text,
  `moduleSlug` text,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `modules`
--

INSERT INTO `modules` (`id`, `moduleName`, `moduleController`, `moduleLink`, `moduleSlug`, `status`) VALUES
(1, 'Anasayfa', 'HomeController', '/', 'anasayfa', 1),
(2, 'Üyeler', 'AdminController', '/uyeler', 'uyeler', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteName` text,
  `siteDescription` text,
  `siteAuthorName` text,
  `siteAuthorLink` text,
  `siteLogo` text,
  `siteFavicon` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `siteName`, `siteDescription`, `siteAuthorName`, `siteAuthorLink`, `siteLogo`, `siteFavicon`) VALUES
(1, 'Panel', 'Panel hakkında açıklama yazınız buraya gelir', 'IFeelCode', 'https://ifeelcode.com', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
