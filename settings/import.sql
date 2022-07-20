-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 19 juil. 2022 à 07:17
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `mister_cocktail_oo`
--
CREATE DATABASE IF NOT EXISTS `mister_cocktail_oo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mister_cocktail_oo`;

-- --------------------------------------------------------

--
-- Structure de la table `alcohol`
--

CREATE TABLE `alcohol` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `alcohol`
--

INSERT INTO `alcohol` (`id`, `name`) VALUES
(1, 'rhum'),
(2, 'vin rouge');

-- --------------------------------------------------------

--
-- Structure de la table `cocktail`
--

CREATE TABLE `cocktail` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(80) NOT NULL,
  `content` text NOT NULL,
  `picture` varchar(60) NOT NULL,
  `alcohol_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cocktail`
--

INSERT INTO `cocktail` (`id`, `name`, `content`, `picture`, `alcohol_id`) VALUES
(1, 'Ti Punch', 'le meilleur des remèdes', 'ti-punch.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `cocktail_assoc`
--

CREATE TABLE `cocktail_assoc` (
  `cocktail_id` smallint(5) UNSIGNED NOT NULL,
  `ingredient_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cocktail_assoc`
--

INSERT INTO `cocktail_assoc` (`cocktail_id`, `ingredient_id`) VALUES
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE `ingredient` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id`, `name`) VALUES
(1, 'citron jaune'),
(2, 'citron vert'),
(4, 'glaçon'),
(3, 'sucre de canne');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(64) NOT NULL,
  `created_at` date NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `created_at`, `role_id`) VALUES
(1, 'toto', 'toto@toto.fr', '$2y$10$RDBilRIA98n4.1RmgOpMnOfjyEXrBEngGaARsBVgNGPJCRIUlicH.', '2022-07-18', 2),
(2, 'admin', 'admin@admin.fr', '$2y$10$waGCXS3LarTDy2Ngrtl.7.pAAGglmh4y0kgy2/yYJB.mEbTmcHhZy', '2022-07-18', 1),
(3, 'lala', 'lala@lala.fr', '$2y$10$ZZC4lFmDuW9IQwQr2aL0hee1k5OVDRK7zjR9QxCy.yo24ahRkTphi', '2022-07-18', 2),
(4, 'tata', 'tata@tata.fr', '$2y$10$r03pklgVVzhIhD1A2UfcXONZ8CVWX6Dho7SSdg9XAaPIdW4F3Yp4e', '2022-07-18', 2),
(5, 'jobi', 'jobi@joba.fr', '$2y$10$fJQg5uTXF5joT5N7hL1Ajuo7y.GHXMVIryxdF7gxXAd748CoSNkGe', '2022-07-18', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `alcohol`
--
ALTER TABLE `alcohol`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `cocktail`
--
ALTER TABLE `cocktail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `alcohol_id` (`alcohol_id`),
  ADD KEY `alcohol_id_2` (`alcohol_id`);

--
-- Index pour la table `cocktail_assoc`
--
ALTER TABLE `cocktail_assoc`
  ADD KEY `cocktail_id` (`cocktail_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- Index pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `alcohol`
--
ALTER TABLE `alcohol`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `cocktail`
--
ALTER TABLE `cocktail`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cocktail`
--
ALTER TABLE `cocktail`
  ADD CONSTRAINT `cocktail_ibfk_1` FOREIGN KEY (`alcohol_id`) REFERENCES `alcohol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `cocktail_assoc`
--
ALTER TABLE `cocktail_assoc`
  ADD CONSTRAINT `cocktail_assoc_ibfk_2` FOREIGN KEY (`cocktail_id`) REFERENCES `cocktail` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cocktail_assoc_ibfk_3` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
