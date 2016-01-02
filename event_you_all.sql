-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 02 Janvier 2016 à 12:28
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `event_you_all`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` text COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `id_createur` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL,
  `banniere` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `badges`
--

CREATE TABLE IF NOT EXISTS `badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evenement` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `condition_obtention` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact_admin`
--

CREATE TABLE IF NOT EXISTS `contact_admin` (
  `id` int(11) NOT NULL,
  `id_expediteur` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` text COLLATE utf8_unicode_ci NOT NULL,
  `date_envoi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE IF NOT EXISTS `evenements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_createur` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `prix` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `capacite` int(11) NOT NULL,
  `prive` tinyint(1) NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banniere` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `poster` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mot_clef` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_web` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenements_genres`
--

CREATE TABLE IF NOT EXISTS `evenements_genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evenement` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenements_notes`
--

CREATE TABLE IF NOT EXISTS `evenements_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evenement` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenements_participants`
--

CREATE TABLE IF NOT EXISTS `evenements_participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evenement` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `nb_participant` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenements_photos`
--

CREATE TABLE IF NOT EXISTS `evenements_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evenement` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenements_sponsors`
--

CREATE TABLE IF NOT EXISTS `evenements_sponsors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evenement` int(11) NOT NULL,
  `id_sponsor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenements_types`
--

CREATE TABLE IF NOT EXISTS `evenements_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evenement` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reponse` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forum_categories`
--

CREATE TABLE IF NOT EXISTS `forum_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forum_messages`
--

CREATE TABLE IF NOT EXISTS `forum_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_createur` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forum_topics`
--

CREATE TABLE IF NOT EXISTS `forum_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_createur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE IF NOT EXISTS `groupes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_createur` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `newsletters`
--

CREATE TABLE IF NOT EXISTS `newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` text COLLATE utf8_unicode_ci NOT NULL,
  `date_envoi` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `newsletters_abonnes`
--

CREATE TABLE IF NOT EXISTS `newsletters_abonnes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_newsletter` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sponsors`
--

CREATE TABLE IF NOT EXISTS `sponsors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `sex` enum('m','f','ns') COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `access` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs_badges`
--

CREATE TABLE IF NOT EXISTS `utilisateurs_badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_badge` int(11) NOT NULL,
  `date_obtention` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs_groupes`
--

CREATE TABLE IF NOT EXISTS `utilisateurs_groupes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `gere` tinyint(1) NOT NULL,
  `date_adhesion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
