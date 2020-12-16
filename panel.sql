-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 16, 2020 at 02:46 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `panel`
--

-- --------------------------------------------------------

--
-- Table structure for table `belge`
--

DROP TABLE IF EXISTS `belge`;
CREATE TABLE IF NOT EXISTS `belge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `image` text,
  `pdf` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `belge`
--

INSERT INTO `belge` (`id`, `title`, `image`, `pdf`, `created_at`, `updated_at`) VALUES
(3, 'Belge', '1605703414.jpeg', '1605703414.pdf', '2020-11-18 12:43:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `title_2` text,
  `kategori` text,
  `image` text,
  `pdf` text,
  `text` text,
  `url` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `title_2`, `kategori`, `image`, `pdf`, `text`, `url`, `created_at`, `updated_at`) VALUES
(7, 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.', 'There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain', 'Select Option', '1606504805.jpeg', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra orci eu metus maximus, maximus fringilla lacus pellentesque. Integer tortor lectus, maximus ut elit sit amet, consequat ornare ex. Nam vitae sollicitudin sapien. Aliquam consequat hendrerit sem, ut eleifend nisi ornare id. Sed at tellus nisl. Vestibulum volutpat magna lorem, vitae imperdiet libero lacinia quis. Phasellus magna sapien, placerat non feugiat et, venenatis eu justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget neque finibus, mattis sem in, scelerisque urna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras et magna elit. Cras at nibh aliquet, convallis diam non, tempor odio.</p>', 'neque-porro-quisquam-est-qui-dolorem-ipsum-quia-dolor-sit-amet-consectetur-adipisci-velit', '2020-11-27 16:19:31', '2020-11-27 19:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `blog_belge`
--

DROP TABLE IF EXISTS `blog_belge`;
CREATE TABLE IF NOT EXISTS `blog_belge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) DEFAULT NULL,
  `belge` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_belge`
--

INSERT INTO `blog_belge` (`id`, `blog_id`, `belge`) VALUES
(1, 2, 'asdas-1-son-test-1-asdasdsd.pdf'),
(2, 2, 'asdas-2-test-4-1-elmar-dadashov-1.pdf'),
(3, 3, 'eeeee-1-deneme1-2-elmar-dadashov.pdf'),
(4, 3, 'eeeee-2-son-test-1-asdasdsd.pdf'),
(5, 3, 'eeeee-3-test-4-1-elmar-dadashov-1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `blog_gorsel`
--

DROP TABLE IF EXISTS `blog_gorsel`;
CREATE TABLE IF NOT EXISTS `blog_gorsel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) DEFAULT NULL,
  `gorsel` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_gorsel`
--

INSERT INTO `blog_gorsel` (`id`, `blog_id`, `gorsel`) VALUES
(1, 2, '16041443220.jpeg'),
(2, 2, '16041443221.webp'),
(5, 3, '16041444802.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `blog_kategori`
--

DROP TABLE IF EXISTS `blog_kategori`;
CREATE TABLE IF NOT EXISTS `blog_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) DEFAULT NULL,
  `kategori` text,
  `sira` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ekatalog`
--

DROP TABLE IF EXISTS `ekatalog`;
CREATE TABLE IF NOT EXISTS `ekatalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `pdf` text,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ekatalog`
--

INSERT INTO `ekatalog` (`id`, `title`, `pdf`, `updated_at`) VALUES
(1, 'E-Katalog', '1606316029.pdf', '2020-11-25 14:53:49');

-- --------------------------------------------------------

--
-- Table structure for table `ekip`
--

DROP TABLE IF EXISTS `ekip`;
CREATE TABLE IF NOT EXISTS `ekip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` text,
  `unvan` text,
  `email` text,
  `image` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ekip`
--

