-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 05, 2025 at 08:12 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_projet_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `role` tinyint DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Franck Maniche', 'franckmaniche6@gmail.com', '', 1, '2025-02-15 12:04:03'),
(13, 'Gatine', 'mama@gmail.com', '', 0, '2025-02-15 12:21:03');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `age` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `profession` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `visa_client` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `age`, `profession`, `email`, `telephone`, `password`, `visa_client`, `created_at`) VALUES
(2, 'Francis', 'Nganou', '28', 'professeur', 'francisnganou5@gmail.com', '653954179', '123', 1, '2025-02-17 21:08:53'),
(3, 'Tatiana', 'Tsombeng', '22', 'Comptable', 'tati@gmail.com', '694750375', '123', 2, '2025-02-17 21:10:51'),
(4, 'Ndoumbe Djemba', 'Lydienne Princesse Ange Silvia', '16', 'Eleve', 'lydienneprincesse@gmail.com', '695748294', '123', 1, '2025-02-21 20:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `etat_clients`
--

DROP TABLE IF EXISTS `etat_clients`;
CREATE TABLE IF NOT EXISTS `etat_clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_client` int NOT NULL,
  `id_procedure` int NOT NULL,
  `etat_procedure` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `etat_clients`
--

INSERT INTO `etat_clients` (`id`, `id_client`, `id_procedure`, `etat_procedure`, `created_at`, `updated_at`) VALUES
(1, 2, 8, 2, '2025-02-26 10:38:49', '2025-02-27 13:35:07'),
(2, 2, 6, 2, '2025-02-26 10:38:49', '2025-02-27 13:35:07'),
(3, 2, 10, 2, '2025-02-26 10:38:49', '2025-02-27 13:37:55'),
(4, 2, 11, 2, '2025-02-26 10:38:49', '2025-02-27 14:43:06'),
(5, 2, 12, 2, '2025-02-26 10:38:49', '2025-02-28 06:35:17'),
(6, 2, 13, 2, '2025-02-26 10:38:49', '2025-02-28 15:39:58'),
(7, 2, 14, 2, '2025-02-26 10:38:49', '2025-03-01 13:14:56'),
(8, 2, 17, 2, '2025-02-26 10:38:49', '2025-03-01 13:15:10'),
(9, 2, 16, 2, '2025-02-26 10:38:49', '2025-03-01 13:15:53'),
(10, 2, 15, 2, '2025-02-26 10:38:49', '2025-03-01 13:16:06'),
(11, 2, 9, 2, '2025-02-26 10:38:49', '2025-03-01 13:43:30'),
(12, 4, 8, 2, '2025-02-26 13:17:12', '2025-02-27 13:35:07'),
(13, 4, 6, 2, '2025-02-26 13:17:12', '2025-03-03 18:56:44'),
(14, 4, 10, 1, '2025-02-26 13:17:12', '2025-03-03 18:56:44'),
(15, 4, 11, 0, '2025-02-26 13:17:12', '2025-02-27 13:35:07'),
(16, 4, 12, 0, '2025-02-26 13:17:12', '2025-02-27 13:35:07'),
(17, 4, 13, 0, '2025-02-26 13:17:12', '2025-02-27 13:35:07'),
(18, 4, 14, 0, '2025-02-26 13:17:12', '2025-02-27 13:35:07'),
(19, 4, 17, 0, '2025-02-26 13:17:12', '2025-02-27 13:35:07'),
(20, 4, 16, 0, '2025-02-26 13:17:12', '2025-02-27 13:35:07'),
(21, 4, 15, 0, '2025-02-26 13:17:12', '2025-02-27 13:35:07'),
(22, 4, 9, 2, '2025-02-26 13:17:12', '2025-02-27 13:35:07'),
(23, 2, 18, 2, '2025-02-28 15:38:20', '2025-03-01 13:20:03'),
(24, 3, 7, 0, '2025-03-01 13:44:18', '2025-03-01 13:50:43'),
(25, 3, 19, 0, '2025-03-01 13:50:43', '2025-03-01 13:57:04'),
(26, 4, 18, 0, '2025-03-03 18:56:44', '2025-03-03 18:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `message` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `procedure`
--

DROP TABLE IF EXISTS `procedure`;
CREATE TABLE IF NOT EXISTS `procedure` (
  `id_procedure` int NOT NULL AUTO_INCREMENT,
  `libelle_procedure` mediumtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_procedure` mediumtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` int NOT NULL,
  `id_visa` int NOT NULL,
  `etat_procedure` tinyint DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_procedure`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `procedure`
--

INSERT INTO `procedure` (`id_procedure`, `libelle_procedure`, `description_procedure`, `image`, `id_visa`, `etat_procedure`, `created_at`, `order`) VALUES
(8, 'Rechercher le pays', 'Rechercher le pays qui correspond a vos exigences du client', 1740339141, 1, 0, '2025-02-16 22:36:45', 2),
(7, 'Recherche du pays', 'Rechercher le pays qui correspond a vos exigences du client', 1740682550, 2, 0, '2025-02-16 21:47:36', 1),
(18, 'Obtention des assurances nécessaires', 'Obtenir les assurances nécessaires pour le voyage et le séjour à l\\\'étranger, notamment l\\\'assurance maladie et l\\\'assurance voyage.', 1740754344, 1, 0, '2025-02-28 14:52:24', 12),
(6, 'Recherche de l\\\\\\\'etablissement', 'Recherche de l\\\\\\\'etablissement d\\\\\\\'enseignment qui proposent des porgrammes d\\\\\\\'etude dans le pays le destination', 1740339174, 1, 0, '2025-02-16 21:39:01', 3),
(9, 'Choix du type de visa', 'Determination du type de visa qui correspond le mieux a vos objectifs', 1740339154, 1, 0, '2025-02-17 07:16:57', 1),
(10, 'Inscription a l\\\\\\\'etablissement', 'S\\\\\\\'incrire a l\\\\\\\'etablissement souhaite apres une etude de dossier realiser de facon scrupuleuse', 1740339210, 1, 0, '2025-02-17 07:18:05', 4),
(11, 'Obtention de la lettre d\\\\\\\'acceptation', 'Ici vous recevrer une lettre d\\\\\\\'acceptation de l\\\\\\\'etablissement d\\\\\\\'enseignement', 1740339223, 1, 0, '2025-02-17 07:19:51', 5),
(12, 'Preparation des documents pour le visa', 'Ici les documents necessaire pour la preparation du visa etude', 1740339242, 1, 0, '2025-02-17 07:20:32', 6),
(13, 'Soumission de la demande du visa', 'Ici l\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\'on soumet la demande du visa a l\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\'ambassade parfois au consulat du pays de destination', 1740754514, 1, 0, '2025-02-17 07:21:20', 7),
(14, 'Entretien avec un agent de l\\\\\\\'immigration', 'Vous serrez inviter a repondre aux questions de l\\\\\\\'agent d\\\\\\\'immigration pour prouver la motivation et la capacite a poursuivre les etudes dans le pays de destination', 1740754525, 1, 0, '2025-02-17 07:22:17', 8),
(15, 'Preparation pour le voyage', 'Reservation du billet d\\\\\\\'avion, l\\\\\\\'hebergement et les activites  ', 1740754602, 1, 0, '2025-02-17 07:24:06', 11),
(16, 'Obtention du visa', 'Reception et remise du visa appose sur le passeport', 1739777084, 1, 0, '2025-02-17 07:24:44', 10),
(17, 'Attente de la decision', 'Celle ou le coeur bat a la chamade, l\\\\\\\'on attend la decision finale de l\\\\\\\'ambassade sur la demande du visa', 1740754548, 1, 0, '2025-02-17 07:25:23', 9),
(19, 'Choix du type de visa', 'Détermination du type de visa qui correspond le mieux a vos objectifs', 1740836991, 2, 0, '2025-03-01 13:49:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `role` tinyint DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Franck Maniche', 'franckmaniche6@gmail.com', '123', 1, '2025-02-12 12:14:02'),
(9, 'Ndoumbe Djemba', 'lydienneprincesse@gmail.com', '123', 0, '2025-02-21 20:39:12'),
(5, 'Gatine', 'mama@gmail.com', '123', 1, '2025-02-15 12:19:37'),
(7, 'Francis', 'francisnganou5@gmail.com', '123', 0, '2025-02-17 21:08:53'),
(8, 'Tatiana', 'tati@gmail.com', '123', 0, '2025-02-17 21:10:51');

-- --------------------------------------------------------

--
-- Table structure for table `visa`
--

DROP TABLE IF EXISTS `visa`;
CREATE TABLE IF NOT EXISTS `visa` (
  `id_visa` int NOT NULL AUTO_INCREMENT,
  `libelle_visa` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_visa` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_visa`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `visa`
--

INSERT INTO `visa` (`id_visa`, `libelle_visa`, `description_visa`, `image`, `created_at`) VALUES
(1, 'Visa etude', 'Permet A un jeune d\\\'etudier dans un pays etrange, generalement pour une periode Limite', 1739526756, '2025-02-13 21:45:10'),
(2, 'Visa travailleur qualifie', 'Permet de travailler dans un pays etranger, generalement pour une periode determiner', 1739632392, '2025-02-13 21:54:39'),
(4, 'Visa court-sejour', 'Lorem ipsum sit dolor Lorem ipsum sit dolor Lorem ipsum sit dolor Lorem ipsum sit dolor Lorem ipsum sit dolor Lorem ipsum sit dolor Lorem ipsum sit dolor Lorem ipsum sit dolor', 1739632410, '2025-02-13 22:39:37');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
