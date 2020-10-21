-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2020 at 03:36 PM
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
-- Table structure for table `ability`
--

CREATE TABLE `ability` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ability`
--

INSERT INTO `ability` (`id`, `label`, `name`) VALUES
(1, 'ALL', 'Permissão total'),
(2, 'MANAGE_QUEUE', 'Gerenciar fila'),
(3, 'MANAGE_MODS', 'Gerenciar moderadores'),
(4, 'MANAGE_USERS', 'Gerenciar usuários'),
(5, 'MANAGE_OFFERS', 'Gerenciar ofertas');

-- --------------------------------------------------------

--
-- Table structure for table `ability_role`
--

CREATE TABLE `ability_role` (
  `id_ability` bigint(20) UNSIGNED NOT NULL,
  `id_role` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ability_role`
--

INSERT INTO `ability_role` (`id_ability`, `id_role`) VALUES
(1, 4),
(1, 3),
(2, 2),
(3, 2);

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
  `slug` varchar(255) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `name` varchar(100) NOT NULL,
  `old_price` double DEFAULT NULL,
  `new_price` double NOT NULL,
  `end_offer` date NOT NULL,
  `image` varchar(55) NOT NULL,
  `status` enum('pending','approved','refused') NOT NULL DEFAULT 'pending'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `id_category`, `id_subcategory`, `slug`, `link`, `name`, `old_price`, `new_price`, `end_offer`, `image`, `status`) VALUES
(1, 1, 3, 'homefront-the-revolution-expansion-pass', 'https://www.microsoft.com/pt-br/p/homefront-the-revolution-expansion-pass/bx9pv7cclhgr?%3FranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;epi=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;irgwc=1&#38;OCID=AID681541_aff_7803_1243925&#38;tduid=%28ir__xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00%29%287803%29%281243925%29%28wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ%29%28%29&#38;irclickid=_xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00&#38;rtc=1&#38;activetab=pivot:overviewtab', 'Homefront®: The Revolution Expansion Pass', 45, 19, '2020-10-30', 'a834079e69463a602a5017cad39c17e5jpg', 'approved'),
(2, 1, 6, 'the-division-2', 'https://www.microsoft.com/pt-br/p/homefront-the-revolution-expansion-pass/bx9pv7cclhgr?%3FranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;epi=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;irgwc=1&#38;OCID=AID681541_aff_7803_1243925&#38;tduid=%28ir__xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00%29%287803%29%281243925%29%28wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ%29%28%29&#38;irclickid=_xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00&#38;rtc=1&#38;activetab=pivot:overviewtab', 'The Division 2', 16, 8, '2020-10-31', 'e5e41af6de3926fdd788bf5d7c22f75cjpg', 'approved'),
(4, 1, 2, 'metro-redux-bundle', 'https://www.microsoft.com/pt-br/p/homefront-the-revolution-expansion-pass/bx9pv7cclhgr?%3FranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;epi=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;irgwc=1&#38;OCID=AID681541_aff_7803_1243925&#38;tduid=%28ir__xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00%29%287803%29%281243925%29%28wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ%29%28%29&#38;irclickid=_xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00&#38;rtc=1&#38;activetab=pivot:overviewtab', 'Metro Redux Bundle', 78, 19, '2020-10-31', '237a49bef20342b5316ffa493fbcebb5jpg', 'approved'),
(7, 1, 4, 'playstation-4', 'https://store.playstation.com/pt-br/product/UP1001-CUSA01401_00-ANEMONEREV100000?utm_source=promobit', 'PlayStation 4', 2500, 1999, '2022-04-30', '152e081dbdf8eaf753c472d5cb9e598bjpg', 'refused'),
(6, 3, 7, 'jogo-the-lonely-hacker-android', 'https://play.google.com/store/apps/details?utm_source=promobit&#38;id=com.TheLonelyDeveloper.TheLonelyHacker', 'Jogo The Lonely Hacker - Android', 4, 0, '2020-10-29', '66859397b50ea148b49a9a3c6b7ef47fjpg', 'approved'),
(8, 1, 6, 'call-of-duty-black-ops-cold-war-beta-aberto', 'microsoft.com/pt-br/p/call-of-duty-black-ops-cold-war-open-beta/9nw9mbbvpnpl?ranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-LH1pF9r70Szm1PrZl.2W2A&#38;epi=wuBjaD0yAek-LH1pF9r70Szm1PrZl.2W2A&#38;irgwc=1&#38;OCID=AID2000142_aff_7803_1243925&#38;tduid=%28ir__echp36uwi0kftmzkkk0sohzjx32xsw9s1f6qedht00%29%287803%29%281243925%29%28wuBjaD0yAek-LH1pF9r70Szm1PrZl.2W2A%29%28%29&#38;irclickid=_echp36uwi0kftmzkkk0sohzjx32xsw9s1f6qedht00&#38;activetab=pivot%3Aoverviewtab', ' Call of Duty®: Black Ops Cold War - Beta Aberto', 20, 0, '2020-11-30', '155e1047ec2a718dff40d2c4b9bb17c6jpg', 'approved'),
(9, 1, 4, 'game-watch-dogs-2-hits-ps4', 'https://www.kabum.com.br/cgi-local/site/produtos/descricao_ofertas.cgi?codigo=112780&#38;awc=17729_1603112669_9bb2448c441de6fdded1a7f4393a1cb8&#38;utm_source=AWIN&#38;utm_medium=AFILIADOS&#38;utm_campaign=hallowin_out20&#38;utm_content=home&#38;utm_term=https%3A%2F%2Fwww.promobit.com.br', 'Game Watch Dogs 2 Hits PS4', 79, 0, '2020-10-31', '89e6ede83df78c296358d03c133aa37ajpg', 'refused');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `label`, `name`) VALUES
(1, 'USER', 'Usuário'),
(2, 'MODERATOR', 'Moderador'),
(3, 'ADMIN', 'Administrador'),
(4, 'OWNER', 'Dono');

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
  `id_role` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(55) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `suspended` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_role`, `name`, `email`, `password`, `suspended`) VALUES
(1, 3, 'Admin', 'admin@admin.com', '$2y$10$/iKT/F741lJAPypnnblHQ.yEm4IH9GS4Pi7BRb3REpWJW.H9QTGmK', 0),
(2, 1, 'Douglas Pinheiro Goulart', 'douglaspigoulart@gmail.com', '$2y$10$kXHGL/jHDIBO/HZQ4n2nHepsc16IzbeOFSCcEEcmjlh80I39xMC4a', 0),
(4, 2, 'Moderador', 'mod@mod.com', '$2y$10$K1Cg8L54uCZZ53URBAyoBO/M8n5277NiR6cGspnQoTua7lcz2tqh.', 0),
(5, 1, 'Luciana Ramos Pinheiro Inácio', 'luciana.rpi93@gmail.com', '$2y$10$RJkbwUGeFLI7S8qSSUVS2uRs6P3rDCATKFLd8QFN0i2SLiSznlatC', 0),
(7, 4, 'Owner', 'owner@owner.com', '$2y$10$18Xy4ueE8D1pQYTRKfJMeuu/y89L12hRUu4O5hOyiTeLrZk8eEg8u', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ability`
--
ALTER TABLE `ability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ability`
--
ALTER TABLE `ability`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
