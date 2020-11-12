-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2020 at 09:20 PM
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_ability` bigint(20) UNSIGNED NOT NULL,
  `id_role` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ability_role`
--

INSERT INTO `ability_role` (`id`, `id_ability`, `id_role`) VALUES
(1, 1, 4),
(2, 1, 3),
(3, 2, 2),
(4, 3, 2),
(5, 5, 2);

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
(5, 'drinks', 'Bebidas'),
(6, 'tech', 'Informática');

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
(96, NULL, 9, 1, '<p>Um dos melhores jogos da Ubisoft.</p>', '2020-11-02 11:52:27'),
(97, 96, 9, 1, '<p>@Admin O primeiro também é muito bom</p>', '2020-11-02 11:53:51'),
(98, 73, 15, 1, '<p>@Owner</p>', '2020-11-10 16:37:29');

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
(9, 32, 7),
(11, 76, 2),
(14, 73, 7),
(15, 2, 7),
(24, 3, 1),
(25, 4, 1),
(26, 70, 1),
(28, 1, 2),
(30, 76, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `id_author`, `id_category`, `id_subcategory`, `slug`, `link`, `name`, `additional_info`, `old_price`, `new_price`, `published_at`, `end_offer`, `image`, `views`, `status`) VALUES
(1, 7, 1, 3, 'homefront-the-revolution-expansion-pass-56285', 'https://www.microsoft.com/pt-br/p/homefront-the-revolution-expansion-pass/bx9pv7cclhgr?%3FranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;epi=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;irgwc=1&#38;OCID=AID681541_aff_7803_1243925&#38;tduid=%28ir__xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00%29%287803%29%281243925%29%28wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ%29%28%29&#38;irclickid=_xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00&#38;rtc=1&#38;activetab=pivot:overviewtab', 'Homefront®: The Revolution Expansion Pass', NULL, 45, 19, '2020-10-25', '2021-10-30', 'a834079e69463a602a5017cad39c17e5jpg', 37, 'approved'),
(4, 7, 1, 5, 'metro-redux-bundle', 'https://www.microsoft.com/pt-br/p/homefront-the-revolution-expansion-pass/bx9pv7cclhgr?%3FranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;epi=wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ&#38;irgwc=1&#38;OCID=AID681541_aff_7803_1243925&#38;tduid=%28ir__xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00%29%287803%29%281243925%29%28wuBjaD0yAek-Wd3FVhWSjXHaqlRJpm6QSQ%29%28%29&#38;irclickid=_xrv2afeffgkfr3roxhyq2k3ksu2xjxyce36qe9ie00&#38;rtc=1&#38;activetab=pivot:overviewtab', 'Metro Redux Bundle', NULL, 78, 19, '2020-10-25', '2021-10-30', '5b334cf0d0c62a0471b4f74651532caa.jpg', 38, 'approved'),
(8, 7, 1, 6, 'call-of-duty-black-ops-cold-war-beta-56346', 'microsoft.com/pt-br/p/call-of-duty-black-ops-cold-war-open-beta/9nw9mbbvpnpl?ranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-LH1pF9r70Szm1PrZl.2W2A&#38;epi=wuBjaD0yAek-LH1pF9r70Szm1PrZl.2W2A&#38;irgwc=1&#38;OCID=AID2000142_aff_7803_1243925&#38;tduid=%28ir__echp36uwi0kftmzkkk0sohzjx32xsw9s1f6qedht00%29%287803%29%281243925%29%28wuBjaD0yAek-LH1pF9r70Szm1PrZl.2W2A%29%28%29&#38;irclickid=_echp36uwi0kftmzkkk0sohzjx32xsw9s1f6qedht00&#38;activetab=pivot%3Aoverviewtab', ' Call of Duty®: Black Ops Cold War - Beta ', NULL, 20, 0, '2020-10-25', '2021-10-30', '155e1047ec2a718dff40d2c4b9bb17c6jpg', 66, 'approved'),
(9, 7, 1, 4, 'game-watch-dogs-2-hits-ps4-56313', 'https://www.kabum.com.br/cgi-local/site/produtos/descricao_ofertas.cgi?codigo=112780&#38;awc=17729_1603112669_9bb2448c441de6fdded1a7f4393a1cb8&#38;utm_source=AWIN&#38;utm_medium=AFILIADOS&#38;utm_campaign=hallowin_out20&#38;utm_content=home&#38;utm_term=https%3A%2F%2Fwww.promobit.com.br', 'Game Watch Dogs 2 Hits PS4', NULL, 79, 0, '2020-10-25', '2021-10-30', 'db244a5986b2d05f626a532943d37574.jpg', 21, 'approved'),
(10, 7, 1, 6, 'ori-and-the-blind-forest-definitive-edition-56255', 'https://www.microsoft.com/pt-br/p/ori-and-the-blind-forest-definitive-edition/bw85kqb8q31m?activetab=pivot:overviewtab', 'Ori and the Blind Forest: Definitive Edition', NULL, 39, 9, '2020-10-25', NULL, 'a38e27e3f0d25750a042e04b14103ed1jpg', 270, 'approved'),
(11, 7, 1, 5, 'child-of-light-56265', 'https://www.microsoft.com/pt-br/p/child-of-light/bq9q620nc614?activetab=pivot:overviewtab', ' Child of Light', NULL, 35, 24, '2020-10-25', NULL, '14e8b348599f978cc09d11fd16290bdbjpg', 57, 'approved'),
(12, 7, 1, 6, 'red-dead-redemption-2-56305', 'https://www.microsoft.com/pt-br/p/red-dead-redemption-2/bpswgqbw7r3g', 'Red Dead Redemption 2', NULL, 249, 199, '2020-10-25', '2021-10-30', '4805a0b5bc10794363ba327d034141e1.jpg', 114, 'approved'),
(14, 7, 1, 6, 'assassin-39-s-creed-odyssey-56319', 'https://www.microsoft.com/PT-BR/p/assassins-creed-odyssey/BW9TWC8L4JCS?id=Pubsalegame_Week43&#38;ranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-fUfGUiMjo1zUkqwWYcsoeg&#38;epi=wuBjaD0yAek-fUfGUiMjo1zUkqwWYcsoeg&#38;irgwc=1&#38;OCID=AID2000142_aff_7803_1243925&#38;tduid=%28ir__echp36uwi0kftmzkkk0sohzjx32xs39ehn6qedhz00%29%287803%29%281243925%29%28wuBjaD0yAek-fUfGUiMjo1zUkqwWYcsoeg%29%28%29&#38;irclickid=_echp36uwi0kftmzkkk0sohzjx32xs39ehn6qedhz00&#38;activetab=pivot%3Aoverviewtab', 'Assassin&#39;s Creed® Odyssey', '<p>Forma de pagamento:&nbsp;<strong>em 1x no cartão de crédito</strong>.</p>', 199, 49, '2020-10-25', '2021-10-30', '749fbc2093637b40410e9022cd37c59c.jpg', 112, 'approved'),
(15, 7, 1, 6, 'the-witcher-3-wild-hunt-complete-edition-56272', 'https://www.microsoft.com/pt-br/p/the-witcher-3-wild-hunt-complete-edition/c261457lcnmj?ocid=AID2000142_aff_7803_1243925#activetab=pivot:overviewtab', 'The Witcher 3: Wild Hunt – Complete Edition', '<p>O jogo mais premiado de 2015!&nbsp;</p><p>Torne-se um mercenário caçador de monstros e embarque em uma épica jornada para encontrar a criança da profecia, uma arma viva capaz de incríveis destruições.&nbsp;</p><p><strong>INCLUI TODAS AS EXPANSÕES E CONTEÚDO ADICIONAL.</strong></p>', 190, 152, '2020-10-25', NULL, 'f9c477ea2d2dba8fdd736831b33cd778.jpg', 900, 'approved'),
(18, 2, 1, 6, 'grand-theft-auto-v-edicao-online-premium-e-pacote-de-dinheiro-91094', 'https://www.microsoft.com/pt-br/p/grand-theft-auto-v-premium-online-edition-great-white-shark-card-bundle/c54h8fdktjpg?ranMID=42431&#38;ranEAID=wuBjaD0yAek&#38;ranSiteID=wuBjaD0yAek-tNFguuEb6Ce55eW9oJ0F5A&#38;epi=wuBjaD0yAek-tNFguuEb6Ce55eW9oJ0F5A&#38;irgwc=1&#38;OCID=AID2000142_aff_7803_1243925&#38;tduid=%28ir__echp36uwi0kftmzkkk0sohzjx32xshd6a26qedhs00%29%287803%29%281243925%29%28wuBjaD0yAek-tNFguuEb6Ce55eW9oJ0F5A%29%28%29&#38;irclickid=_echp36uwi0kftmzkkk0sohzjx32xshd6a26qedhs00&#38;activetab=pivot:overviewtab', 'Grand Theft Auto V: Edição Online Premium e Pacote de Dinheiro ', '<p>O bundle Grand Theft Auto V: Edição Online Premium e Pacote de Dinheiro Tubarão-Branco inclui o Modo História completo do Grand Theft Auto V, acesso gratuito ao mundo em constante evolução do Grand Theft Auto Online e todo o conteúdo e melhorias de jogo já lançados. Você também recebe o Kit Inicial de Esquema Criminal, a maneira mais rápida de começar seu império do crime no Grand Theft Auto Online, e um Pacote de Dinheiro Tubarão-Branco no valor de GTA$1.250.000 para gastar no <strong>GTA Online.</strong></p>', 159, 71, '2020-11-03', NULL, 'd7cedf8d692742e8efc5874daecbf558.jpg', 58, 'pending'),
(19, 1, 6, 11, 'cadeira-gamer-husky-snow-black-hsn-58818', 'https://www.kabum.com.br/produto/92748/cadeira-gamer-husky-snow-black-hsn-bk?awc=17729_1604943810_ed9db0fd5d94b00847d0a7e35911ec48&#38;utm_source=AWIN&#38;utm_medium=AFILIADOS&#38;utm_campaign=novembroninja_nov20&#38;utm_content=home&#38;utm_term=https%3A%2F%2Fwww.promobit.com.br', 'Cadeira Gamer Husky Snow Black HSN', '<p>A Cadeira Gamer Husky Snow proporciona alto conforto e qualidade para as melhores horas do seu dia! Tudo isso aliado a um ótimo custo benefício. Os games do momento ficam ainda mais empolgantes ao serem jogados em uma Cadeira Gamer Husky Snow, pois além do design moderno e robusto, a cadeira proporciona ótima performance nas partidas devido a sensação de conforto que é convertida em foco e concentração, tudo que um gamer de verdade precisa para ser o melhor! A Gamer Husky Snow conta com uma estrutura consistente e de fácil montagem, com rodas 100% Nylon, função butterfly que regula a sua altura de forma prática, couro sintético PU, um balanço com até 13º de ajuste e ainda um assento de 510x500mm com encosto de 520x770mm, é fácil perceber que ela foi projetada para entregar muito conforto para os gamers de forma acessível. A Husky Snow conta com espuma de alta qualidade e suas características mais elogiadas são regulagem de altura por pistão à gás e design singular e ao mesmo tempo muito moderno. Dê um upgrade no seu espaço gamer com uma Cadeira Husky Snow e sinta a diferença! Qualidade com custo benefício para você enfrentar qualquer desafio gamer! Aproveite essa oportunidade e adquira a Cadeira Gamer Husky Snow.</p>', 941, 764, '2020-11-09', NULL, '00ba4a7d28f7f0011811807cb9a8ae69.jpg', 8, 'approved');

