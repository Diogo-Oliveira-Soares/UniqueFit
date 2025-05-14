-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 14 mai 2025 à 09:04
-- Version du serveur : 8.0.41-cll-lve
-- Version de PHP : 8.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `2025tpiuni_UniqueFit`
--
CREATE DATABASE IF NOT EXISTS `2025tpiuni_UniqueFit` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `2025tpiuni_UniqueFit`;

-- --------------------------------------------------------

--
-- Structure de la table `email_verifications`
--

CREATE TABLE `email_verifications` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `token` varchar(64) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `order-details`
--

CREATE TABLE `order-details` (
  `products_idproducts` int NOT NULL,
  `orders_idorders` int NOT NULL,
  `quantity` int NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `idorders` int NOT NULL,
  `number_of_order` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `users_idusers` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `idproducts` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `serial_number` varchar(45) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(100) NOT NULL,
  `category` varchar(30) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`idproducts`, `name`, `serial_number`, `price`, `description`, `category`, `image`, `is_active`) VALUES
(1, 'T-shirt sport homme', 'SN001', 19.99, 'T-shirt respirant pour entraînement', 'T-shirts', 'tshirt_homme.jpg', 1),
(2, 'T-shirt sport femme', 'SN002', 21.99, 'T-shirt stretch pour fitness', 'T-shirts', 'tshirt_femme.jpg', 1),
(3, 'Pantalon jogging homme', 'SN003', 34.99, 'Jogging confortable coton', 'Pantalons', 'jogging_homme.jpg', 1),
(4, 'Legging sport femme', 'SN004', 29.99, 'Legging taille haute extensible', 'Leggings', 'legging_femme.jpg', 1),
(5, 'Short entraînement', 'SN005', 15.5, 'Short léger pour cardio', 'Shorts', 'short.jpg', 1),
(6, 'Brassière de sport', 'SN006', 25, 'Brassière maintien fort', 'Sous-vêtements', 'brassiere.jpg', 1),
(7, 'Débardeur musculation', 'SN007', 18, 'Débardeur dos nageur', 'T-shirts', 'debardeur.jpg', 1),
(8, 'Veste zippée training', 'SN008', 49.99, 'Veste légère à capuche', 'Vestes', 'veste.jpg', 1),
(9, 'Sweat à capuche homme', 'SN009', 39.95, 'Sweat molletonné', 'Sweats', 'sweat_homme.jpg', 1),
(10, 'Sweat à capuche femme', 'SN010', 39.95, 'Sweat femme coupe ajustée', 'Sweats', 'sweat_femme.jpg', 1),
(11, 'Chaussettes sport', 'SN011', 5.99, 'Chaussettes respirantes lot de 2', 'Sous-vêtements', 'chaussettes.jpg', 1),
(12, 'Gants de musculation', 'SN012', 14.5, 'Gants antidérapants', 'Accessoires', 'gants.jpg', 1),
(13, 'Casquette training', 'SN013', 12, 'Casquette anti-UV', 'Accessoires', 'casquette.jpg', 1),
(14, 'Collant thermique', 'SN014', 32, 'Collant isolant pour hiver', 'Pantalons', 'collant.jpg', 1),
(15, 'T-shirt compression', 'SN015', 22.5, 'T-shirt moulant de récupération', 'T-shirts', 'compression.jpg', 1),
(16, 'Veste sport unisexe', 'SN016', 65.4, 'superbe veste de sport unisexe', 'Vestes', 'veste2.jpg', 1),
(17, 'Veste hiver homme', 'SN017', 80, 'superbe veste hiver pour homme', 'Vestes', 'veste3.jpg', 1),
(18, 'Veste hiver femme', 'SN018', 80, 'superbe veste hiver pour femme', 'Vestes', 'veste4.jpg', 1),
(19, 'écharpe unisexe', 'SN019', 15, 'écharpe légère et confortable', 'Accessoires', 'echarpe.jpg', 1),
(20, 'Sac de sport compact', 'SN020', 27.99, 'Sac léger avec plusieurs compartiments', 'Accessoires', 'sac.jpg', 1),
(21, 'Legging seamless femme', 'SN021', 31.5, 'Legging sans couture pour un confort optimal', 'Leggings', 'legging_seamless.jpg', 1),
(22, 'Legging sport homme', 'SN022', 33, 'Legging de compression pour homme', 'Leggings', 'legging_homme.jpg', 1),
(23, 'Legging imprimé femme', 'SN023', 29.9, 'Legging coloré avec motifs géométriques', 'Leggings', 'legging_imprime.jpg', 1),
(24, 'Pantalon cargo sport', 'SN024', 42, 'Pantalon multi-poches pour activités outdoor', 'Pantalons', 'pantalon_cargo.jpg', 1),
(25, 'Pantalon training léger', 'SN025', 36.5, 'Pantalon respirant pour entraînement intensif', 'Pantalons', 'pantalon_training.jpg', 1),
(26, 'Short running homme', 'SN026', 17.99, 'Short léger avec doublure intégrée', 'Shorts', 'short_running_homme.jpg', 1),
(27, 'Short training femme', 'SN027', 16.5, 'Short taille haute pour le fitness', 'Shorts', 'short_training_femme.jpg', 1),
(28, 'Short cycliste', 'SN028', 19, 'Short moulant idéal pour le vélo', 'Shorts', 'short_cycliste.jpg', 1),
(29, 'Boxer sport homme', 'SN029', 11.99, 'Boxer respirant en tissu technique', 'Sous-vêtements', 'boxer_homme.jpg', 1),
(30, 'Culotte sans couture', 'SN030', 9.5, 'Culotte invisible idéale pour le sport', 'Sous-vêtements', 'culotte_femme.jpg', 1),
(31, 'Sweat oversize unisexe', 'SN031', 44.9, 'Sweat ample et confortable pour tous', 'Sweats', 'sweat_oversize.jpg', 1),
(32, 'Sweat zippé respirant', 'SN032', 47, 'Sweat à fermeture zippée pour entraînement', 'Sweats', '89a76bdd158bbe7f96835a57e2fb41f7.jpg', 1),
(33, 't-shirt jeune talent', 'SN033', 50, 'T-shirt premium jeune talent', 't-shirts', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `product_variants`
--

CREATE TABLE `product_variants` (
  `idvariant` int NOT NULL,
  `idproducts` int DEFAULT NULL,
  `size` varchar(5) NOT NULL,
  `color` varchar(10) NOT NULL,
  `stock` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `product_variants`
--

INSERT INTO `product_variants` (`idvariant`, `idproducts`, `size`, `color`, `stock`) VALUES
(1, 1, 'S', 'Noir', 50),
(2, 1, 'M', 'Noir', 45),
(3, 1, 'L', 'Noir', 40),
(4, 1, 'XL', 'Noir', 35),
(5, 1, 'S', 'Blanc', 60),
(6, 1, 'M', 'Blanc', 55),
(7, 1, 'L', 'Blanc', 50),
(8, 1, 'XL', 'Blanc', 45),
(9, 1, 'S', 'Bleu', 55),
(10, 1, 'M', 'Bleu', 50),
(11, 1, 'L', 'Bleu', 45),
(12, 1, 'XL', 'Bleu', 40),
(13, 2, 'S', 'Rose', 40),
(14, 2, 'M', 'Rose', 30),
(15, 2, 'L', 'Rose', 20),
(16, 2, 'S', 'Bleu', 30),
(17, 2, 'M', 'Bleu', 25),
(18, 2, 'L', 'Bleu', 20),
(19, 2, 'S', 'Vert', 25),
(20, 2, 'M', 'Vert', 20),
(21, 2, 'L', 'Vert', 15),
(22, 3, 'L', 'Gris', 30),
(23, 3, 'XL', 'Gris', 25),
(24, 3, 'L', 'Noir', 20),
(25, 3, 'XL', 'Noir', 15),
(26, 3, 'L', 'Bleu', 18),
(27, 3, 'XL', 'Bleu', 12),
(28, 4, 'M', 'Noir', 45),
(29, 4, 'L', 'Noir', 35),
(30, 4, 'S', 'Noir', 40),
(31, 4, 'M', 'Gris', 30),
(32, 4, 'L', 'Gris', 25),
(33, 4, 'S', 'Gris', 28),
(34, 4, 'M', 'Rose', 25),
(35, 4, 'L', 'Rose', 22),
(36, 4, 'S', 'Rose', 30),
(37, 5, 'M', 'Bleu', 50),
(38, 5, 'L', 'Bleu', 60),
(39, 5, 'M', 'Rouge', 45),
(40, 5, 'L', 'Rouge', 55),
(41, 5, 'M', 'Noir', 40),
(42, 5, 'L', 'Noir', 50),
(43, 6, 'S', 'Violet', 35),
(44, 6, 'M', 'Violet', 25),
(45, 6, 'L', 'Violet', 20),
(46, 6, 'S', 'Rose', 28),
(47, 6, 'M', 'Rose', 22),
(48, 6, 'L', 'Rose', 18),
(49, 6, 'S', 'Noir', 30),
(50, 6, 'M', 'Noir', 25),
(51, 6, 'L', 'Noir', 20),
(52, 7, 'S', 'Blanc', 28),
(53, 7, 'M', 'Blanc', 20),
(54, 7, 'S', 'Gris', 25),
(55, 7, 'M', 'Gris', 18),
(56, 7, 'S', 'Noir', 22),
(57, 7, 'M', 'Noir', 20),
(58, 8, 'L', 'Noir', 20),
(59, 8, 'M', 'Noir', 15),
(60, 8, 'L', 'Bleu', 18),
(61, 8, 'M', 'Bleu', 12),
(62, 8, 'L', 'Gris', 10),
(63, 8, 'M', 'Gris', 8),
(64, 9, 'M', 'Rouge', 15),
(65, 9, 'L', 'Rouge', 10),
(66, 9, 'XL', 'Rouge', 5),
(67, 9, 'M', 'Noir', 20),
(68, 9, 'L', 'Noir', 18),
(69, 9, 'XL', 'Noir', 12),
(70, 9, 'M', 'Bleu', 10),
(71, 9, 'L', 'Bleu', 8),
(72, 9, 'XL', 'Bleu', 6),
(73, 10, 'S', 'Bordeaux', 10),
(74, 10, 'M', 'Bordeaux', 12),
(75, 10, 'S', 'Noir', 8),
(76, 10, 'M', 'Noir', 10),
(77, 10, 'S', 'Gris', 7),
(78, 10, 'M', 'Gris', 6),
(79, 11, 'M', 'Blanc', 100),
(80, 11, 'L', 'Blanc', 95),
(81, 11, 'M', 'Noir', 90),
(82, 11, 'L', 'Noir', 85),
(83, 11, 'M', 'Gris', 80),
(84, 11, 'L', 'Gris', 75),
(85, 12, 'M', 'Noir', 38),
(86, 12, 'L', 'Noir', 25),
(87, 12, 'M', 'Gris', 30),
(88, 12, 'L', 'Gris', 20),
(89, 12, 'M', 'Bleu', 15),
(90, 12, 'L', 'Bleu', 10),
(91, 13, 'M', 'Gris', 45),
(92, 13, 'L', 'Gris', 40),
(93, 13, 'M', 'Noir', 50),
(94, 13, 'L', 'Noir', 45),
(95, 13, 'M', 'Bleu', 42),
(96, 13, 'L', 'Bleu', 38),
(97, 14, 'S', 'Bleu', 18),
(98, 14, 'M', 'Bleu', 12),
(99, 14, 'S', 'Gris', 20),
(100, 14, 'M', 'Gris', 15),
(101, 14, 'S', 'Noir', 22),
(102, 14, 'M', 'Noir', 18),
(103, 15, 'M', 'Vert', 33),
(104, 15, 'L', 'Vert', 25),
(105, 15, 'M', 'Bleu', 28),
(106, 15, 'L', 'Bleu', 22),
(107, 15, 'M', 'Noir', 40),
(108, 15, 'L', 'Noir', 35),
(109, 16, 'S', 'Noir', 20),
(110, 16, 'M', 'Noir', 18),
(111, 16, 'L', 'Noir', 16),
(112, 16, 'XL', 'Noir', 14),
(113, 16, 'S', 'Vert', 15),
(114, 16, 'M', 'Vert', 13),
(115, 16, 'L', 'Vert', 11),
(116, 16, 'XL', 'Vert', 9),
(117, 16, 'S', 'Bleu', 14),
(118, 16, 'M', 'Bleu', 12),
(119, 16, 'L', 'Bleu', 10),
(120, 16, 'XL', 'Bleu', 8),
(121, 17, 'S', 'Noir', 25),
(122, 17, 'M', 'Noir', 23),
(123, 17, 'L', 'Noir', 20),
(124, 17, 'XL', 'Noir', 18),
(125, 17, 'S', 'Gris', 22),
(126, 17, 'M', 'Gris', 19),
(127, 17, 'L', 'Gris', 16),
(128, 17, 'XL', 'Gris', 14),
(129, 17, 'S', 'Bleu', 20),
(130, 17, 'M', 'Bleu', 17),
(131, 17, 'L', 'Bleu', 14),
(132, 17, 'XL', 'Bleu', 12),
(133, 18, 'S', 'Noir', 22),
(134, 18, 'M', 'Noir', 20),
(135, 18, 'L', 'Noir', 17),
(136, 18, 'XL', 'Noir', 15),
(137, 18, 'S', 'Rose', 18),
(138, 18, 'M', 'Rose', 16),
(139, 18, 'L', 'Rose', 14),
(140, 18, 'XL', 'Rose', 12),
(141, 18, 'S', 'Gris', 16),
(142, 18, 'M', 'Gris', 14),
(143, 18, 'L', 'Gris', 12),
(144, 18, 'XL', 'Gris', 10),
(145, 19, 'S', 'Noir', 20),
(146, 19, 'M', 'Noir', 18),
(147, 19, 'L', 'Noir', 16),
(148, 19, 'XL', 'Noir', 14),
(149, 19, 'S', 'Gris', 18),
(150, 19, 'M', 'Gris', 16),
(151, 19, 'L', 'Gris', 14),
(152, 19, 'XL', 'Gris', 12),
(153, 19, 'S', 'Bleu', 16),
(154, 19, 'M', 'Bleu', 14),
(155, 19, 'L', 'Bleu', 12),
(156, 19, 'XL', 'Bleu', 10),
(157, 20, 'S', 'Noir', 18),
(158, 20, 'M', 'Noir', 16),
(159, 20, 'L', 'Noir', 14),
(160, 20, 'XL', 'Noir', 12),
(161, 20, 'S', 'Rouge', 15),
(162, 20, 'M', 'Rouge', 13),
(163, 20, 'L', 'Rouge', 11),
(164, 20, 'XL', 'Rouge', 9),
(165, 20, 'S', 'Gris', 14),
(166, 20, 'M', 'Gris', 12),
(167, 20, 'L', 'Gris', 10),
(168, 20, 'XL', 'Gris', 8),
(169, 21, 'S', 'Noir', 24),
(170, 21, 'M', 'Noir', 22),
(171, 21, 'L', 'Noir', 20),
(172, 21, 'XL', 'Noir', 18),
(173, 21, 'S', 'Rose', 20),
(174, 21, 'M', 'Rose', 18),
(175, 21, 'L', 'Rose', 16),
(176, 21, 'XL', 'Rose', 14),
(177, 21, 'S', 'Violet', 18),
(178, 21, 'M', 'Violet', 16),
(179, 21, 'L', 'Violet', 14),
(180, 21, 'XL', 'Violet', 12),
(181, 22, 'S', 'Noir', 22),
(182, 22, 'M', 'Noir', 20),
(183, 22, 'L', 'Noir', 18),
(184, 22, 'XL', 'Noir', 16),
(185, 22, 'S', 'Gris', 20),
(186, 22, 'M', 'Gris', 18),
(187, 22, 'L', 'Gris', 16),
(188, 22, 'XL', 'Gris', 14),
(189, 22, 'S', 'Bleu', 18),
(190, 22, 'M', 'Bleu', 16),
(191, 22, 'L', 'Bleu', 14),
(192, 22, 'XL', 'Bleu', 12),
(193, 23, 'S', 'Rose', 18),
(194, 23, 'M', 'Rose', 16),
(195, 23, 'L', 'Rose', 14),
(196, 23, 'XL', 'Rose', 12),
(197, 23, 'S', 'Violet', 16),
(198, 23, 'M', 'Violet', 14),
(199, 23, 'L', 'Violet', 12),
(200, 23, 'XL', 'Violet', 10),
(201, 24, 'S', 'Kaki', 18),
(202, 24, 'M', 'Kaki', 16),
(203, 24, 'L', 'Kaki', 14),
(204, 24, 'XL', 'Kaki', 12),
(205, 24, 'S', 'Noir', 16),
(206, 24, 'M', 'Noir', 14),
(207, 24, 'L', 'Noir', 12),
(208, 24, 'XL', 'Noir', 10),
(209, 24, 'S', 'Gris', 14),
(210, 24, 'M', 'Gris', 12),
(211, 24, 'L', 'Gris', 10),
(212, 24, 'XL', 'Gris', 8),
(213, 25, 'S', 'Gris', 20),
(214, 25, 'M', 'Gris', 18),
(215, 25, 'L', 'Gris', 16),
(216, 25, 'XL', 'Gris', 14),
(217, 25, 'S', 'Bleu', 18),
(218, 25, 'M', 'Bleu', 16),
(219, 25, 'L', 'Bleu', 14),
(220, 25, 'XL', 'Bleu', 12),
(221, 25, 'S', 'Noir', 16),
(222, 25, 'M', 'Noir', 14),
(223, 25, 'L', 'Noir', 12),
(224, 25, 'XL', 'Noir', 10),
(225, 26, 'S', 'Noir', 20),
(226, 26, 'M', 'Noir', 18),
(227, 26, 'L', 'Noir', 16),
(228, 26, 'XL', 'Noir', 14),
(229, 26, 'S', 'Bleu', 18),
(230, 26, 'M', 'Bleu', 16),
(231, 26, 'L', 'Bleu', 14),
(232, 26, 'XL', 'Bleu', 12),
(233, 26, 'S', 'Gris', 16),
(234, 26, 'M', 'Gris', 14),
(235, 26, 'L', 'Gris', 12),
(236, 26, 'XL', 'Gris', 10),
(237, 27, 'S', 'Rose', 18),
(238, 27, 'M', 'Rose', 16),
(239, 27, 'L', 'Rose', 14),
(240, 27, 'XL', 'Rose', 12),
(241, 27, 'S', 'Noir', 16),
(242, 27, 'M', 'Noir', 14),
(243, 27, 'L', 'Noir', 12),
(244, 27, 'XL', 'Noir', 10),
(245, 27, 'S', 'Violet', 14),
(246, 27, 'M', 'Violet', 12),
(247, 27, 'L', 'Violet', 10),
(248, 27, 'XL', 'Violet', 8),
(249, 28, 'S', 'Noir', 16),
(250, 28, 'M', 'Noir', 14),
(251, 28, 'L', 'Noir', 12),
(252, 28, 'XL', 'Noir', 10),
(253, 28, 'S', 'Bleu', 14),
(254, 28, 'M', 'Bleu', 12),
(255, 28, 'L', 'Bleu', 10),
(256, 28, 'XL', 'Bleu', 8),
(257, 28, 'S', 'Gris', 12),
(258, 28, 'M', 'Gris', 10),
(259, 28, 'L', 'Gris', 8),
(260, 28, 'XL', 'Gris', 6),
(261, 29, 'S', 'Rose', 16),
(262, 29, 'M', 'Rose', 14),
(263, 29, 'L', 'Rose', 12),
(264, 29, 'XL', 'Rose', 10),
(265, 29, 'S', 'Noir', 14),
(266, 29, 'M', 'Noir', 12),
(267, 29, 'L', 'Noir', 10),
(268, 29, 'XL', 'Noir', 8),
(269, 29, 'S', 'Violet', 12),
(270, 29, 'M', 'Violet', 10),
(271, 29, 'L', 'Violet', 8),
(272, 29, 'XL', 'Violet', 6),
(273, 30, 'S', 'Bleu', 18),
(274, 30, 'M', 'Bleu', 16),
(275, 30, 'L', 'Bleu', 14),
(276, 30, 'XL', 'Bleu', 12),
(277, 30, 'S', 'Gris', 16),
(278, 30, 'M', 'Gris', 14),
(279, 30, 'L', 'Gris', 12),
(280, 30, 'XL', 'Gris', 10),
(281, 30, 'S', 'Noir', 14),
(282, 30, 'M', 'Noir', 12),
(283, 30, 'L', 'Noir', 10),
(284, 30, 'XL', 'Noir', 8),
(285, 31, 'S', 'Noir', 20),
(286, 31, 'M', 'Noir', 18),
(287, 31, 'L', 'Noir', 16),
(288, 31, 'XL', 'Noir', 14),
(289, 31, 'S', 'Rose', 18),
(290, 31, 'M', 'Rose', 16),
(291, 31, 'L', 'Rose', 14),
(292, 31, 'XL', 'Rose', 12),
(293, 31, 'S', 'Violet', 16),
(294, 31, 'M', 'Violet', 14),
(295, 31, 'L', 'Violet', 12),
(296, 31, 'XL', 'Violet', 10),
(297, 32, 'S', 'Rose', 18),
(298, 32, 'M', 'Rose', 16),
(299, 32, 'L', 'Rose', 14),
(300, 32, 'XL', 'Rose', 12),
(301, 32, 'S', 'Noir', 16),
(302, 32, 'M', 'Noir', 14),
(303, 32, 'L', 'Noir', 12),
(304, 32, 'XL', 'Noir', 10),
(305, 32, 'S', 'Bleu', 14),
(306, 32, 'M', 'Bleu', 12),
(307, 32, 'L', 'Bleu', 10),
(308, 32, 'XL', 'Bleu', 8),
(309, 33, 'M', 'Rouge', 20),
(310, 33, 'S', 'Rouge', 12),
(311, 33, 'L', 'Rouge', 33),
(312, 33, 'S', 'Noir', 12),
(313, 33, 'M', 'Noir', 34),
(314, 33, 'L', 'Noir', 12);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idusers` int NOT NULL,
  `nickname` varchar(45) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `adress` varchar(50) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idusers`, `nickname`, `firstname`, `lastname`, `adress`, `mail`, `password`, `profile_image`, `email_verified`) VALUES
(1, 'Administrateur', 'Admin', 'UniqueFit', 'Rue de Crissier1, 1020 Renens, Suisse', 'uniquefit.staff@gmail.com', '$2y$10$NaATivtjpULp9hxXmM8RMOhW/cNqj5XDeWWVSq1IfIIqFNnX9KNnS', '../CSS-Image/Image/Administrateur-user-image.jpg', 1),
(2, 'Dhajd', 'Hfha', 'Vsvsv', 'Fhajdnwhfhqkdbwh', 'oliveirasoaresdiogo@gmail.com', '$2y$10$X38BhI8aZTJnlc28RaD3juKJVQKb9KFwlTf/3LlIp1lph9VIeRS6e', NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_verifications_ibfk_1` (`user_id`);

--
-- Index pour la table `order-details`
--
ALTER TABLE `order-details`
  ADD PRIMARY KEY (`products_idproducts`,`orders_idorders`),
  ADD KEY `orders_idorders` (`orders_idorders`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`idorders`),
  ADD KEY `users_idusers` (`users_idusers`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`idproducts`),
  ADD UNIQUE KEY `serial_number` (`serial_number`);

--
-- Index pour la table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`idvariant`),
  ADD KEY `idproducts` (`idproducts`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `email_verifications`
--
ALTER TABLE `email_verifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `idproducts` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `idvariant` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD CONSTRAINT `email_verifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`idusers`) ON DELETE CASCADE;

--
-- Contraintes pour la table `order-details`
--
ALTER TABLE `order-details`
  ADD CONSTRAINT `order-details_ibfk_1` FOREIGN KEY (`products_idproducts`) REFERENCES `products` (`idproducts`),
  ADD CONSTRAINT `order-details_ibfk_2` FOREIGN KEY (`orders_idorders`) REFERENCES `orders` (`idorders`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`idusers`);

--
-- Contraintes pour la table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`idproducts`) REFERENCES `products` (`idproducts`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
