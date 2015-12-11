-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 03 Décembre 2015 à 23:33
-- Version du serveur :  10.1.8-MariaDB
-- Version de PHP :  5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `event_you_all`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `date_inscription` date NOT NULL,
  `sex` enum('M','F','NS') DEFAULT 'NS',
  `telephone` int(11) DEFAULT NULL,
  `access` tinyint(2) NOT NULL,
  `adresse` int(11) DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `pays` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `nickname`, `email`, `password`, `firstname`, `lastname`, `date_naissance`, `date_inscription`, `sex`, `telephone`, `access`, `adresse`, `code_postal`, `ville`, `pays`) VALUES
(1, 'Thibault', 'thibault.vlacich@gmail.com', 'f2cbf85f846a66723a13e953cb47c61db7feb4e8', 'Thibault', 'Vlacich', NULL, '2015-12-03', NULL, NULL, 0, NULL, NULL, NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
