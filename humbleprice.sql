-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 05, 2020 at 12:48 AM
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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_parent` bigint(20) UNSIGNED DEFAULT NULL,
  `id_offer` bigint(20) UNSIGNED NOT NULL,
  `id_author` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_parent`, `id_offer`, `id_author`, `comment`, `created_at`) VALUES
(1, NULL, 15, 1, 'Esse jogo sem duvidas é o melhor da geração disparado', '2020-10-30 19:50:17'),
(2, 1, 15, 2, 'Esse jogo é realmente incrivel! Um dos melhores do genẽro', '2020-10-30 19:50:17'),
(3, NULL, 15, 4, 'Acabei de comprar com um conta nova e com o cupom, tudo certo! Partiu rejogar essa maravilha', '2020-10-30 19:51:55'),
(4, 1, 15, 7, 'O jogo realmente é bom, uma pena ser tão longo!', '2020-10-30 19:53:43'),
(32, NULL, 15, 1, '<p>Jogo muito <strong>bom</strong>.</p>', '2020-10-31 18:00:15'),
(33, NULL, 10, 2, '<p>Um dos jogos mais lindos que já joguei.</p>', '2020-11-01 00:19:39'),
(66, 3, 15, 1, '<p>@Moderador Tenha um bom jogo :D</p>', '2020-11-01 15:19:31'),
(67, 1, 15, 1, '<p>@Owner A jornada vale a pena rs</p>', '2020-11-01 15:27:12'),
(69, 33, 10, 1, '<p>@Douglas Pinheiro Goulart O sucessor dele (Ori and the Will of the Wisps) é mais lindo ainda.</p>', '2020-11-01 15:29:07'),
(70, 1, 15, 4, '<p>@Admin Fico entre ele e o Red Read Redemption 2. São dois jogos incríveis.</p>', '2020-11-01 21:03:20'),
(71, NULL, 14, 7, '<p>Um dos melhores Assassin\'s Creed. Ansioso pro Valhalla :D</p>', '2020-11-01 21:28:12'),
(73, NULL, 15, 7, '<p>Melhor RPG que já joguei</p>', '2020-11-01 21:28:50'),
(74, 33, 10, 7, '<p>@Admin Verdade. Aquele jogo é extremamente bonito!</p>', '2020-11-01 21:31:24'),
(75, NULL, 10, 7, '<p>Jogão!</p>', '2020-11-01 21:31:34'),
(76, NULL, 12, 1, '<p>Rockstar humilde demais com os gaúchos por fazer um jogo ambientado no Rio Grande do Sul</p>', '2020-11-01 22:00:15'),
(77, 76, 12, 2, '<p>@Admin Só faltou o chimarrão pra ficar perfeito</p>', '2020-11-01 22:01:28'),
(94, NULL, 16, 7, '<p>Um dos melhores battle royales.</p>', '2020-11-02 11:22:23'),
(95, 94, 16, 1, '<p>@Owner Esse e o Warzone</p>', '2020-11-02 11:23:35'),
(96, NULL, 9, 1, '<p>Um dos melhores jogos da Ubisoft.</p>', '2020-11-02 11:52:27'),
(97, 96, 9, 1, '<p>@Admin O primeiro também é muito bom</p>', '2020-11-02 11:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `comment_likes`
--

CREATE TABLE `comment_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_comment` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment_likes`
--

INSERT INTO `comment_likes` (`id`, `id_comment`, `id_user`) VALUES
(1, 1, 7),
(4, 2, 1),
(7, 69, 7),
(8, 68, 7),
(9, 32, 7),
(11, 76, 2),
(14, 73, 7),
(15, 2, 7),
(23, 94, 1),
(24, 3, 1),
(25, 4, 1),
(26, 70, 1),
(28, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_author` bigint(20) UNSIGNED NOT NULL,
  `id_category` bigint(20) UNSIGNED NOT NULL,
  `id_subcategory` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `link` varchar(1025) NOT NULL,
  `name` varchar(255) NOT NULL,
  `additional_info` text DEFAULT NULL,
  `old_price` double DEFAULT NULL,
  `new_price` double NOT NULL,
  `published_at` date NOT NULL DEFAULT current_timestamp(),
  `end_offer` date DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `status` enum('pending','approved','refused','closed') NOT NULL DEFAULT 'pending'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `id_author`, `id_category`, `id_subcategory`, `slug`, `link`, `name`, `additional_info`, `old_price`, `new_price`, `published_at`, `end_offer`, `image`, `views`, `status`) VALUES
