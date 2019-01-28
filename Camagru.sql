-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le :  lun. 28 jan. 2019 à 17:47
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
  `ID` int(11) NOT NULL,
  `pictureID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `content` varchar(500) NOT NULL,
  `commentDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`ID`, `pictureID`, `userID`, `content`, `commentDate`) VALUES
(21, 9, 1, 'Another test\r\n', '2019-01-28 15:23:21'),
(22, 9, 7, 'test this', '2019-01-28 15:23:30');

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
(1, 9, '2019-01-28 16:55:14'),
(1, 11, '2019-01-28 16:55:22');

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE `pictures` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `likeCount` int(11) DEFAULT '0',
  `commentCount` int(11) DEFAULT '0',
  `name` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pictures`
--

INSERT INTO `pictures` (`ID`, `userID`, `likeCount`, `commentCount`, `name`, `date`) VALUES
(5, 7, 0, 0, '1548687143709119.jpg', '2019-01-28 14:52:33'),
(8, 1, 0, 0, '1548688981213609.png', '2019-01-28 15:23:07'),
(9, 1, 1, 2, '1548688988732837.png', '2019-01-28 15:23:14'),
(10, 4, 0, 0, '1548693082365106.png', '2019-01-28 16:31:39'),
(11, 4, 1, 0, '1548693101794373.png', '2019-01-28 16:31:48'),
(12, 4, 0, 0, '1548693109569155.png', '2019-01-28 16:32:02');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `user` varchar(25) NOT NULL,
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

INSERT INTO `users` (`ID`, `user`, `password`, `email`, `status`, `creationDate`, `validkey`, `notification`) VALUES
(1, 'Angel', '$2y$10$FlPOATh/y/mLvD4kN6IwXuNJ8m6WATxqHzPQkA/bZ/itQqQRqikhO', 'scrap.kevin@gmail.com', 3, '2019-01-25 18:51:32', '7768e31ab83bca5117d98a71fa544c8f49437823', 1),
(2, 'testBlocked', '$2y$10$euzG8Mh45Cqo6liGQd3wpOYPzOokjNn4dWOfcz9GOFl/rCQrABQsS', 'test@gmail.com', -1, '2019-01-25 20:46:30', 'a74711618bca01c5fc59f9d37aced2a3d9e694a6', 1),
(3, 'testNotVerified', '$2y$10$Mob60XRqYBCHkObwLUg8W.7k/K9w/wfqk2fXEHxO2rU2rYCxfB//.', 'test1@gmail.com', 1, '2019-01-25 20:47:24', '0835c0372f7726022a60cc91693b3a2923b43552', 1),
(4, 'testVerified', '$2y$10$mMGVGRnqK2XcwHgcLXo4NeqJA8KZzcY64jiN.q41LgyfjKNHAnp52', 'test2@gmail.com', 2, '2019-01-25 20:47:48', '5614436bc1f8053e4f84f83f957eabd42099824a', 0),
(5, 'testAdmin', '$2y$10$ngyuD18BPgmbvdFsnwik8eKK2oxTDZ5ZexEI4dOdOUHdEDUWCGwkC', 'test3@gmail.com', 3, '2019-01-25 20:48:12', '3a22eb153daaa3f4f969f225ae8806cab83f2c30', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
