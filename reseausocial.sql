-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 18 déc. 2022 à 19:16
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reseausocial`
--
CREATE DATABASE IF NOT EXISTS `reseausocial` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `reseausocial`;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PostID` int(11) DEFAULT NULL,
  `Contenu` varchar(120) NOT NULL,
  `Pseudo` varchar(20) NOT NULL,
  `DateEnvoi` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  FOREIGN KEY `PostID` (`PostID`),
  FOREIGN KEY `Pseudo` (`Pseudo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `friend_requests`
--

DROP TABLE IF EXISTS `friend_requests`;
CREATE TABLE IF NOT EXISTS `friend_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `envoyeur` varchar(255) NOT NULL,
  `receveur` varchar(255) NOT NULL,
  `friend_verif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

DROP TABLE IF EXISTS `poste`;
CREATE TABLE IF NOT EXISTS `poste` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PseudoUtilisateur` varchar(20) NOT NULL,
  `Contenu` varchar(400) NOT NULL,
  `DateEnvoi` datetime NOT NULL,
  `DateModification` timestamp NULL DEFAULT NULL,
  `ReactionOui` int(11) NOT NULL DEFAULT '0',
  `ReactionNon` int(11) NOT NULL DEFAULT '0',
  `ReactionRire` int(11) NOT NULL DEFAULT '0',
  `ReactionCoeur` int(11) NOT NULL DEFAULT '0',
  `ReactionPleur` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  FOREIGN KEY `PseudoUtilisateur` (`PseudoUtilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
