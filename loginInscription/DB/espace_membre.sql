-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 27 mai 2020 à 21:39
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `espace_membre`
--

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` text NOT NULL,
  `numero` int(10) NOT NULL,
  `adresse` text NOT NULL,
  `dateNaissance` date DEFAULT NULL,
  PRIMARY KEY (`pseudo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`pseudo`, `mail`, `motdepasse`, `numero`, `adresse`, `dateNaissance`) VALUES
('jp', 'JP@test.com', '0f41a0b3b760b54df703e860e40fef1c388ed2c5', 0, '', '0000-00-00'),
('el', 'elamrani@gmail.com', '4f1ea4f09db2aaafb0a92c0b9e57751121ed6647', 485355, 'Re', '1999-01-04'),
('gggh', 'test4@gmail.com', '7bec8b89f872b23251c7928cd7b0374cfd41dc89', 485383680, 'Rue de la', '1953-01-05'),
('elm', 'elm@gmail.com', '4a07c168f5f0ba03440f1ec2fd9892a7b005f2da', 485236825, '', '2020-05-13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
