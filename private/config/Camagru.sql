-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le :  jeu. 31 jan. 2019 à 17:23
-- Version du serveur :  5.5.61
-- Version de PHP :  7.2.14

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
CREATE DATABASE IF NOT EXISTS `Camagru` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `Camagru`;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments`
(
  `ID`          int(11)      NOT NULL AUTO_INCREMENT,
  `pictureID`   int(11)      NOT NULL,
  `userID`      int(11)      NOT NULL,
  `content`     varchar(500) NOT NULL,
  `commentDate` datetime     NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 9
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE IF NOT EXISTS `likes`
(
  `userID`    int(11)  NOT NULL,
  `pictureID` int(11)  NOT NULL,
  `likeDate`  datetime NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures`
(
  `ID`           int(11)      NOT NULL AUTO_INCREMENT,
  `userID`       int(11)      NOT NULL,
  `likeCount`    int(11) DEFAULT '0',
  `commentCount` int(11) DEFAULT '0',
  `subDir`       varchar(100) NOT NULL,
  `name`         text         NOT NULL,
  `date`         datetime     NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 9
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users`
(
  `ID`           int(11)      NOT NULL AUTO_INCREMENT,
  `user`         varchar(25)  NOT NULL,
  `password`     text         NOT NULL,
  `email`        varchar(255) NOT NULL,
  `status`       int(11)    DEFAULT '1',
  `creationDate` datetime     NOT NULL,
  `validkey`     varchar(255) NOT NULL,
  `notification` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 9
  DEFAULT CHARSET = latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID`, `user`, `password`, `email`, `status`, `creationDate`, `validkey`,
                     `notification`)
VALUES (1, 'testBlocked', '$2y$10$euzG8Mh45Cqo6liGQd3wpOYPzOokjNn4dWOfcz9GOFl/rCQrABQsS',
        'test1@gmail.com', -1, '2019-01-25 20:46:30', 'a74711618bca01c5fc59f9d37aced2a3d9e694a6', 1),
       (2, 'testNotVerified', '$2y$10$Mob60XRqYBCHkObwLUg8W.7k/K9w/wfqk2fXEHxO2rU2rYCxfB//.',
        'test2@gmail.com', 1, '2019-01-25 20:47:24', '0835c0372f7726022a60cc91693b3a2923b43552', 1),
       (3, 'testVerified', '$2y$10$WwxmGjJOtrIAPySKSPt0peo7lL7znz6fESpW6/Lb4gpJaRirYddWO',
        'test2@gmail.com', 2, '2019-01-29 19:17:40', '294a6ba18eede09e69dad94102bc40951cabeeb0', 1),
       (4, 'testAdmin', '$2y$10$ngyuD18BPgmbvdFsnwik8eKK2oxTDZ5ZexEI4dOdOUHdEDUWCGwkC', 'test3@gmail.com',
        3, '2019-01-25 20:48:12', '3a22eb153daaa3f4f969f225ae8806cab83f2c30', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
