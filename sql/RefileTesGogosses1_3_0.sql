-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 15 mars 2021 à 16:00
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
-- Base de données : `RefileTesGogosses`
--

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
(17, 'Bananeaaaa', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(18, 'ooAaa', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(19, 'Test1', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(20, 'Test2', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(21, 'test3', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(22, 'Test4', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(23, 'Test4', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(24, 'Test4', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(25, 'Test5', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(26, 'Test6', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(27, 'Singe1', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(28, 'Singe2', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(29, 'Singe3', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(30, 'Singe4', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(31, 'Singe6', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(32, 'Singe6', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:10', 3, NULL),
(33, 'Uwa1', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:38', 3, NULL),
(34, 'Uwa2', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:46', 3, NULL),
(35, 'Uwa3', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:53', 3, NULL),
(36, 'Uwa4', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:52:59', 3, NULL),
(37, 'Uwa5', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:53:04', 3, NULL),
(38, 'Uwa6', '            Des Bananes!\r\n        ', 15, 50, '2021-03-15 14:53:11', 3, NULL);

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
(50, '604f4c7e04920', 'jpeg', 17),
(51, '604f50c38fe90', 'png', 18),
(52, '604f521d2f6be', 'png', 19),
(53, '604f5223c5865', 'jpeg', 20),
(54, '604f522d6fcbf', 'png', 21),
(55, '604f6d5c51c52', 'png', 22),
(56, '604f6d7234055', 'png', 23),
(57, '604f6d7ab5d32', 'png', 24),
(58, '604f6d80c7245', 'png', 25),
(59, '604f6d870b97b', 'png', 26),
(60, '604f7338bc87f', 'jpeg', 27),
(61, '604f733ec4963', 'png', 28),
(62, '604f7346b4bb5', 'png', 29),
(63, '604f734cbc94f', 'png', 30),
(64, '604f735a2127e', 'png', 31),
(65, '604f73714b066', 'png', 32),
(66, '604f74b6e9415', 'png', 33),
(67, '604f74beaa516', 'png', 34),
(68, '604f74c575eb8', 'jpeg', 35),
(69, '604f74cb2daba', 'png', 36),
(70, '604f74d095c7a', 'png', 37),
(71, '604f74d708504', 'png', 38);

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
(3, 'admin', 'admin.admin@gmail.com', '$2y$10$BgQk.t7eCO0vWTV8070FEOE3PcbmWRgs96G7dfeTsjArZtoPK6FPG'),
(4, 'singe', 'singe.singe@singe.com', '$2y$10$N4XaOkRpGnRAs.SC796Q5uQAs2WeKbk6q7Vo6q.i368ocwZoiTiR2'),
(5, 'z', 'z.z@gmail.com', '$2y$10$ccZvM9GYVK9BA9AOpEAUuOrnHC5Z.vMNlfZJF3Czxbp5BJV.PqlLu');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `t_categorie`
--
ALTER TABLE `t_categorie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_image`
--
ALTER TABLE `t_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
