-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  ven. 22 juil. 2022 à 12:45
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
(12, 'Bourbon'),
(3, 'Cachaça'),
(11, 'Champagne'),
(10, 'Cidre'),
(9, 'Cognac'),
(14, 'Génépi'),
(13, 'Gin'),
(15, 'Martini'),
(1, 'rhum'),
(5, 'Téquila'),
(6, 'Vin blanc'),
(7, 'Vin rosé'),
(2, 'vin rouge'),
(4, 'Vodka'),
(8, 'Whisky');

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
(1, 'Ti Punch', 'le meilleur des remèdes', 'ti-punch-250x250.jpg', 1),
(2, 'Mojito', 'Préparation\r\nRéalisez la recette \"Mojito\" directement dans le verre.\r\nPlacer les feuilles de menthe dans le verre, ajoutez le sucre et le jus de citrons. Piler consciencieusement afin d\'exprimer l\'essence de la menthe mais sans la broyer. Ajouter le rhum, remplir le verre à moitié de glaçons et compléter avec de l\'eau gazeuse. Mélanger doucement et servir avec une paille.\r\nServir dans un verre de type \"tumbler\".\r\nDécorer de feuilles de menthe fraîches et d\'une tranche de citron.\r\n', 'mojito-250x250.jpg', 1),
(3, 'Piña Colada', 'Préparation\r\nRéalisez la recette \"Piña Colada\" au mixer.\r\nDans un blender (mixer), versez les ingrédients avec 5 ou 6 glaçons et mixez le tout. C\'est prêt ! Versez dans le verre et dégustez. Peut aussi se réaliser au shaker si c\'est juste pour une personne.\r\nServir dans un verre de type \"verre à vin\".\r\nDécorer avec un morceau d\'ananas et une cerise confite.\r\n', 'piña_250x250.jpg', 1),
(4, 'Margarita', 'Préparation\r\nRéalisez la recette \"Margarita\" au shaker.\r\nFrapper les ingrédients au shaker avec des glaçons puis verser dans le verre givré au citron et au sel fin...\r\n\r\nPour givrer facilement le verre, passer le citron sur le bord du verre et tremper les bords dans le sel.\r\nServir dans un verre de type \"verre à margarita\".\r\nDécorer d\'une tranche de citron vert..', 'margarita_250x250.jpeg', 5),
(5, 'Caïpiirinha', 'Préparation\r\nRéalisez la recette \"Caipirinha\" directement dans le verre.\r\nLavez le citron vert et coupez les deux extrémités. Coupez le citron en 8 ou 9 morceaux et retirez la partie blanche centrale responsable de l\'amertume. Placez les morceaux dans le verre et versez une bonne cuillère à soupe de sucre. Pilez fermement le tout dans le verre avec le sucre en poudre jusqu\'à l\'extraction la plus complète possible du jus. Recouvrir le mélange citron-sucre d\'une bonne couche de glace pilée, concassée ou de glaçons simples (ras bord), puis faire le niveau à la cachaça jusqu\'à un doigt du bord.\r\n\r\nNe pas rajouter de sucre après l\'adjonction de la glace (le nouveau sucre ne se dissout plus). Mélanger legèrement avec un mélangeur et servir avec une ou deux petites pailles (au cas où l\'une soit bouchée par la glace ou la pulpe du citron).\r\nServir dans un verre de type \"old fashioned\".\r\n', 'caïpirinha-250x250.jpg', 3),
(6, 'Cosmopolitan', 'Préparation\r\nRéalisez la recette \"Cosmopolitan\" au shaker.\r\nFrapper les ingrédients avec des glaçons et verser dans le verre en filtrant.\r\nServir dans un verre de type \"verre à martini\".\r\nEventuellement une rondelle de citron sur le bord du verre.', 'cosmopolitain_250x250.jpeg', 4),
(7, 'Tequila Sunrise', 'Préparation\r\nRéalisez la recette \"Tequila Sunrise\" directement dans le verre.\r\nVerser la tequila sur des glaçons dans le verre. Compléter avec le jus d\'orange et remuer. Versez doucement le sirop de grenadine dans le verre pour que celui-ci tombe au fond. Donnez alors un petit coup de cuillère pour affiner le dégradé si nécessaire. .\r\nServir dans un verre de type \"tumbler\".\r\nUne rondelle d\'orange.\r\n', 'tequila_sunrise_250x250.jpg', 5),
(8, 'Daiquiri', 'Préparation\r\nRéalisez la recette \"Daiquiri\" au shaker.\r\nFrapper avec des glaçons et passer dans le verre.\r\nServir dans un verre de type \"verre à martini\".\r\nDécorer d\'une tranche de citron vert sur le bord du verre et d\'un morceau de citron vert dans le verre.\r\n', 'daïquiri-250x250.jpg', 1);

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
(1, 3),
(2, 2),
(2, 8),
(2, 5),
(2, 3),
(3, 11),
(3, 33),
(4, 2),
(4, 34),
(5, 2),
(5, 3),
(6, 2),
(6, 35),
(6, 34),
(7, 9),
(7, 17),
(8, 2),
(8, 3);

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
(23, 'Banane'),
(22, 'Bitter'),
(18, 'Cannelle'),
(25, 'Cardamome'),
(1, 'citron jaune'),
(2, 'citron vert'),
(12, 'crème coco'),
(8, 'eau gazeuse'),
(29, 'Eau plate'),
(32, 'Fraise'),
(6, 'glace pilée'),
(4, 'glaçon'),
(11, 'jus d\'ananas'),
(9, 'jus d\'orange'),
(35, 'Jus de Cranberry'),
(16, 'jus de tomate'),
(14, 'jus fruit de la passion'),
(33, 'Lait de coco'),
(5, 'menthe'),
(30, 'Noix de coco rapée'),
(31, 'Poire'),
(19, 'Pomme'),
(28, 'Pousse de bambou'),
(13, 'purée de mangue'),
(7, 'rondelle de citron'),
(21, 'Sirop d\'orgeat'),
(17, 'sirop de grenadine'),
(27, 'Sirop de Rubarbe'),
(26, 'Sirop Egg White'),
(15, 'sucre brun'),
(3, 'sucre de canne'),
(10, 'sucre roux'),
(34, 'Triple sec'),
(20, 'Zeste citron'),
(24, 'Zeste d\'orange');

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
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `alcohol`
--
ALTER TABLE `alcohol`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `cocktail`
--
ALTER TABLE `cocktail`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
  ADD CONSTRAINT `cocktail_assoc_ibfk_2` FOREIGN KEY (`cocktail_id`) REFERENCES `cocktail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cocktail_assoc_ibfk_3` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
