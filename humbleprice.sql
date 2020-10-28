-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 28, 2020 at 09:07 PM
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
-- Table structure for table `abilities`
--

CREATE TABLE `abilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `abilities`
--

INSERT INTO `abilities` (`id`, `label`, `name`) VALUES
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `name`) VALUES
(1, 'games', 'Jogos'),
(2, 'food', 'Comida'),
(3, 'apps-and-software', 'Aplicativos e Software'),
(4, 'babys-and-children', 'Bebês e Crianças'),
(5, 'drinks', 'Bebidas');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_offer` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `id_offer`, `id_user`) VALUES
(1, 10, 1),
(7, 15, 7),
(9, 12, 7),
(11, 10, 7),
(16, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_category` bigint(20) UNSIGNED NOT NULL,
  `id_subcategory` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `name` varchar(100) NOT NULL,
  `additional_info` text DEFAULT NULL,
  `old_price` double DEFAULT NULL,
  `new_price` double NOT NULL,
  `published_at` date NOT NULL DEFAULT current_timestamp(),
  `end_offer` date DEFAULT NULL,
  `image` varchar(55) NOT NULL,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `status` enum('pending','approved','refused','closed') NOT NULL DEFAULT 'pending'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `id_user`, `id_category`, `id_subcategory`, `slug`, `link`, `name`, `additional_info`, `old_price`, `new_price`, `published_at`, `end_offer`, `image`, `views`, `status`) VALUES
(1, 7, 1, 3, 'homefront-the-revolution-expansion-pass', 'https://www.microsoft.com/pt-br/p/homefront-the-revolution-expansion-pass/bx9pv7cclhgr?%3FranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;epi=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;irgwc=1&#38;OCID=AID681541_aff_7803_1243925&#38;tduid=%28ir__xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00%29%287803%29%281243925%29%28wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ%29%28%29&#38;irclickid=_xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00&#38;rtc=1&#38;activetab=pivot:overviewtab', 'Homefront®: The Revolution Expansion Pass', NULL, 45, 19, '2020-10-25', '2020-10-30', 'a834079e69463a602a5017cad39c17e5jpg', 23, 'pending'),
(4, 7, 1, 5, 'metro-redux-bundle', 'https://www.microsoft.com/pt-br/p/homefront-the-revolution-expansion-pass/bx9pv7cclhgr?%3FranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;epi=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;irgwc=1&#38;OCID=AID681541_aff_7803_1243925&#38;tduid=%28ir__xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00%29%287803%29%281243925%29%28wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ%29%28%29&#38;irclickid=_xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00&#38;rtc=1&#38;activetab=pivot:overviewtab', 'Metro Redux Bundle', NULL, 78, 19, '2020-10-25', '2020-10-31', '5b334cf0d0c62a0471b4f74651532caa.jpg', 29, 'pending'),
(12, 7, 1, 6, 'red-dead-redemption-2', 'https://www.microsoft.com/pt-br/p/red-dead-redemption-2/bpswgqbw7r3g', 'Red Dead Redemption 2', NULL, 249, 199, '2020-10-25', '2021-03-11', '4805a0b5bc10794363ba327d034141e1.jpg', 59, 'approved'),
(8, 7, 1, 6, 'call-of-duty-black-ops-cold-war-beta', 'microsoft.com/pt-br/p/call-of-duty-black-ops-cold-war-open-beta/9nw9mbbvpnpl?ranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-LH1pF9r70Szm1PrZl.2W2A&#38;epi=wuBjaD0yAek-LH1pF9r70Szm1PrZl.2W2A&#38;irgwc=1&#38;OCID=AID2000142_aff_7803_1243925&#38;tduid=%28ir__echp36uwi0kftmzkkk0sohzjx32xsw9s1f6qedht00%29%287803%29%281243925%29%28wuBjaD0yAek-LH1pF9r70Szm1PrZl.2W2A%29%28%29&#38;irclickid=_echp36uwi0kftmzkkk0sohzjx32xsw9s1f6qedht00&#38;activetab=pivot%3Aoverviewtab', ' Call of Duty®: Black Ops Cold War - Beta ', NULL, 20, 0, '2020-10-25', '2020-10-24', '155e1047ec2a718dff40d2c4b9bb17c6jpg', 52, 'pending'),
(9, 7, 1, 4, 'game-watch-dogs-2-hits-ps4', 'https://www.kabum.com.br/cgi-local/site/produtos/descricao_ofertas.cgi?codigo=112780&#38;awc=17729_1603112669_9bb2448c441de6fdded1a7f4393a1cb8&#38;utm_source=AWIN&#38;utm_medium=AFILIADOS&#38;utm_campaign=hallowin_out20&#38;utm_content=home&#38;utm_term=https%3A%2F%2Fwww.promobit.com.br', 'Game Watch Dogs 2 Hits PS4', NULL, 79, 0, '2020-10-25', '2020-10-31', '89e6ede83df78c296358d03c133aa37ajpg', 11, 'pending'),
(10, 7, 1, 6, 'ori-and-the-blind-forest-definitive-edition', 'https://www.microsoft.com/pt-br/p/ori-and-the-blind-forest-definitive-edition/bw85kqb8q31m?activetab=pivot:overviewtab', 'Ori and the Blind Forest: Definitive Edition', NULL, 39, 9, '2020-10-25', NULL, 'a38e27e3f0d25750a042e04b14103ed1jpg', 120, 'approved'),
(11, 7, 1, 5, 'child-of-light', 'https://www.microsoft.com/pt-br/p/child-of-light/bq9q620nc614?activetab=pivot:overviewtab', ' Child of Light', NULL, 35, 24, '2020-10-25', NULL, '14e8b348599f978cc09d11fd16290bdbjpg', 25, 'approved'),
(14, 7, 1, 6, 'assassin-39-s-creed-odyssey', 'https://www.microsoft.com/PT-BR/p/assassins-creed-odyssey/BW9TWC8L4JCS?id=Pubsalegame_Week43&#38;ranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-fUfGUiMjo1zUkqwWYcsoeg&#38;epi=wuBjaD0yAek-fUfGUiMjo1zUkqwWYcsoeg&#38;irgwc=1&#38;OCID=AID2000142_aff_7803_1243925&#38;tduid=%28ir__echp36uwi0kftmzkkk0sohzjx32xs39ehn6qedhz00%29%287803%29%281243925%29%28wuBjaD0yAek-fUfGUiMjo1zUkqwWYcsoeg%29%28%29&#38;irclickid=_echp36uwi0kftmzkkk0sohzjx32xs39ehn6qedhz00&#38;activetab=pivot%3Aoverviewtab', 'Assassin&#39;s Creed® Odyssey', '&#60;p&#62;Forma de pagamento:&#38;nbsp;&#60;strong&#62;em 1x no cartão de crédito&#60;/strong&#62;.&#60;/p&#62;', 199, 49, '2020-10-25', '2020-11-05', '749fbc2093637b40410e9022cd37c59c.jpg', 86, 'approved'),
(15, 7, 1, 6, 'the-witcher-3-wild-hunt-complete-edition', 'https://www.microsoft.com/pt-br/p/the-witcher-3-wild-hunt-complete-edition/c261457lcnmj?ocid=AID2000142_aff_7803_1243925#activetab=pivot:overviewtab', 'The Witcher 3: Wild Hunt – Complete Edition', '&#60;p&#62;O jogo mais premiado de 2015!&#38;nbsp;&#60;/p&#62;&#60;p&#62;Torne-se um mercenário caçador de monstros e embarque em uma épica jornada para encontrar a criança da profecia, uma arma viva capaz de incríveis destruições.&#38;nbsp;&#60;/p&#62;&#60;p&#62;&#60;strong&#62;INCLUI TODAS AS EXPANSÕES E CONTEÚDO ADICIONAL.&#60;/strong&#62;&#60;/p&#62;', 190, 152, '2020-10-25', NULL, 'f9c477ea2d2dba8fdd736831b33cd778.jpg', 205, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `label`, `name`) VALUES
(1, 'USER', 'Usuário'),
(2, 'MODERATOR', 'Moderador'),
(3, 'ADMIN', 'Administrador'),
(4, 'OWNER', 'Dono');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_category` bigint(20) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `id_category`, `slug`, `name`) VALUES
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_role` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(55) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `suspended` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_role`, `name`, `email`, `password`, `suspended`) VALUES
(1, 3, 'Admin', 'admin@admin.com', '$2y$10$/iKT/F741lJAPypnnblHQ.yEm4IH9GS4Pi7BRb3REpWJW.H9QTGmK', 0),
(2, 1, 'Douglas Pinheiro Goulart', 'douglaspigoulart@gmail.com', '$2y$10$kXHGL/jHDIBO/HZQ4n2nHepsc16IzbeOFSCcEEcmjlh80I39xMC4a', 0),
(4, 2, 'Moderador', 'mod@mod.com', '$2y$10$K1Cg8L54uCZZ53URBAyoBO/M8n5277NiR6cGspnQoTua7lcz2tqh.', 0),
(7, 4, 'Owner', 'owner@owner.com', '$2y$10$18Xy4ueE8D1pQYTRKfJMeuu/y89L12hRUu4O5hOyiTeLrZk8eEg8u', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abilities`
--
ALTER TABLE `abilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abilities`
--
ALTER TABLE `abilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
