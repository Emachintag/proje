-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 24 Ağu 2021, 19:29:51
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `proje`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `belge`
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
-- Tablo döküm verisi `belge`
--

INSERT INTO `belge` (`id`, `title`, `image`, `pdf`, `created_at`, `updated_at`) VALUES
(3, 'Belge', '1629670630.jpeg', '1629670852.pdf', '2020-11-18 12:43:34', '2021-08-22 22:20:52');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `galeri`
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `galeri`
--

INSERT INTO `galeri` (`id`, `title`, `title_2`, `link`, `image`, `created_at`, `updated_at`) VALUES
(3, 'Galeri Başlığı', NULL, NULL, '1629670272.jpeg', '2021-08-22 22:11:12', NULL),
(4, 'Galeri Başlığı', NULL, NULL, '1629670272.jpeg', '2021-08-22 22:11:12', NULL),
(2, 'Galeri Başlığı', NULL, NULL, '1629670272.jpeg', '2021-08-22 22:11:12', NULL),
(5, 'Galeri Başlığı', NULL, NULL, '1629670272.jpeg', '2021-08-22 22:11:12', NULL),
(6, 'Galeri Başlığı', NULL, NULL, '1629670272.jpeg', '2021-08-22 22:11:12', NULL),
(7, 'Galeri Başlığı', NULL, NULL, '1629670272.jpeg', '2021-08-22 22:11:12', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hakkimizda`
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
-- Tablo döküm verisi `hakkimizda`
--

INSERT INTO `hakkimizda` (`id`, `title`, `title_2`, `image`, `text`, `text_2`, `updated_at`) VALUES
(1, 'The standard Lorem Ipsum passage, used since the 1500s', NULL, '1629666805.jpeg', '<p>\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"</p>', '<p>Consequat occaecat ullamco amet non eiusmod nostrud dolore irure incididunt est duis anim sunt officia. Fugiat velit proident aliquip nisi incididunt nostrud exercitation proident est nisi. Irure magna elit commodo anim ex veniam culpa eiusmod id nostrud sit cupidatat in veniam ad. Eiusmod consequat eu adipisicing minim anim aliquip cupidatat culpa excepteur quis. Occaecat sit eu exercitation irure Lorem incididunt nostrud.</p>', '2021-08-22 23:03:23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim_ayarlar`
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
-- Tablo döküm verisi `iletisim_ayarlar`
--

INSERT INTO `iletisim_ayarlar` (`id`, `email`, `email_2`, `adres`, `iframe`, `tel_1`, `tel_2`, `tel_3`, `updated_at`) VALUES
(1, 'example@gmail.com', 'example@gmail.com', 'Kemalpaşa Esentepe Kampüsü, Üniversite Cd., 54050', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12091.635064557599!2d30.332731!3d40.742033!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc7996fa884f94c03!2sSakarya%20%C3%9Cniversitesi!5e0!3m2!1str!2sus!4v1629828890561!5m2!1str!2sus\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', '+902642955454', '+902642955454', '+902642955454', '2020-10-30 18:22:33');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `istatistik`
--

DROP TABLE IF EXISTS `istatistik`;
CREATE TABLE IF NOT EXISTS `istatistik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `page` text,
  `device` mediumtext,
  `browser` mediumtext,
  `ms` mediumtext,
  `tekil` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2202 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `istatistik`
--

INSERT INTO `istatistik` (`id`, `ip`, `date`, `page`, `device`, `browser`, `ms`, `tekil`) VALUES
(2201, '127.0.0.1', '2021-08-24 21:44:29', 'urunlerimiz', 'Windows 10', 'Firefox', 'SYSTEM', 0),
(2200, '127.0.0.1', '2021-08-24 21:42:10', 'anasayfa', 'Windows 10', 'Firefox', 'SYSTEM', 0),
(2199, '127.0.0.1', '2021-08-24 21:11:38', 'anasayfa', 'Windows 10', 'Firefox', 'SYSTEM', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `misyon`
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
-- Tablo döküm verisi `misyon`
--

INSERT INTO `misyon` (`id`, `title`, `title_2`, `image`, `text`, `text_2`, `updated_at`) VALUES
(1, 'ssdfSection 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC', NULL, '1629673257.jpeg', '<p>\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '2021-08-22 23:00:57');

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
-- Tablo için tablo yapısı `sakarya`
--

DROP TABLE IF EXISTS `sakarya`;
CREATE TABLE IF NOT EXISTS `sakarya` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `text` text,
  `image` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sakarya`
--

INSERT INTO `sakarya` (`id`, `title`, `text`, `image`) VALUES
(1, 'sdf', NULL, NULL);

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
(1, 'Panel', 'Panel hakkında açıklama yazınız buraya gelir', 'Elmar Dadashov', 'https://sakarya.edu.tr', NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site_ayarlar`
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
-- Tablo döküm verisi `site_ayarlar`
--

INSERT INTO `site_ayarlar` (`id`, `site_name`, `site_description`, `site_footer_text`, `site_google`, `site_logo`, `site_favicon`, `updated_at`) VALUES
(1, 'Site Başlığı', 'Site Açıklama', 'Signup for our newsletter to get the latest news, updates and special offers in your inbox.Signup for our newsletter to get the latest news, updates and special offers in your inbox.', 0, '16296717002.png', '16296716801.png', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `title_2` text,
  `buton` text,
  `link` text,
  `image` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `slider`
--

INSERT INTO `slider` (`id`, `title`, `title_2`, `buton`, `link`, `image`, `created_at`, `updated_at`) VALUES
(3, 'We Fight for Right', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Buton', 'https://www.google.com', '1629672876.jpeg', '2021-08-22 22:54:36', NULL),
(4, 'We Fight for Right', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Buton', 'https://www.google.com', '1629672876.jpeg', '2021-08-22 22:54:36', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sosyal_medya_ayarlar`
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
-- Tablo döküm verisi `sosyal_medya_ayarlar`
--

INSERT INTO `sosyal_medya_ayarlar` (`id`, `facebook`, `twitter`, `instagram`, `youtube`, `linkedin`, `updated_at`) VALUES
(1, '/', '/', '/', '/', '/', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tarim`
--

DROP TABLE IF EXISTS `tarim`;
CREATE TABLE IF NOT EXISTS `tarim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `text` text,
  `text_2` text,
  `image` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tarim`
--

INSERT INTO `tarim` (`id`, `title`, `text`, `text_2`, `image`) VALUES
(1, 'Reputation. Respect. Result.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '1629673222.jpeg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun`
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
  `youtube` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urun`
--

INSERT INTO `urun` (`id`, `title`, `title_2`, `kategori`, `image`, `pdf`, `text`, `url`, `youtube`, `created_at`, `updated_at`) VALUES
(1, 'The Lawyer European Awards shortlist test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '1', '1629668217.jpeg', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'deneme-urun', 'yUR3RBa1xP0', '2020-11-17 13:41:25', '2021-08-24 18:45:01'),
(2, 'The Lawyer European Awards shortlist', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2', '1629668217.jpeg', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'deneme-urun2', NULL, '2020-11-17 13:41:25', '2021-08-22 21:36:57'),
(3, 'The Lawyer European Awards shortlist', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '1', '1629668217.jpeg', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'deneme-urun', NULL, '2020-11-17 13:41:25', '2021-08-22 21:36:57'),
(4, 'The Lawyer European Awards shortlist', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '1', '1629668217.jpeg', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'deneme-urun', NULL, '2020-11-17 13:41:25', '2021-08-22 21:36:57');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun_belge`
--

DROP TABLE IF EXISTS `urun_belge`;
CREATE TABLE IF NOT EXISTS `urun_belge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urun_id` int(11) DEFAULT NULL,
  `belge` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urun_belge`
--

INSERT INTO `urun_belge` (`id`, `urun_id`, `belge`) VALUES
(1, 1, 'deneme-urun-1-lorem-ipsum.pdf');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun_gorsel`
--

DROP TABLE IF EXISTS `urun_gorsel`;
CREATE TABLE IF NOT EXISTS `urun_gorsel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urun_id` int(11) DEFAULT NULL,
  `gorsel` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urun_gorsel`
--

INSERT INTO `urun_gorsel` (`id`, `urun_id`, `gorsel`) VALUES
(10, 1, '16296699502.jpeg'),
(9, 1, '16296699501.jpeg'),
(8, 1, '16296699500.jpeg'),
(5, 1, '16296682170.jpeg'),
(6, 1, '16296682171.jpeg'),
(7, 1, '16296682172.jpeg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
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
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `image`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Elmar', 'Dadashov', '1629828777.png', 'admin@gmail.com', NULL, '$2y$10$/VN49fWrMjMo3ApMVORl7.gBHUleAXOcxhElLGg71fiqpYZuxFzx6', NULL, '2020-02-10 00:42:39', '2020-02-09 21:42:39'),
(4, 'Ömer', 'Duman', NULL, 'dumaniomer@outlook.com.tr', NULL, '$2y$10$SRwM6knx29dqQHS1.rs00./O8DBc2rKZMw.s9F275KqRj0kcVM2iO', NULL, '2020-02-16 13:22:08', '2020-02-16 10:22:08'),
(7, 'dadas', 'dadas', '1606484228.jpeg', 'zda@gmail.com', NULL, '$2y$10$JMkZDYlpau94VgUhShZ/FOaMSxwVd0AZ9SpQ5TtrpX9efJFoNNZoK', NULL, '2020-11-27 13:37:08', '2020-11-27 10:37:08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uye`
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
-- Tablo için tablo yapısı `vizyon`
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
-- Tablo döküm verisi `vizyon`
--

INSERT INTO `vizyon` (`id`, `title`, `title_2`, `image`, `text`, `text_2`, `updated_at`) VALUES
(1, 'Section 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC', NULL, '1629673241.jpeg', '<p>\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '2021-08-22 23:00:41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
