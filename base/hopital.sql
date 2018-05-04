-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 04 mai 2018 à 18:56
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  7.2.1

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

CREATE TABLE `admin` (
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
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

CREATE TABLE `chambre` (
  `numero` int(11) NOT NULL,
  `occupee` int(11) NOT NULL,
  `departement` int(50) NOT NULL,
  `etage` varchar(10) NOT NULL
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

CREATE TABLE `departement` (
  `id_departement` int(11) NOT NULL,
  `nom_departement` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id_departement`, `nom_departement`, `description`) VALUES
(1, 'Cardiologie', ''),
(4, 'Pediatrie', ''),
(3, 'Neurologie', '');

-- --------------------------------------------------------

--
-- Structure de la table `lit`
--

CREATE TABLE `lit` (
  `id` int(11) NOT NULL,
  `chambre` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

CREATE TABLE `medecin` (
  `id` int(11) NOT NULL,
  `nom` varchar(10) NOT NULL,
  `prenom` varchar(10) NOT NULL,
  `telephone` int(11) NOT NULL,
  `departement` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`id`, `nom`, `prenom`, `telephone`, `departement`) VALUES
(2, 'hayfa', 'tayeb', 23337901, 'Cardiologi');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `date_naissance` date NOT NULL,
  `numero` int(11) NOT NULL,
  `date_hospitalisation` date NOT NULL,
  `date_sortie` date NOT NULL,
  `chambre` varchar(10) NOT NULL,
  `departement` varchar(10) NOT NULL,
  `antecedents_medicaux` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `nom`, `prenom`, `sexe`, `date_naissance`, `numero`, `date_hospitalisation`, `date_sortie`, `chambre`, `departement`, `antecedents_medicaux`) VALUES
(10, 'daoues', 'hamza', 'Homme', '2018-04-05', 0, '2018-04-04', '2018-04-12', '125', '10', 'jjj'),
(9, 'Jenny', 'Yosr', 'Femme', '2018-04-11', 0, '2018-04-14', '2018-05-07', '100', '10', 'hhhred'),
(8, 'salem', 'sinda', 'Femme', '2018-04-05', 0, '2018-04-07', '2018-04-15', '101', '10', 'jjhnh'),
(7, 'Tayeb', 'Hayfa', 'Femme', '2018-04-10', 0, '2018-04-20', '0000-00-00', '200', '20', 'egngg nnn jfhc s');

-- --------------------------------------------------------

--
-- Structure de la table `receptionniste`
--

CREATE TABLE `receptionniste` (
  `id_receptionniste` int(55) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `sexe` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `date_debuttravail` date NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `receptionniste`
--

INSERT INTO `receptionniste` (`id_receptionniste`, `nom`, `prenom`, `sexe`, `date_naissance`, `date_debuttravail`, `user`, `pass`) VALUES
(1, 'walim', 'krichen', 'homme', '1998-01-27', '2017-01-01', 'walim', 'it\'sme'),
(3, 'Hayfa', 'Tayeb', 'femme', '1997-10-23', '2018-05-09', 'hayfa', '0000');

-- --------------------------------------------------------

--
-- Structure de la table `visite`
--

CREATE TABLE `visite` (
  `numero` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `taille` int(11) NOT NULL,
  `poids` int(11) NOT NULL,
  `diagnostique` varchar(250) NOT NULL,
  `docteur` varchar(50) NOT NULL,
  `departement` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `visite`
--

INSERT INTO `visite` (`numero`, `patient`, `type`, `date`, `taille`, `poids`, `diagnostique`, `docteur`, `departement`) VALUES
(1, 7, 'hosp', '2018-05-15', 152, 25, 'mlkjh', 'dr tgvcg', '20'),
(2, 7, 'hosp', '2018-05-09', 152, 65, 'iuh', 'ghfcdc', '20'),
(3, 7, 'hospitalÃ©', '2018-05-18', 452, 415, 'ooikhg', 'hbgg', '20');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user`);

--
-- Index pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD PRIMARY KEY (`numero`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id_departement`);

--
-- Index pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `receptionniste`
--
ALTER TABLE `receptionniste`
  ADD PRIMARY KEY (`id_receptionniste`);

--
-- Index pour la table `visite`
--
ALTER TABLE `visite`
  ADD PRIMARY KEY (`numero`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id_departement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `medecin`
--
ALTER TABLE `medecin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `receptionniste`
--
ALTER TABLE `receptionniste`
  MODIFY `id_receptionniste` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `visite`
--
ALTER TABLE `visite`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