INSERT INTO `ekip` (`id`, `isim`, `unvan`, `email`, `image`, `created_at`, `updated_at`) VALUES
(1, 'deneme isim', 'unvann', 'eposta', '1606314550.jpeg', '2020-11-25 14:08:42', '2020-11-25 14:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

DROP TABLE IF EXISTS `galeri`;
CREATE TABLE IF NOT EXISTS `galeri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `title_2` text,
  `link` text,
  `image` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `title`, `title_2`, `link`, `image`, `created_at`, `updated_at`) VALUES
(1, 'galeri baslik', 'galeri aciklama', 'https://www.youtube.com/watch?v=6LjvlG70YNc', '1605643649.jpeg', '2020-11-17 19:29:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `haber`
--

DROP TABLE IF EXISTS `haber`;
CREATE TABLE IF NOT EXISTS `haber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `title_2` text,
  `kategori` text,
  `image` text,
  `pdf` text,
  `text` text,
  `url` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `haber`
--

INSERT INTO `haber` (`id`, `title`, `title_2`, `kategori`, `image`, `pdf`, `text`, `url`, `created_at`, `updated_at`) VALUES
(56, '\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 'There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...', '1', '1606504583.jpeg', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra orci eu metus maximus, maximus fringilla lacus pellentesque. Integer tortor lectus, maximus ut elit sit amet, consequat ornare ex. Nam vitae sollicitudin sapien. Aliquam consequat hendrerit sem, ut eleifend nisi ornare id. Sed at tellus nisl. Vestibulum volutpat magna lorem, vitae imperdiet libero lacinia quis. Phasellus magna sapien, placerat non feugiat et, venenatis eu justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget neque finibus, mattis sem in, scelerisque urna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras et magna elit. Cras at nibh aliquet, convallis diam non, tempor odio.</p>', 'neque-porro-quisquam-est-qui-dolorem-ipsum-quia-dolor-sit-amet-consectetur-adipisci-velit', '2020-11-27 19:16:23', '2020-11-27 19:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `haber_belge`
--

DROP TABLE IF EXISTS `haber_belge`;
CREATE TABLE IF NOT EXISTS `haber_belge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `haber_id` int(11) DEFAULT NULL,
  `belge` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `haber_gorsel`
--

DROP TABLE IF EXISTS `haber_gorsel`;
CREATE TABLE IF NOT EXISTS `haber_gorsel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `haber_id` int(11) DEFAULT NULL,
  `gorsel` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `haber_gorsel`
--

INSERT INTO `haber_gorsel` (`id`, `haber_id`, `gorsel`) VALUES
(38, 56, '16065045842.jpeg'),
(37, 56, '16065045841.jpeg'),
(36, 56, '16065045830.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `haber_kategori`
--

DROP TABLE IF EXISTS `haber_kategori`;
CREATE TABLE IF NOT EXISTS `haber_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `haber_id` int(11) DEFAULT NULL,
  `kategori` text,
  `sira` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hakkimizda`
--

DROP TABLE IF EXISTS `hakkimizda`;
CREATE TABLE IF NOT EXISTS `hakkimizda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `title_2` text,
  `image` text,
  `text` text,
  `text_2` text,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hakkimizda`
--

INSERT INTO `hakkimizda` (`id`, `title`, `title_2`, `image`, `text`, `text_2`, `updated_at`) VALUES
(1, 'The standard Lorem Ipsum passage, used since the 1500s', '1914 translation by H. Rackham', '1605700491.jpeg', '<p>\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"</p>', '<p>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p>', '2020-11-18 11:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `hizmet`
--

DROP TABLE IF EXISTS `hizmet`;
CREATE TABLE IF NOT EXISTS `hizmet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `title_2` text,
  `kategori` text,
  `image` text,
  `pdf` text,
  `text` text,
  `url` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hizmet`
--

INSERT INTO `hizmet` (`id`, `title`, `title_2`, `kategori`, `image`, `pdf`, `text`, `url`, `created_at`, `updated_at`) VALUES
(3, 'deneme hizme', 'deneme hizmettttt', 'Select Option', '1605614683.jpeg', NULL, '<p>hizmet</p>', 'deneme-hizmet', '2020-11-17 12:04:43', '2020-11-17 12:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `hizmet_belge`
--

DROP TABLE IF EXISTS `hizmet_belge`;
CREATE TABLE IF NOT EXISTS `hizmet_belge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hizmet_id` int(11) DEFAULT NULL,
  `belge` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hizmet_belge`
--

INSERT INTO `hizmet_belge` (`id`, `hizmet_id`, `belge`) VALUES
(1, 52, 'deneme-hizmet-1-lorem-ipsum.pdf'),
(2, 52, 'deneme-hizmet-2-lorem-ipsum.pdf'),
(3, 3, 'deneme-hizmet-1-lorem-ipsum.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `hizmet_gorsel`
--

DROP TABLE IF EXISTS `hizmet_gorsel`;
CREATE TABLE IF NOT EXISTS `hizmet_gorsel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hizmet_id` int(11) DEFAULT NULL,
  `gorsel` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hizmet_gorsel`
--

INSERT INTO `hizmet_gorsel` (`id`, `hizmet_id`, `gorsel`) VALUES
(1, 52, '16056143080.jpeg'),
(2, 52, '16056143081.jpeg'),
(3, 3, '16056146830.jpeg'),
(4, 3, '16056146831.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `hizmet_kategori`
--

DROP TABLE IF EXISTS `hizmet_kategori`;
CREATE TABLE IF NOT EXISTS `hizmet_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hizmet_id` int(11) DEFAULT NULL,
  `kategori` text,
  `sira` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `iletisim_ayarlar`
--

DROP TABLE IF EXISTS `iletisim_ayarlar`;
CREATE TABLE IF NOT EXISTS `iletisim_ayarlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text,
  `email_2` text,
  `adres` text,
  `iframe` text,
  `tel_1` text,
  `tel_2` text,
  `tel_3` text,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iletisim_ayarlar`
--

INSERT INTO `iletisim_ayarlar` (`id`, `email`, `email_2`, `adres`, `iframe`, `tel_1`, `tel_2`, `tel_3`, `updated_at`) VALUES
(1, 'ee@gmail.com', 'ee@gmail.com', 'ee', 'ee', 'ee', 'ee', 'ee', '2020-10-30 18:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `istatistik`
--

DROP TABLE IF EXISTS `istatistik`;
CREATE TABLE IF NOT EXISTS `istatistik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `page` varchar(255) DEFAULT NULL,
  `device` text,
  `browser` text,
  `ms` text,
  `tekil` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2124 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `istatistik`
--

INSERT INTO `istatistik` (`id`, `ip`, `date`, `page`, `device`, `browser`, `ms`, `tekil`) VALUES
(2123, '127.0.0.1', '2020-11-18 17:55:10', 'anasayfa', 'Windows 10', 'Firefox', 'SYSTEM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `misyon`
--

DROP TABLE IF EXISTS `misyon`;
CREATE TABLE IF NOT EXISTS `misyon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `title_2` text,
  `image` text,
  `text` text,
  `text_2` text,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `misyon`
--

INSERT INTO `misyon` (`id`, `title`, `title_2`, `image`, `text`, `text_2`, `updated_at`) VALUES
(1, 'ssdfSection 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC', '1914 translation by H. Rackham', '1605702390.jpeg', '<p>\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"</p>', '<p>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p>', '2020-11-18 12:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
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
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `moduleName`, `moduleController`, `moduleLink`, `moduleSlug`, `status`) VALUES
(1, 'Anasayfa', 'HomeController', '/', 'anasayfa', 1),
(2, 'Üyeler', 'AdminController', '/uyeler', 'uyeler', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
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
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `siteName`, `siteDescription`, `siteAuthorName`, `siteAuthorLink`, `siteLogo`, `siteFavicon`) VALUES
(1, 'Panel', 'Panel hakkında açıklama yazınız buraya gelir', 'IFeelCode', 'https://ifeelcode.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_ayarlar`
--

DROP TABLE IF EXISTS `site_ayarlar`;
CREATE TABLE IF NOT EXISTS `site_ayarlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` text,
  `site_description` text,
  `site_footer_text` text,
  `site_google` int(11) DEFAULT NULL,
  `site_logo` text,
  `site_favicon` text,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_ayarlar`
--

INSERT INTO `site_ayarlar` (`id`, `site_name`, `site_description`, `site_footer_text`, `site_google`, `site_logo`, `site_favicon`, `updated_at`) VALUES
(1, 'Site Başlığı', 'Site Açıklama', 'Footer Textt', 0, '1604080337.png', '1606742471.jpeg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `title_2` text,
  `image` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sosyal_medya_ayarlar`
--

DROP TABLE IF EXISTS `sosyal_medya_ayarlar`;
CREATE TABLE IF NOT EXISTS `sosyal_medya_ayarlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facebook` text,
  `twitter` text,
  `instagram` text,
  `youtube` text,
  `linkedin` text,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sosyal_medya_ayarlar`
--

INSERT INTO `sosyal_medya_ayarlar` (`id`, `facebook`, `twitter`, `instagram`, `youtube`, `linkedin`, `updated_at`) VALUES
(1, '/', '/', '/', '/', '/', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `urun`
--

DROP TABLE IF EXISTS `urun`;
CREATE TABLE IF NOT EXISTS `urun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `title_2` text,
  `kategori` text,
  `image` text,
  `pdf` text,
  `text` text,
  `url` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `urun`
--

INSERT INTO `urun` (`id`, `title`, `title_2`, `kategori`, `image`, `pdf`, `text`, `url`, `created_at`, `updated_at`) VALUES
(1, 'deneme urun', 'urun', 'Select Option', '1605620485.jpeg', NULL, '<p>urun</p>', 'deneme-urun', '2020-11-17 13:41:25', '2020-11-17 13:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `urun_belge`
--

DROP TABLE IF EXISTS `urun_belge`;
CREATE TABLE IF NOT EXISTS `urun_belge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urun_id` int(11) DEFAULT NULL,
  `belge` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `urun_belge`
--

INSERT INTO `urun_belge` (`id`, `urun_id`, `belge`) VALUES
(1, 1, 'deneme-urun-1-lorem-ipsum.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `urun_gorsel`
--

DROP TABLE IF EXISTS `urun_gorsel`;
CREATE TABLE IF NOT EXISTS `urun_gorsel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urun_id` int(11) DEFAULT NULL,
  `gorsel` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `urun_gorsel`
--

INSERT INTO `urun_gorsel` (`id`, `urun_id`, `gorsel`) VALUES
(1, 1, '16056204850.jpeg'),
(2, 1, '16056204851.jpeg'),
(4, 1, '16056205020.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `urun_kategori`
--

DROP TABLE IF EXISTS `urun_kategori`;
CREATE TABLE IF NOT EXISTS `urun_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urun_id` int(11) DEFAULT NULL,
  `kategori` text,
  `sira` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` text CHARACTER SET utf8,
  `image` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `image`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ifeelcode', 'Ajans', '1606486303.jpeg', 'admin@universitev.com', NULL, '$2y$10$/VN49fWrMjMo3ApMVORl7.gBHUleAXOcxhElLGg71fiqpYZuxFzx6', NULL, '2020-02-10 00:42:39', '2020-02-09 21:42:39'),
(4, 'Ömer', 'Duman', NULL, 'dumaniomer@outlook.com.tr', NULL, '$2y$10$SRwM6knx29dqQHS1.rs00./O8DBc2rKZMw.s9F275KqRj0kcVM2iO', NULL, '2020-02-16 13:22:08', '2020-02-16 10:22:08'),
(7, 'dadas', 'dadas', '1606484228.jpeg', 'zda@gmail.com', NULL, '$2y$10$JMkZDYlpau94VgUhShZ/FOaMSxwVd0AZ9SpQ5TtrpX9efJFoNNZoK', NULL, '2020-11-27 13:37:08', '2020-11-27 10:37:08');

-- --------------------------------------------------------

--
-- Table structure for table `uye`
--

DROP TABLE IF EXISTS `uye`;
CREATE TABLE IF NOT EXISTS `uye` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` text,
  `soyad` text,
  `email` text,
  `sifre` text,
  `sifre_tekrar` text,
  `image` text,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vizyon`
--

DROP TABLE IF EXISTS `vizyon`;
CREATE TABLE IF NOT EXISTS `vizyon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `title_2` text,
  `image` text,
  `text` text,
  `text_2` text,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vizyon`
--

INSERT INTO `vizyon` (`id`, `title`, `title_2`, `image`, `text`, `text_2`, `updated_at`) VALUES
(1, 'Section 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC', '1914 translation by H. Rackham', '1605701323.jpeg', '<p>\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"</p>', '<p>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p>', '2020-11-18 12:27:09');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
