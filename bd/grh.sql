-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 16 mai 2020 à 13:59
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `grh`
--

-- --------------------------------------------------------

--
-- Structure de la table `conger`
--

DROP TABLE IF EXISTS `conger`;
CREATE TABLE IF NOT EXISTS `conger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `debut_conger` datetime DEFAULT NULL,
  `fin_conger` datetime DEFAULT NULL,
  `cause` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fichier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `repundu` tinyint(1) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_conger_id` int(11) DEFAULT NULL,
  `demandeur_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1420EEACF976DE9A` (`type_conger_id`),
  KEY `IDX_1420EEAC95A6EE59` (`demandeur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pays_id` int(11) DEFAULT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datenaissance` date DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codepostale` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`),
  KEY `IDX_957A6479A6E44244` (`pays_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `pays_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `name`, `lastname`, `datenaissance`, `photo`, `adresse`, `telephone`, `codepostale`, `created_at`) VALUES
(30, NULL, 'admin@gmail.com', 'admin@gmail.com', 'admin@gmail.com', 'admin@gmail.com', 1, 'zUIZsK/J0otcKwZ92k1fXP/wHav84x46XJBOPaND1HY', '$2y$13$7IUC0de9qpqAuRq8Al67Zugzi6nVtzIV/1V/d6N75sOWj02mWM80a', '2020-05-16 13:46:54', 'QZTmYSsp8o-Fypn9fTiuyl1mn_RB-v3u6HfJ8WEPHzM', NULL, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 'admin', 'admin', NULL, NULL, NULL, '22558877', NULL, '2020-05-16 13:46:21');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

DROP TABLE IF EXISTS `pays`;
CREATE TABLE IF NOT EXISTS `pays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id`, `titre`) VALUES
(5, 'Tunis');

-- --------------------------------------------------------

--
-- Structure de la table `type_conger`
--

DROP TABLE IF EXISTS `type_conger`;
CREATE TABLE IF NOT EXISTS `type_conger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_conger`
--

INSERT INTO `type_conger` (`id`, `titre`) VALUES
(5, 'LE CONGÉ SANS SOLDE\r\n'),
(6, 'LE CONGÉ ANNUEL\r\n'),
(7, 'LE CONGÉ D\'EXAMEN\r\n'),
(8, 'LE CONGÉ INDIVIDUEL  DE FORMATION\r\n'),
(9, 'LE CONGÉ MALADIE\r\n'),
(10, 'LE CONGÉ MATERNITÉ\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(2, 'boubou', 'boubou', 'marwenmdoukhi@gmail.com', 'marwenmdoukhi@gmail.com', 1, 'ORATawfWcolY.kSUrlr3WlM4MFSEqk5p0GoIBdKJIrs', '$2y$13$gqzTMORqLXh9Kjakm81uzOr3ME.xFJyFpMTY467tZ0WnuPaCkY/8e', '2020-05-10 04:14:23', NULL, NULL, 'a:0:{}');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `conger`
--
ALTER TABLE `conger`
  ADD CONSTRAINT `FK_1420EEAC95A6EE59` FOREIGN KEY (`demandeur_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_1420EEACF976DE9A` FOREIGN KEY (`type_conger_id`) REFERENCES `type_conger` (`id`);

--
-- Contraintes pour la table `fos_user`
--
ALTER TABLE `fos_user`
  ADD CONSTRAINT `FK_957A6479A6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
