-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 14 juin 2019 à 07:34
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

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
-- Structure de la table `competences`
--

DROP TABLE IF EXISTS `competences`;
CREATE TABLE IF NOT EXISTS `competences` (
  `competence_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `niveau` int(11) DEFAULT NULL,
  PRIMARY KEY (`competence_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`competence_id`, `name`, `niveau`) VALUES
(5, 'S\"équiper et se déséquiper', 1),
(6, 'Se mettre à l\"eau et en sortir', 1),
(7, 'Evoluer dans l\"eau  s\"immerger', 1),
(8, 'Evoluer dans l\"eau  se propulser', 1),
(9, 'Evoluer dans l\"eau  se ventiler', 1),
(10, 'Évoluer dans l\"eau  s\"équilibrer', 1),
(11, 'Communiquer', 1),
(12, 'Appliquer les conduites de sécurité', 1),
(13, 'Respecter le milieu et l\"environnement', 1),
(14, 'Retourner en surface', 1);

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

DROP TABLE IF EXISTS `seance`;
CREATE TABLE IF NOT EXISTS `seance` (
  `id_seance` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) DEFAULT NULL,
  `id_skill1` int(11) DEFAULT NULL,
  `id_skill2` int(11) DEFAULT NULL,
  `id_skill3` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_seance`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `seance`
--

INSERT INTO `seance` (`id_seance`, `date`, `id_skill1`, `id_skill2`, `id_skill3`, `student_id`) VALUES
(6, '04/03/2019', 11, 13, 14, 6),
(7, '02/02/2019', 12, 33, 33, 6);

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `skill`
--

INSERT INTO `skill` (`id`, `skill`, `competence_id`) VALUES
(8, 'Gréage et dégréage ', 4),
(9, 'Capelage et décapelage', 4),
(10, ' Choix de son matériel personnel ', 4),
(11, 'Saut droit Bascule arrière ', 5),
(12, 'Départ plage Sortir de l’eau ', 5),
(13, 'Canard ', 6),
(14, 'Phoque ', 6),
(15, ' Palmage ventral en surface ', 7),
(16, 'Palmage dorsal ', 7),
(17, 'Palmage de sustentation ', 7),
(18, 'Palmage en immersion ', 7),
(19, 'Nage en capelé ', 7),
(20, 'Ventilation en immersion ', 8),
(21, 'Ventilation sur tuba et vidage du tuba ', 8),
(22, 'Vidage du masque Lâcher et reprise d’embout', 8),
(23, 'Gestion du gilet de stabilisation', 9),
(24, ' Poumon ballast', 9),
(25, 'Exécution des signes conventionnels', 10),
(26, 'Application des procédures mises e œuvre par le GP', 11),
(27, ' Intervention en relai ', 11),
(28, 'Aisance aquatique', 12),
(29, 'Maîtrise de la vitesse de remontée', 13),
(30, ' Tenue d’un palier ', 13),
(31, 'Tour d’horizon ', 13),
(32, 'Gonflage du gilet en surface ', 13),
(33, 'Remontée en expiration contrôlée ', 13);

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
  `commentaire` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `studendtrials`
--

INSERT INTO `studendtrials` (`id`, `student_id`, `skill_id`, `validated`, `date`, `commentaire`) VALUES
(1, 6, 11, 1, '04/03/2019', ''),
(5, 6, 13, 1, '02/02/2019', 'eaze'),
(6, 6, 14, 2, '02/02/2019', 'PO');

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id_student` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL,
  `firstName` char(32) NOT NULL,
  `level` int(11) NOT NULL,
  `comment` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id_student`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`id_student`, `name`, `firstName`, `level`, `comment`) VALUES
(6, 'Audabram', 'Luc', 1, NULL);

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
  `levelFormation` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstName`, `name`, `email`, `password`, `role`, `levelFormation`) VALUES
(1, 'admin', 'admin', 'admin', 'adminagile1', 'admin', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
