-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le :  jeu. 17 jan. 2019 à 22:12
-- Version du serveur :  5.5.61
-- Version de PHP :  7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `pictureID` int(11) NOT NULL,
  `user` varchar(50) NOT NULL DEFAULT 'Anonymous',
  `content` varchar(500) NOT NULL,
  `commentDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `pictureID`, `user`, `content`, `commentDate`) VALUES
(8, 18, 'Angel', 'ad', '2019-01-17 16:03:42');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `userID` int(11) NOT NULL,
  `pictureID` int(11) NOT NULL,
  `likeDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`userID`, `pictureID`, `likeDate`) VALUES
(1, 8, '0000-00-00 00:00:00'),
(1, 20, '2019-01-17 21:07:12');

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `likeCount` int(11) DEFAULT '0',
  `commentCount` int(11) DEFAULT '0',
  `name` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pictures`
--

INSERT INTO `pictures` (`id`, `userID`, `likeCount`, `commentCount`, `name`, `date`) VALUES
(17, 1, 0, 0, '1547740304798790.png', '2019-01-17 15:51:50'),
(18, 1, 0, 1, '1547741013619694.png', '2019-01-17 16:03:37'),
(19, 1, 0, 0, '1547741880687687.png', '2019-01-17 16:18:12'),
(20, 7, 1, 0, '1547756215988180.png', '2019-01-17 20:17:13');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) DEFAULT '1',
  `creationDate` datetime NOT NULL,
  `validkey` varchar(255) DEFAULT NULL,
  `notification` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `status`, `creationDate`, `validkey`, `notification`) VALUES
(1, 'Angel', '$2y$10$28MUXPDTaY9dgNmHgU/Bu.o9nVe/c/0KTGaiSRnVVxLCRuLxsxi5y', 'scrap.kevin@gmail.com', 3, '2019-01-06 20:51:21', '077022568a8aeb278ed97ce6a378bddf86eb5ccc', 1),
(7, 'Miakoda', '$2y$10$FCs60hzDyovMtdSmzhe7Re28EvDAbZ0QUKJyTO2CJFQFKECyEBkQ.', 'scrap.kevin2@gmail.com', 3, '2019-01-15 16:47:22', '29b5075cb451ab242ad22df3de1b4fc7d37a672e', 1),
(8, 'Fang', '$2y$10$avJlsE8i.TCvpipfzqCTg.WffCGehYn2nM4kN3EkpwTlheA7YDEJ.', 'scrap.kevin3@gmail.com', 2, '2019-01-15 16:47:39', '31c33f7208954508bbdb2c54b6e1a8d253fde499', 1),
(9, 'Luna', '$2y$10$rreZJLG0HWYpKt4w7t3/xOyw8kilNP0kZC/sbufUzwU2mEVNOwjIO', 'scrap.kevin4@gmail.com', -1, '2019-01-15 16:47:59', 'a419354293cc0b7c48f008b2bdb79aa492ac2e93', 1),
(10, 'Norhia', '$2y$10$.fVGZbCV2NDy/y9tRGpKh.zK9hmZVOZa4sbSMY8GgIx7PczN90N1i', 'scrap.kevin5@gmail.com', 1, '2019-01-17 17:36:45', '10f1fe84fc7e21d3504a2fbe0888b4e166d1f8e3', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
