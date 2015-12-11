-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 10 Décembre 2015 à 12:30
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `eventall`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` text COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `id_createur` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `badges`
--

CREATE TABLE IF NOT EXISTS `badges` (
  `id` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `condition_obtention` varchar(255) COLLATE utf8_unicode_ci NOT NULL
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
  `id` int(11) NOT NULL,
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
  `mot_clef` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_web` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenement_genres`
--

CREATE TABLE IF NOT EXISTS `evenement_genres` (
  `id` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenement_participant`
--

CREATE TABLE IF NOT EXISTS `evenement_participant` (
  `id` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `nb_participant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenement_photo`
--

CREATE TABLE IF NOT EXISTS `evenement_photo` (
  `id` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenement_sponsors`
--

CREATE TABLE IF NOT EXISTS `evenement_sponsors` (
  `id` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL,
  `id_sponsor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenement_types`
--

CREATE TABLE IF NOT EXISTS `evenement_types` (
  `id` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL,
  `id_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reponse` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forum_categories`
--

CREATE TABLE IF NOT EXISTS `forum_categories` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forum_messages`
--

CREATE TABLE IF NOT EXISTS `forum_messages` (
  `id` int(11) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forum_topics`
--

CREATE TABLE IF NOT EXISTS `forum_topics` (
  `id` int(11) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE IF NOT EXISTS `groupes` (
  `id` int(11) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `newsletters`
--

CREATE TABLE IF NOT EXISTS `newsletters` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` text COLLATE utf8_unicode_ci NOT NULL,
  `date_envoi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `newsletter_abonnes`
--

CREATE TABLE IF NOT EXISTS `newsletter_abonnes` (
  `id` int(11) NOT NULL,
  `id_newsletter` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notation`
--

CREATE TABLE IF NOT EXISTS `notation` (
  `id` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sponsors`
--

CREATE TABLE IF NOT EXISTS `sponsors` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL,
  `pseudonyme` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `date_inscription` datetime NOT NULL,
  `sexe` enum('m','f','nsp','') COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` int(11) NOT NULL,
  `niveau_acces` int(11) NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_badge`
--

CREATE TABLE IF NOT EXISTS `utilisateur_badge` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_badge` int(11) NOT NULL,
  `date_obtention` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_groupes`
--

CREATE TABLE IF NOT EXISTS `utilisateur_groupes` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `gere` tinyint(1) NOT NULL,
  `date_adhesion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
