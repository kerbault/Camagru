-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le :  mer. 30 jan. 2019 à 04:52
-- Version du serveur :  5.5.61
-- Version de PHP :  7.2.8


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments`
(
  `ID`          int(11)      NOT NULL,
  `pictureID`   int(11)      NOT NULL,
  `userID`      int(11) DEFAULT NULL,
  `content`     varchar(500) NOT NULL,
  `commentDate` datetime     NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`ID`, `pictureID`, `userID`, `content`, `commentDate`)
VALUES (0, 8, 1, 'test1', '2019-01-30 03:34:52'),
       (0, 8, 1, 'test2\r\n', '2019-01-30 03:34:56'),
       (0, 8, 1, 'test3', '2019-01-30 03:34:59'),
       (0, 7, 1, 'test1', '2019-01-30 03:35:27'),
       (0, 7, 1, 'test2', '2019-01-30 03:35:30'),
       (0, 2, 7, 'test234', '2019-01-30 03:36:19');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes`
(
  `userID`    int(11)  NOT NULL,
  `pictureID` int(11)  NOT NULL,
  `likeDate`  datetime NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`userID`, `pictureID`, `likeDate`)
VALUES (1, 8, '2019-01-30 03:35:18'),
       (1, 5, '2019-01-30 03:35:45'),
       (1, 4, '2019-01-30 03:35:50'),
       (7, 4, '2019-01-30 03:35:59'),
       (7, 5, '2019-01-30 03:36:05'),
       (7, 2, '2019-01-30 03:36:14');

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE `pictures`
(
  `ID`           int(11)  NOT NULL,
  `userID`       int(11)  NOT NULL,
  `likeCount`    int(11) DEFAULT '0',
  `commentCount` int(11) DEFAULT '0',
  `name`         text     NOT NULL,
  `date`         datetime NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Déchargement des données de la table `pictures`
--

INSERT INTO `pictures` (`ID`, `userID`, `likeCount`, `commentCount`, `name`, `date`)
VALUES (1, 1, 0, 0, '1548818871843688.jpg', '2019-01-30 03:27:57'),
       (2, 1, 1, 1, '1548818880577752.png', '2019-01-30 03:28:07'),
       (3, 1, 0, 0, '1548818891600328.jpg', '2019-01-30 03:28:21'),
       (4, 1, 2, 0, '1548818903110547.jpg', '2019-01-30 03:28:29'),
       (5, 1, 2, 0, '1548818911231653.jpg', '2019-01-30 03:28:36'),
       (6, 7, 0, 0, '1548818926229799.jpg', '2019-01-30 03:28:52'),
       (7, 7, 0, 2, '1548818934597649.jpg', '2019-01-30 03:29:02'),
       (8, 7, 1, 3, '1548818944059103.jpg', '2019-01-30 03:29:11');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users`
(
  `ID`           int(11)      NOT NULL,
  `user`         varchar(25)  NOT NULL,
  `password`     text         NOT NULL,
  `email`        varchar(255) NOT NULL,
  `status`       int(11)               DEFAULT '1',
  `creationDate` datetime     NOT NULL,
  `validkey`     varchar(255)          DEFAULT NULL,
  `notification` tinyint(1)   NOT NULL DEFAULT '1'
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID`, `user`, `password`, `email`, `status`, `creationDate`, `validkey`,
                     `notification`)
VALUES (1, 'Angel', '$2y$10$OMyrmoR5JDc7QfIF2WzzgO5aTRj87HBlwnGY4B9xGjOjZNAqjuMkC',
        'scrap.kevin@gmail.com', 3, '2019-01-25 18:51:32', '2a47163ae6a608dfbffa113fa62652609cc645c7', 0),
       (2, 'testBlocked', '$2y$10$euzG8Mh45Cqo6liGQd3wpOYPzOokjNn4dWOfcz9GOFl/rCQrABQsS', 'test@gmail.com',
        -1, '2019-01-25 20:46:30', 'a74711618bca01c5fc59f9d37aced2a3d9e694a6', 1),
       (3, 'testNotVerified', '$2y$10$Mob60XRqYBCHkObwLUg8W.7k/K9w/wfqk2fXEHxO2rU2rYCxfB//.',
        'test1@gmail.com', 1, '2019-01-25 20:47:24', '0835c0372f7726022a60cc91693b3a2923b43552', 1),
       (5, 'testAdmin', '$2y$10$ngyuD18BPgmbvdFsnwik8eKK2oxTDZ5ZexEI4dOdOUHdEDUWCGwkC', 'test3@gmail.com',
        3, '2019-01-25 20:48:12', '3a22eb153daaa3f4f969f225ae8806cab83f2c30', 1),
       (7, 'Kerbault', '$2y$10$zj.s.NlTOni/vlARcF.EIuPMprnDn/w3h7.KronWWwudlWt3GvTK6',
        'kerbault.contact@gmail.com', 2, '2019-01-29 19:13:54', 'f29c88e5d352388828acd480881deb0909ea51f7',
        0),
       (8, 'testVerified', '$2y$10$WwxmGjJOtrIAPySKSPt0peo7lL7znz6fESpW6/Lb4gpJaRirYddWO',
        'test2@gmail.com', 2, '2019-01-29 19:17:40', '294a6ba18eede09e69dad94102bc40951cabeeb0', 1);

--
-- Index pour les tables déchargées
--

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
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
