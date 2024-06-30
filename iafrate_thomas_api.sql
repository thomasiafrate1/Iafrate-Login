-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 30 juin 2024 à 21:45
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `iafrate_thomas_api`
--

-- --------------------------------------------------------

--
-- Structure de la table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE latin1_bin NOT NULL,
  `attempt_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `username`, `attempt_time`) VALUES
(1, 'Thomas', '2024-06-30 17:26:48'),
(2, 'Thomas', '2024-06-30 17:26:50'),
(3, 'Thomas', '2024-06-30 17:26:51'),
(4, 'Thomas', '2024-06-30 17:26:53'),
(5, 'Thomas', '2024-06-30 17:26:55'),
(6, 'coucou', '2024-06-30 17:38:17'),
(7, 'coucou', '2024-06-30 17:38:20'),
(8, 'coucou', '2024-06-30 17:38:22'),
(9, 'coucou', '2024-06-30 17:38:24'),
(10, 'coucou', '2024-06-30 17:38:26');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE latin1_bin NOT NULL,
  `password` varchar(255) COLLATE latin1_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'nouvel_utilisateur', '$2y$10$tEO49PS07g5F15imTh5gcuVGEQ4vu8anw.ywaiLYAlhUJM17KGJ7q', '2024-06-28 13:17:10'),
(2, 't', '$2y$10$ZB2lQbiIP2fk5xc9Tzrh..VJ3.MGNueYxcWoQK9DVSmdeJBFlW1My', '2024-06-28 13:19:01'),
(3, 'test', '$2y$10$EBTTG68SucbCJJz8BxkIEeNm33ZfWSs.ojYuEGDzT7vz4atuUIshy', '2024-06-28 13:20:25'),
(4, 'retest', '$2y$10$.066ilQWOeg.5HjERjsxIeqrLy8wtGuZiXJodMNMLbmU1udlXHwWK', '2024-06-29 18:00:58'),
(5, 'coucou', '$2y$10$q4sAuqOt24PlU7WfZvvWsewT91jzOWySznpCp3RuUpFu79xKF98p.', '2024-06-29 18:06:39'),
(6, 'Thomas', '$2y$10$apZI0TcWUsgJw2F9sw/WL.SIlnDrMSTYMJQh6rF5U9VDWP6qaBXu2', '2024-06-30 17:03:02');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(20) COLLATE latin1_bin NOT NULL,
  `nom` varchar(20) COLLATE latin1_bin NOT NULL,
  `age` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `prenom`, `nom`, `age`) VALUES
(36, 'Thomas', 'Iafrate', 19),
(35, 'hyg', 'bg', 12),
(34, 'hyg', 'bg', 12),
(33, 'hyg', 'bg', 12),
(32, 'hyg', 'bg', 12),
(29, 'hyg', 'bg', 12),
(24, 'hyg', 'bg', 12),
(25, 'hyg', 'bg', 12),
(26, 'Bite', '', NULL),
(30, 'Jean', 'Dupont', 30),
(28, 'Iafrate', 'Thomas', 80);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
