-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 23 mars 2021 à 13:09
-- Version du serveur :  10.3.27-MariaDB-0+deb10u1
-- Version de PHP : 7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `EmployMeDB`
--
CREATE DATABASE IF NOT EXISTS `EmployMeDB` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `EmployMeDB`;

-- --------------------------------------------------------

--
-- Structure de la table `Candidature`
--

CREATE TABLE `Candidature` (
  `id` int(10) UNSIGNED NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `dateNaissance` date NOT NULL,
  `cv` mediumblob NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `idUtilisateur` int(10) UNSIGNED NOT NULL,
  `idJob` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Candidature_Competence`
--

CREATE TABLE `Candidature_Competence` (
  `id` int(10) UNSIGNED NOT NULL,
  `niveau` tinyint(1) NOT NULL,
  `idCandidature` int(10) UNSIGNED NOT NULL,
  `idJob_Competence` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Job`
--

CREATE TABLE `Job` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomEntreprise` varchar(200) NOT NULL,
  `nomPoste` varchar(200) NOT NULL,
  `nombrePlace` int(11) NOT NULL,
  `adresse` mediumtext NOT NULL,
  `siteWeb` mediumtext DEFAULT NULL,
  `mail` tinytext NOT NULL,
  `aPropos` text NOT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `salaireMin` mediumint(9) NOT NULL,
  `salaireMax` mediumint(9) NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT current_timestamp(),
  `idUtilisateur` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Job_Competence`
--

CREATE TABLE `Job_Competence` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomCompetence` varchar(80) NOT NULL,
  `descriptionCompetence` text NOT NULL,
  `idJob` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `id` int(10) UNSIGNED NOT NULL,
  `prenom` varchar(150) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `email` varchar(120) NOT NULL,
  `motDePasse` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Candidature`
--
ALTER TABLE `Candidature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idJob` (`idJob`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `Candidature_Competence`
--
ALTER TABLE `Candidature_Competence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUtilisateur` (`idCandidature`,`idJob_Competence`),
  ADD KEY `idJob_Competence` (`idJob_Competence`);

--
-- Index pour la table `Job`
--
ALTER TABLE `Job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `Job_Competence`
--
ALTER TABLE `Job_Competence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idJob` (`idJob`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Candidature`
--
ALTER TABLE `Candidature`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Candidature_Competence`
--
ALTER TABLE `Candidature_Competence`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Job`
--
ALTER TABLE `Job`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Job_Competence`
--
ALTER TABLE `Job_Competence`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Candidature`
--
ALTER TABLE `Candidature`
  ADD CONSTRAINT `idJobCandidature` FOREIGN KEY (`idJob`) REFERENCES `Job` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idUtilisateurCandidature` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Candidature_Competence`
--
ALTER TABLE `Candidature_Competence`
  ADD CONSTRAINT `idCandidature` FOREIGN KEY (`idCandidature`) REFERENCES `Candidature` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idJob_Competence` FOREIGN KEY (`idJob_Competence`) REFERENCES `Job_Competence` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Job`
--
ALTER TABLE `Job`
  ADD CONSTRAINT `idUtilisateurJob` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Job_Competence`
--
ALTER TABLE `Job_Competence`
  ADD CONSTRAINT `idJobCompetence` FOREIGN KEY (`idJob`) REFERENCES `Job` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
