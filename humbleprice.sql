-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 15, 2020 at 06:46 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Humbleprice`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `slug`, `name`) VALUES
(1, 'games', 'Jogos'),
(2, 'food', 'Comida'),
(3, 'apps-and-software', 'Aplicativos e Software'),
(4, 'babys-and-children', 'Bebês e Crianças'),
(5, 'drinks', 'Bebidas');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_category` bigint(20) UNSIGNED NOT NULL,
  `id_subcategory` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(1000) NOT NULL,
  `name` varchar(100) NOT NULL,
  `old_price` double DEFAULT NULL,
  `new_price` double NOT NULL,
  `end_offer` date NOT NULL,
  `image` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `id_category`, `id_subcategory`, `link`, `name`, `old_price`, `new_price`, `end_offer`, `image`) VALUES
(1, 1, 3, 'https://www.microsoft.com/pt-br/p/homefront-the-revolution-expansion-pass/bx9pv7cclhgr?%3FranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;epi=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;irgwc=1&#38;OCID=AID681541_aff_7803_1243925&#38;tduid=%28ir__xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00%29%287803%29%281243925%29%28wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ%29%28%29&#38;irclickid=_xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00&#38;rtc=1&#38;activetab=pivot:overviewtab', 'Homefront®: The Revolution Expansion Pass', 45, 19, '2020-10-30', 'a834079e69463a602a5017cad39c17e5jpg'),
(2, 1, 6, 'https://www.microsoft.com/pt-br/p/homefront-the-revolution-expansion-pass/bx9pv7cclhgr?%3FranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;epi=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;irgwc=1&#38;OCID=AID681541_aff_7803_1243925&#38;tduid=%28ir__xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00%29%287803%29%281243925%29%28wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ%29%28%29&#38;irclickid=_xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00&#38;rtc=1&#38;activetab=pivot:overviewtab', 'The Division 2', 16, 8, '2020-10-31', 'e5e41af6de3926fdd788bf5d7c22f75cjpg'),
(4, 1, 2, 'https://www.microsoft.com/pt-br/p/homefront-the-revolution-expansion-pass/bx9pv7cclhgr?%3FranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;epi=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;irgwc=1&#38;OCID=AID681541_aff_7803_1243925&#38;tduid=%28ir__xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00%29%287803%29%281243925%29%28wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ%29%28%29&#38;irclickid=_xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00&#38;rtc=1&#38;activetab=pivot:overviewtab', 'Metro Redux Bundle', 78, 19, '2020-10-31', '237a49bef20342b5316ffa493fbcebb5jpg'),
(6, 3, 7, 'https://play.google.com/store/apps/details?utm_source=promobit&#38;id=com.TheLonelyDeveloper.TheLonelyHacker', 'Jogo The Lonely Hacker - Android', 4, 0, '2020-10-29', '66859397b50ea148b49a9a3c6b7ef47fjpg');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_category` bigint(20) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `id_category`, `slug`, `name`) VALUES
(1, 1, 'pc', 'PC'),
(2, 1, 'nintendo-switch', 'Nintendo Switch'),
(3, 1, 'playstation-3', 'PlayStation 3'),
(4, 1, 'playstation-4', 'PlayStation 4'),
(5, 1, 'xbox-360', 'Xbox 360'),
(6, 1, 'xbox-one', 'Xbox One'),
(7, 3, 'android-apps', 'Apps para Android'),
(8, 3, 'ios-apps', 'Apps para iOS'),
(9, 3, 'windows-phone-apps', 'Apps para Windows Phone'),
(10, 3, 'desktop-software', 'Softwares para Desktop');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `admin`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$/iKT/F741lJAPypnnblHQ.yEm4IH9GS4Pi7BRb3REpWJW.H9QTGmK', 1),
(2, 'Douglas Pinheiro Goulart', 'douglaspigoulart@gmail.com', '$2y$10$kXHGL/jHDIBO/HZQ4n2nHepsc16IzbeOFSCcEEcmjlh80I39xMC4a', 0),
(3, 'Douglas Pinheiro Goulart', 'dsadsaddd@saddadsadasd.asdsad', '$2y$10$20c/nHXPm91OKUgmd3X/9.22tZDhoaP7WLMd0hTO5bknGZBgLIyn6', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