(1, 7, 1, 3, 'homefront-the-revolution-expansion-pass-56285', 'https://www.microsoft.com/pt-br/p/homefront-the-revolution-expansion-pass/bx9pv7cclhgr?%3FranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;epi=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;irgwc=1&#38;OCID=AID681541_aff_7803_1243925&#38;tduid=%28ir__xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00%29%287803%29%281243925%29%28wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ%29%28%29&#38;irclickid=_xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00&#38;rtc=1&#38;activetab=pivot:overviewtab', 'Homefront®: The Revolution Expansion Pass', NULL, 45, 19, '2020-10-25', '2021-10-30', 'a834079e69463a602a5017cad39c17e5jpg', 32, 'approved'),
(4, 7, 1, 5, 'metro-redux-bundle', 'https://www.microsoft.com/pt-br/p/homefront-the-revolution-expansion-pass/bx9pv7cclhgr?%3FranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;epi=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;irgwc=1&#38;OCID=AID681541_aff_7803_1243925&#38;tduid=%28ir__xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00%29%287803%29%281243925%29%28wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ%29%28%29&#38;irclickid=_xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00&#38;rtc=1&#38;activetab=pivot:overviewtab', 'Metro Redux Bundle', NULL, 78, 19, '2020-10-25', '2021-10-30', '5b334cf0d0c62a0471b4f74651532caa.jpg', 35, 'closed'),
(12, 7, 1, 6, 'red-dead-redemption-2-56305', 'https://www.microsoft.com/pt-br/p/red-dead-redemption-2/bpswgqbw7r3g', 'Red Dead Redemption 2', NULL, 249, 199, '2020-10-25', '2021-10-30', '4805a0b5bc10794363ba327d034141e1.jpg', 84, 'approved'),
(8, 7, 1, 6, 'call-of-duty-black-ops-cold-war-beta-56346', 'microsoft.com/pt-br/p/call-of-duty-black-ops-cold-war-open-beta/9nw9mbbvpnpl?ranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-LH1pF9r70Szm1PrZl.2W2A&#38;epi=wuBjaD0yAek-LH1pF9r70Szm1PrZl.2W2A&#38;irgwc=1&#38;OCID=AID2000142_aff_7803_1243925&#38;tduid=%28ir__echp36uwi0kftmzkkk0sohzjx32xsw9s1f6qedht00%29%287803%29%281243925%29%28wuBjaD0yAek-LH1pF9r70Szm1PrZl.2W2A%29%28%29&#38;irclickid=_echp36uwi0kftmzkkk0sohzjx32xsw9s1f6qedht00&#38;activetab=pivot%3Aoverviewtab', ' Call of Duty®: Black Ops Cold War - Beta ', NULL, 20, 0, '2020-10-25', '2021-10-30', '155e1047ec2a718dff40d2c4b9bb17c6jpg', 61, 'approved'),
(9, 7, 1, 4, 'game-watch-dogs-2-hits-ps4-56313', 'https://www.kabum.com.br/cgi-local/site/produtos/descricao_ofertas.cgi?codigo=112780&#38;awc=17729_1603112669_9bb2448c441de6fdded1a7f4393a1cb8&#38;utm_source=AWIN&#38;utm_medium=AFILIADOS&#38;utm_campaign=hallowin_out20&#38;utm_content=home&#38;utm_term=https%3A%2F%2Fwww.promobit.com.br', 'Game Watch Dogs 2 Hits PS4', NULL, 79, 0, '2020-10-25', '2021-10-30', 'db244a5986b2d05f626a532943d37574.jpg', 19, 'approved'),
(10, 7, 1, 6, 'ori-and-the-blind-forest-definitive-edition-56255', 'https://www.microsoft.com/pt-br/p/ori-and-the-blind-forest-definitive-edition/bw85kqb8q31m?activetab=pivot:overviewtab', 'Ori and the Blind Forest: Definitive Edition', NULL, 39, 9, '2020-10-25', NULL, 'a38e27e3f0d25750a042e04b14103ed1jpg', 170, 'approved'),
(11, 7, 1, 5, 'child-of-light-56265', 'https://www.microsoft.com/pt-br/p/child-of-light/bq9q620nc614?activetab=pivot:overviewtab', ' Child of Light', NULL, 35, 24, '2020-10-25', NULL, '14e8b348599f978cc09d11fd16290bdbjpg', 48, 'closed'),
(14, 7, 1, 6, 'assassin-39-s-creed-odyssey-56319', 'https://www.microsoft.com/PT-BR/p/assassins-creed-odyssey/BW9TWC8L4JCS?id=Pubsalegame_Week43&#38;ranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-fUfGUiMjo1zUkqwWYcsoeg&#38;epi=wuBjaD0yAek-fUfGUiMjo1zUkqwWYcsoeg&#38;irgwc=1&#38;OCID=AID2000142_aff_7803_1243925&#38;tduid=%28ir__echp36uwi0kftmzkkk0sohzjx32xs39ehn6qedhz00%29%287803%29%281243925%29%28wuBjaD0yAek-fUfGUiMjo1zUkqwWYcsoeg%29%28%29&#38;irclickid=_echp36uwi0kftmzkkk0sohzjx32xs39ehn6qedhz00&#38;activetab=pivot%3Aoverviewtab', 'Assassin&#39;s Creed® Odyssey', '<p>Forma de pagamento:&nbsp;<strong>em 1x no cartão de crédito</strong>.</p>', 199, 49, '2020-10-25', '2021-10-30', '749fbc2093637b40410e9022cd37c59c.jpg', 106, 'approved'),
(15, 7, 1, 6, 'the-witcher-3-wild-hunt-complete-edition-56272', 'https://www.microsoft.com/pt-br/p/the-witcher-3-wild-hunt-complete-edition/c261457lcnmj?ocid=AID2000142_aff_7803_1243925#activetab=pivot:overviewtab', 'The Witcher 3: Wild Hunt – Complete Edition', '<p>O jogo mais premiado de 2015!&nbsp;</p><p>Torne-se um mercenário caçador de monstros e embarque em uma épica jornada para encontrar a criança da profecia, uma arma viva capaz de incríveis destruições.&nbsp;</p><p><strong>INCLUI TODAS AS EXPANSÕES E CONTEÚDO ADICIONAL.</strong></p>', 190, 152, '2020-10-25', NULL, 'f9c477ea2d2dba8fdd736831b33cd778.jpg', 835, 'approved'),
(18, 2, 1, 6, 'grand-theft-auto-v-edicao-online-premium-e-pacote-de-dinheiro-31230', 'https://www.microsoft.com/pt-br/p/grand-theft-auto-v-premium-online-edition-great-white-shark-card-bundle/c54h8fdktjpg?ranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-tNFguuEb6Ce55eW9oJ0F5A&#38;epi=wuBjaD0yAek-tNFguuEb6Ce55eW9oJ0F5A&#38;irgwc=1&#38;OCID=AID2000142_aff_7803_1243925&#38;tduid=%28ir__echp36uwi0kftmzkkk0sohzjx32xshd6a26qedhs00%29%287803%29%281243925%29%28wuBjaD0yAek-tNFguuEb6Ce55eW9oJ0F5A%29%28%29&#38;irclickid=_echp36uwi0kftmzkkk0sohzjx32xshd6a26qedhs00&#38;activetab=pivot:overviewtab', 'Grand Theft Auto V: Edição Online Premium e Pacote de Dinheiro ', '<p>O bundle Grand Theft Auto V: Edição Online Premium e Pacote de Dinheiro Tubarão-Branco inclui o Modo História completo do Grand Theft Auto V, acesso gratuito ao mundo em constante evolução do Grand Theft Auto Online e todo o conteúdo e melhorias de jogo já lançados. Você também recebe o Kit Inicial de Esquema Criminal, a maneira mais rápida de começar seu império do crime no Grand Theft Auto Online, e um Pacote de Dinheiro Tubarão-Branco no valor de GTA$1.250.000 para gastar no GTA Online.</p>', 159, 71, '2020-11-03', NULL, 'd7cedf8d692742e8efc5874daecbf558.jpg', 7, 'approved'),
(16, 1, 1, 1, 'pubg-56337', 'https://www.microsoft.com/pt-br/p/playerunknowns-battlegrounds/C0MN5DN8KR3F?activetab=pivot%3Aoverviewtab&#38;epi=t1hmgYz4x1Q-dWwO4qyPdO.w1K69C0x3DA&#38;irgwc=1&#38;OCID=AID2000142_aff_7803_1243925&#38;tduid=%28ir__jcrpcs0h0okfqn99kk0sohzjxu2xskpssvcut3hf00%29%287803%29%281243925%29%28t1hmgYz4x1Q-dWwO4qyPdO.w1K69C0x3DA%29%28%29&#38;irclickid=_jcrpcs0h0okfqn99kk0sohzjxu2xskpssvcut3hf00&#38;ranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-3It4aaaXn0WxjEwHqa5pmw&#38;epi=wuBjaD0yAek-3It4aaaXn0WxjEwHqa5pmw&#38;irgwc=1&#38;OCID=AID2000142_aff_7803_1243925&#38;tduid=%28ir__echp36uwi0kftmzkkk0sohzjx32xsk9zde6qedhr00%29%287803%29%281243925%29%28wuBjaD0yAek-3It4aaaXn0WxjEwHqa5pmw%29%28%29&#38;irclickid=_echp36uwi0kftmzkkk0sohzjx32xsk9zde6qedhr00', 'PUBG', '<p>Seja mais <strong>esperto</strong> que seus adversários para se tornar o último jogador vivo. O jogo precisa de uma assinatura Xbox Live Gold. Compras no jogo são opcionais. As compras no jogo incluem acesso ao servidor de testes público do <strong>PUBG</strong>. Para obter mais informações, acesse <a href=\"https://pubg.com\">www.pubg.com</a>.</p>', 99, 24, '2020-10-31', NULL, '0aa183dc9a5cef917fab145d79e9021e.jpg', 30, 'refused');

