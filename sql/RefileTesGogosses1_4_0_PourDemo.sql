-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 24 mars 2021 à 11:32
-- Version du serveur :  10.3.25-MariaDB-0+deb10u1
-- Version de PHP :  7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `RefileTesGogosses`
--
CREATE DATABASE IF NOT EXISTS `RefileTesGogosses` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `RefileTesGogosses`;

-- --------------------------------------------------------

--
-- Structure de la table `t_annonce`
--

CREATE TABLE `t_annonce` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `prix` float NOT NULL,
  `quantite` int(11) NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT current_timestamp(),
  `idUser` int(10) UNSIGNED DEFAULT NULL,
  `idCategorie` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_annonce`
--

INSERT INTO `t_annonce` (`id`, `nom`, `description`, `prix`, `quantite`, `dateCreation`, `idUser`, `idCategorie`) VALUES
(3, 'Fer à repasser', 'Le fer à repasser à semelle en acier chromé!\r\n- Fer à repasser à vapeur\r\n- 2200 Watt max.\r\n- Régulation de vapeur en continu\r\n- Semelle du fer en acier chromé\r\n- Mode anti-calcaire\r\n- Système anti-goutte\r\n- Longueur câble: 1.9m\r\n- Capacité réservoir: 360ml', 19, 1, '2021-03-24 10:27:26', 1, NULL),
(4, 'Pull', 'Pull rayé gris et violet\r\nH&M\r\nCôton', 10, 3, '2021-03-24 10:28:22', 1, NULL),
(5, 'Fauteuil rouge', 'Fauteuil ikea rouge doux', 20, 4, '2021-03-24 10:29:20', 1, NULL),
(6, 'Livres', 'Livres', 9, 4, '2021-03-24 10:30:13', 1, NULL),
(7, 'Prothèse', 'Prothèse bionique', 20000, 1, '2021-03-24 10:30:50', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_categorie`
--

CREATE TABLE `t_categorie` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_image`
--

CREATE TABLE `t_image` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomImage` varchar(80) NOT NULL,
  `typeImage` varchar(50) NOT NULL,
  `idAnnonce` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_image`
--

INSERT INTO `t_image` (`id`, `nomImage`, `typeImage`, `idAnnonce`) VALUES
(3, '605b140eca74a', 'jpeg', 3),
(4, '605b1446da367', 'jpeg', 4),
(5, '605b1480092b2', 'jpeg', 5),
(6, '605b14b578279', 'jpeg', 6),
(7, '605b14dace483', 'jpeg', 7);

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomUtilisateur` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_user`
--

INSERT INTO `t_user` (`id`, `nomUtilisateur`, `email`, `mdp`) VALUES
(1, 'user', 'user@test.ch', '$2y$10$U42RV43VRRw/N78nXPoGeOttik4zaS/jXM/ZBi0pekM9Dmfev8ufa');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_annonce`
--
ALTER TABLE `t_annonce`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idCategorie` (`idCategorie`);
ALTER TABLE `t_annonce` ADD FULLTEXT KEY `RechercheAnnonces` (`nom`);

--
-- Index pour la table `t_categorie`
--
ALTER TABLE `t_categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_image`
--
ALTER TABLE `t_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAnnonce` (`idAnnonce`);

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_annonce`
--
ALTER TABLE `t_annonce`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `t_categorie`
--
ALTER TABLE `t_categorie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_image`
--
ALTER TABLE `t_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_annonce`
--
ALTER TABLE `t_annonce`
  ADD CONSTRAINT `idCategorieAnnonce` FOREIGN KEY (`idCategorie`) REFERENCES `t_categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idUserAnnonce` FOREIGN KEY (`idUser`) REFERENCES `t_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_image`
--
ALTER TABLE `t_image`
  ADD CONSTRAINT `idAnnonceImage` FOREIGN KEY (`idAnnonce`) REFERENCES `t_annonce` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
