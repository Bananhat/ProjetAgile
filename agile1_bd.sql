-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 13 juin 2019 à 14:38
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `agile1_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `aptitude`
--

DROP TABLE IF EXISTS `aptitude`;
CREATE TABLE IF NOT EXISTS `aptitude` (
  `id_apt` int(11) NOT NULL AUTO_INCREMENT,
  `aptitude` text CHARACTER SET utf8 NOT NULL,
  `validated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_apt`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `aptitude`
--

INSERT INTO `aptitude` (`id_apt`, `aptitude`, `validated`) VALUES
(1, 'testaptitude', 1);

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

DROP TABLE IF EXISTS `competences`;
CREATE TABLE IF NOT EXISTS `competences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `niveau` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`id`, `name`, `niveau`) VALUES
(1, 'testcomp', 3),
(2, 'comp', 3),
(3, 'voilavoila', 2);

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

DROP TABLE IF EXISTS `skill`;
CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skill` text CHARACTER SET utf8,
  `competence_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `skill`
--

INSERT INTO `skill` (`id`, `skill`, `competence_id`) VALUES
(1, 'a skill', 3),
(2, 'some other skill', 3),
(3, 'A1', 1),
(4, 'A2', 2),
(5, 'A11', 1);

-- --------------------------------------------------------

--
-- Structure de la table `studendtrials`
--

DROP TABLE IF EXISTS `studendtrials`;
CREATE TABLE IF NOT EXISTS `studendtrials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `skill_id` int(11) DEFAULT NULL,
  `validated` tinyint(1) DEFAULT NULL,
  `date` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `studendtrials`
--

INSERT INTO `studendtrials` (`id`, `student_id`, `skill_id`, `validated`, `date`) VALUES
(1, 3, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id_student` int(11) NOT NULL,
  `name` char(32) NOT NULL,
  `firstName` char(32) NOT NULL,
  `level` int(11) NOT NULL,
  `comment` varchar(256) NOT NULL,
  PRIMARY KEY (`id_student`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`id_student`, `name`, `firstName`, `level`, `comment`) VALUES
(0, 'sam', 'sam', 3, ''),
(1, 'test', 'test', 1, ''),
(2, 'test2', 'test2', 1, ''),
(4, 'test4', 'test4', 1, ''),
(5, 'test5', 'test5', 1, ''),
(6, 'test6', 'test6', 2, ''),
(7, 'test7', 'test7', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstName`, `name`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin', 'adminagile1', 'admin'),
(2, 'sam', 'sam', 'sam', 'sam', 'responsable');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