--
-- Triggers `offers`
--
DELIMITER $$
CREATE TRIGGER `close_report` AFTER UPDATE ON `offers` FOR EACH ROW BEGIN
        IF (NEW.status = 'closed') THEN
            UPDATE reports SET status = 'closed' WHERE id_offer = NEW.id AND status = 'pending';
        END IF;
    END
$$
DELIMITER ;

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
(28, 15, 2),
(31, 14, 7),
(32, 12, 2),
(33, 10, 7),
(34, 9, 7),
(35, 10, 1),
(45, 14, 1),
(47, 15, 1),
(48, 11, 2),
(50, 15, 4),
(51, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE `reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`id`, `slug`, `name`) VALUES
(1, 'unavailable', 'A oferta não está mais disponível'),
(2, 'expensive', 'O produto está muito caro'),
(3, 'wrong-category-or-subcategory', 'A categoria ou subcategoria está errada'),
(4, 'duplicated', 'O oferta já foi postada'),
(5, 'wrong-value', 'O valor do produto é diferente do anunciado'),
(6, 'offensive', 'Esta oferta contém conteúdo ofensivo');

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
  `status` enum('pending','accepted','refused','closed') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `id_author`, `id_offer`, `id_reason`, `reported_at`, `status`) VALUES
(1, 1, 15, 4, '2020-11-07 22:09:47', 'refused'),
(2, 7, 15, 4, '2020-11-07 22:11:44', 'refused'),
(3, 2, 15, 5, '2020-11-07 22:12:05', 'pending'),
(4, 1, 1, 6, '2020-11-08 14:23:56', 'pending'),
(5, 1, 11, 1, '2020-11-08 14:24:07', 'pending'),
(6, 1, 12, 2, '2020-11-08 14:46:00', 'refused'),
(7, 1, 14, 2, '2020-11-08 14:46:40', 'refused'),
(8, 1, 14, 2, '2020-11-08 14:49:26', 'refused'),
(9, 1, 12, 2, '2020-11-08 14:49:45', 'refused'),
(10, 1, 12, 2, '2020-11-08 15:28:33', 'refused'),
(11, 1, 12, 2, '2020-11-08 15:28:57', 'pending'),
(12, 4, 14, 2, '2020-11-08 15:29:12', 'refused');

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
  `id_category` bigint(20) UNSIGNED NOT NULL,
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
(10, 3, 'desktop-software', 'Softwares para Desktop'),
(11, 6, 'gaming-chairs', 'Cadeiras'),
(12, 6, 'coolers', 'Coolers'),
(13, 6, 'computer-cases', 'Gabinetes'),
(14, 6, 'hardware', 'Hardware'),
(15, 6, 'input-devices', 'Periféricos'),
(16, 6, 'data-storage-devices', 'HDs e SSDs'),
(17, 6, 'printers', 'Impressoras'),
(18, 6, 'screens', 'Monitores'),
(19, 6, 'laptops', 'Notebooks'),
(20, 6, 'pcs', 'Computadores'),
(21, 6, 'gpu', 'Placas de vídeo'),
(22, 6, 'motherships', 'Placas-mãe'),
(23, 6, 'cpu', 'Processadores'),
(24, 6, 'connection-devices', 'Roteadores e modems');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_role`, `name`, `email`, `password`, `avatar`, `suspended`) VALUES
(1, 3, 'Admin ', 'admin@admin.com', '$2y$10$tAtrzzePfRgN3zm9DrH8wezwezxyvsldjmQPtHzGCXTU/QESZYhei', '891dce36acdfd70f67160088546384c9.jpg', 0),
(2, 1, 'Douglas Pinheiro Goulart', 'douglaspigoulart@gmail.com', '$2y$10$kXHGL/jHDIBO/HZQ4n2nHepsc16IzbeOFSCcEEcmjlh80I39xMC4a', '429e74643702850c6e108321085d2cc6.jpg', 0),
(4, 2, 'Moderador', 'mod@mod.com', '$2y$10$K1Cg8L54uCZZ53URBAyoBO/M8n5277NiR6cGspnQoTua7lcz2tqh.', 'default.jpg', 0),
(7, 4, 'Owner', 'owner@owner.com', '$2y$10$BPrlZYRbHY0qWtEMNH9ks.MRR7cFrRW6lKlt9aE6/u266dNzjCUwC', 'f1fdcf289061c1de61e65a49317c87d6.jpg', 0),
(10, 1, 'Gerson De Souza Inacio', 'gersonsinacio@gmail.com', '$2y$10$apqrf3eK3UB/jtBMRdjrfudoKMWmnGnf9EJeAAYZmibBwsT9m2kmK', 'default.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abilities`
--
ALTER TABLE `abilities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label` (`label`);

--
-- Indexes for table `ability_role`
--
ALTER TABLE `ability_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_ability` (`id_ability`),
  ADD KEY `fk_id_role` (`id_role`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_comment_parent` (`id_parent`) USING BTREE,
  ADD KEY `fk_id_comment_offer` (`id_offer`) USING BTREE,
  ADD KEY `fk_id_comment_author` (`id_author`) USING BTREE;

--
-- Indexes for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_comment_like_comment` (`id_comment`) USING BTREE;

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `fk_id_offer_author` (`id_author`) USING BTREE,
  ADD KEY `fk_id_offer_category` (`id_category`) USING BTREE,
  ADD KEY `fk_id_offer_subcategory` (`id_subcategory`) USING BTREE;

--
-- Indexes for table `offer_likes`
--
ALTER TABLE `offer_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_offer_like_offer` (`id_offer`) USING BTREE,
  ADD KEY `fk_id_offer_like_user` (`id_user`) USING BTREE;

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_report_author` (`id_author`),
  ADD KEY `fk_id_report_offer` (`id_offer`),
  ADD KEY `fk_id_report_reason` (`id_reason`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label` (`label`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `fk_id_subcategory_category` (`id_category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_id_user_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abilities`
--
ALTER TABLE `abilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ability_role`
--
ALTER TABLE `ability_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `comment_likes`
--
ALTER TABLE `comment_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `offer_likes`
--
ALTER TABLE `offer_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `reasons`
--
ALTER TABLE `reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ability_role`
--
ALTER TABLE `ability_role`
  ADD CONSTRAINT `fk_id_ability` FOREIGN KEY (`id_ability`) REFERENCES `abilities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_role` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_id_author` FOREIGN KEY (`id_author`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_offer` FOREIGN KEY (`id_offer`) REFERENCES `offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_parent` FOREIGN KEY (`id_parent`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD CONSTRAINT `fk_id_comment` FOREIGN KEY (`id_comment`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `fk_id_category` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_publisher` FOREIGN KEY (`id_author`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_subcategory` FOREIGN KEY (`id_subcategory`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offer_likes`
--
ALTER TABLE `offer_likes`
  ADD CONSTRAINT `fk_id_liked_offer` FOREIGN KEY (`id_offer`) REFERENCES `offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_liked` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_id_report_author` FOREIGN KEY (`id_author`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_report_offer` FOREIGN KEY (`id_offer`) REFERENCES `offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_report_reason` FOREIGN KEY (`id_reason`) REFERENCES `reasons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `fk_id_subcategory_category` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_id_user_role` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
