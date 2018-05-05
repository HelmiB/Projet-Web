-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 05 mai 2018 à 18:48
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `hopital`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`user`, `pass`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

DROP TABLE IF EXISTS `chambre`;
CREATE TABLE IF NOT EXISTS `chambre` (
  `numero` int(11) NOT NULL,
  `occupee` int(11) NOT NULL,
  `departement` int(50) NOT NULL,
  `etage` varchar(10) NOT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`numero`, `occupee`, `departement`, `etage`) VALUES
(125, 1, 10, '1'),
(201, 1, 20, '2'),
(200, 1, 20, '2'),
(101, 1, 10, '1'),
(100, 1, 10, '1');

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `id_departement` int(11) NOT NULL,
  `nom_departement` varchar(20) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`id_departement`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id_departement`, `nom_departement`, `description`) VALUES
(408, 'radiologie', 'la radiologie designe l\'ensemble des modalites diagnostiques et therapeutiques utilisant les rayons X, ou plus generalement utilisant des rayonnements.'),
(121, 'cardiologie', 'La cardiologie est la specialite medicale qui etudie le coeur et ses maladies'),
(156, 'chirurgie', 'La chirurgie est la partie de la therapeutique qui implique des '),
(113, 'dermatologie', 'La dermatologie est la branche de la medecine qui s\'occupe de la peau, des muqueuses et des phaneres (ongles, cheveux, poils)'),
(112, 'immunologie', ' s\'occupe de l\'etude du systeme immunitaire.'),
(315, 'maternites', 'Les maternites sont des lieux de sante assurant le suivi de la grossesse, l\'accouchement et les suites de couche de la femme enceinte, ou parturiente.'),
(118, 'Neurologie', 'La neurologie est la discipline medicale clinique qui etudie l\'ensemble des maladies du systeme nerveux et en particulier du cerveau'),
(308, 'MÃ©decine gÃ©nÃ©rale', 'est une specialite medicale prenant en charge le suivi durable, le bien-etre et les soins mÃ©dicaux gÃ©nÃ©raux primaires sans se limiter a des groupes de maladies relevant d\'un organe, d\'un age, ou d\'un sexe particulier.');

-- --------------------------------------------------------

--
-- Structure de la table `lit`
--

DROP TABLE IF EXISTS `lit`;
CREATE TABLE IF NOT EXISTS `lit` (
  `id` int(11) NOT NULL,
  `chambre` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(10) NOT NULL,
  `prenom` varchar(10) NOT NULL,
  `telephone` int(11) NOT NULL,
  `departement` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `date_naissance` date NOT NULL,
  `date_hospitalisation` date NOT NULL,
  `date_sortie` date NOT NULL,
  `chambre` varchar(10) NOT NULL,
  `departement` varchar(10) NOT NULL,
  `antecedents_medicaux` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `nom`, `prenom`, `sexe`, `date_naissance`, `date_hospitalisation`, `date_sortie`, `chambre`, `departement`, `antecedents_medicaux`) VALUES
(10, 'daoues', 'hamza', 'Homme', '2018-04-05', '2018-04-04', '2018-04-12', '125', '10', 'jjj'),
(9, 'jenny', 'yosr', 'Femme', '2018-04-11', '2018-04-14', '0000-00-00', '100', '10', 'hhhred'),
(8, 'salem', 'sinda', 'Femme', '2018-04-05', '2018-04-07', '2018-04-15', '101', '10', 'jjhnh'),
(7, 'tayeb', 'hayfa', 'Femme', '2018-04-05', '2018-04-20', '0000-00-00', '200', '20', 'egngg nnn');

-- --------------------------------------------------------

--
-- Structure de la table `receptionniste`
--

DROP TABLE IF EXISTS `receptionniste`;
CREATE TABLE IF NOT EXISTS `receptionniste` (
  `id_receptionniste` int(55) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `sexe` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `date_debuttravail` date NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`id_receptionniste`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `receptionniste`
--

INSERT INTO `receptionniste` (`id_receptionniste`, `nom`, `prenom`, `sexe`, `date_naissance`, `date_debuttravail`, `user`, `pass`) VALUES
(1, 'walim', 'krichen', 'homme', '1998-01-27', '2017-01-01', 'walim', 'it\'sme');

-- --------------------------------------------------------

--
-- Structure de la table `visite`
--

DROP TABLE IF EXISTS `visite`;
CREATE TABLE IF NOT EXISTS `visite` (
  `id_patient` int(11) NOT NULL,
  `date` date NOT NULL,
  `taille` int(11) NOT NULL,
  `poid` int(11) NOT NULL,
  `diagnostique` int(11) NOT NULL,
  `departement` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