-- --------------------------------------------------------

--
-- Table structure for table `offer_likes`
--

CREATE TABLE `offer_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_offer` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offer_likes`
--

INSERT INTO `offer_likes` (`id`, `id_offer`, `id_user`) VALUES
(7, 15, 7),
(9, 12, 7),
(24, 12, 1),
(28, 15, 2),
(31, 14, 7),
(32, 12, 2),
(33, 10, 7),
(34, 9, 7),
(35, 10, 1),
(43, 16, 1),
(45, 14, 1),
(47, 15, 1),
(48, 11, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE `reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_author` bigint(20) UNSIGNED NOT NULL,
  `id_offer` bigint(20) UNSIGNED NOT NULL,
  `id_reason` bigint(20) UNSIGNED NOT NULL,
  `reported_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','refused','closed') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `avatar` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `suspended` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_role`, `name`, `email`, `password`, `avatar`, `suspended`) VALUES
(1, 3, 'Admin ', 'admin@admin.com', '$2y$10$tAtrzzePfRgN3zm9DrH8wezwezxyvsldjmQPtHzGCXTU/QESZYhei', '891dce36acdfd70f67160088546384c9.jpg', 0),
(2, 1, 'Douglas Pinheiro Goulart', 'douglaspigoulart@gmail.com', '$2y$10$kXHGL/jHDIBO/HZQ4n2nHepsc16IzbeOFSCcEEcmjlh80I39xMC4a', '429e74643702850c6e108321085d2cc6.jpg', 0),
(4, 1, 'Moderador', 'mod@mod.com', '$2y$10$K1Cg8L54uCZZ53URBAyoBO/M8n5277NiR6cGspnQoTua7lcz2tqh.', 'default.jpg', 0),
(7, 4, 'Owner', 'owner@owner.com', '$2y$10$BPrlZYRbHY0qWtEMNH9ks.MRR7cFrRW6lKlt9aE6/u266dNzjCUwC', 'f1fdcf289061c1de61e65a49317c87d6.jpg', 0),
(10, 1, 'Gerson De Souza Inacio', 'gersonsinacio@gmail.com', '$2y$10$apqrf3eK3UB/jtBMRdjrfudoKMWmnGnf9EJeAAYZmibBwsT9m2kmK', 'default.jpg', 0);

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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `offer_likes`
--
ALTER TABLE `offer_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `comment_likes`
--
ALTER TABLE `comment_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `offer_likes`
--
ALTER TABLE `offer_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `reasons`
--
ALTER TABLE `reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
