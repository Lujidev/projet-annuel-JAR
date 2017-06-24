-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 24 Juin 2017 à 14:43
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetannuel`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id_article` int(11) NOT NULL,
  `nom_article` varchar(50) NOT NULL,
  `description_article` varchar(100) NOT NULL,
  `contenu_article` text NOT NULL,
  `image` text,
  `auteur` int(11) NOT NULL,
  `date_publication` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `categorie_article` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` int(11) NOT NULL,
  `nom_categorie` varchar(50) NOT NULL,
  `description_categorie` varchar(255) DEFAULT NULL,
  `filter` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id_msg` int(11) NOT NULL,
  `msg_content` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_team` int(11) NOT NULL,
  `send_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Structure de la table `chatnotif`
--

CREATE TABLE `chatnotif` (
  `id_chat_notif` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_team` int(11) NOT NULL,
  `old_nb` int(11) NOT NULL DEFAULT '0',
  `new_nb` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
--
-- Structure de la table `droits`
--

CREATE TABLE `droits` (
  `id_droit` int(11) NOT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Structure de la table `equipes`
--

CREATE TABLE `equipes` (
  `id` int(11) NOT NULL,
  `nom_equipe` varchar(50) NOT NULL,
  `description_equipe` varchar(255) NOT NULL,
  `createur` int(11) NOT NULL,
  `equipier` varchar(255) DEFAULT NULL,
  `nb_article` int(11) NOT NULL DEFAULT '0',
  `categorie_equipe` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--

--
-- Structure de la table `messagesp`
--

CREATE TABLE `messagesp` (
  `id_mp` int(11) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `contenu_mp` text,
  `auteur_mp` int(11) NOT NULL,
  `destinataire_mp` int(11) NOT NULL,
  `pj_mp` varchar(500) DEFAULT NULL,
  `is_read_mp` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted_auteur` int(11) NOT NULL DEFAULT '0',
  `is_deleted_destinataire` int(11) NOT NULL DEFAULT '0',
  `date_publication_mp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--


--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id_notif` int(11) NOT NULL,
  `preview` varchar(255) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `notif_desc` varchar(255) NOT NULL,
  `id_link` int(11) DEFAULT NULL,
  `filter` varchar(255) NOT NULL,
  `send_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `id_projet` int(11) NOT NULL,
  `nom_projet` varchar(50) NOT NULL,
  `description_projet` text,
  `id_team` int(11) DEFAULT NULL,
  `categorie_projet` varchar(100) DEFAULT NULL,
  `img_projet` varchar(255) DEFAULT NULL,
  `project_statut` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Structure de la table `rassemble`
--

CREATE TABLE `rassemble` (
  `utilisateur` int(11) NOT NULL,
  `nom_equipe` varchar(50) NOT NULL,
  `droit` int(11) DEFAULT NULL,
  `token_temp` char(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `teammates`
--

CREATE TABLE `teammates` (
  `id_team_link` int(11) NOT NULL,
  `id_team` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `is_accepted` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Structure de la table `todo`
--

CREATE TABLE `todo` (
  `id_todo` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `team` int(11) NOT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'defaultAvatar',
  `mdp` char(60) NOT NULL,
  `presentation` text,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification` timestamp NULL DEFAULT NULL,
  `activation` varchar(40) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `access_token` char(32) DEFAULT NULL,
  `droit` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateurs`
--
-- Index pour les tables exportées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_article`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_msg`);

--
-- Index pour la table `chatnotif`
--
ALTER TABLE `chatnotif`
  ADD PRIMARY KEY (`id_chat_notif`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_commentaire`);

--
-- Index pour la table `droits`
--
ALTER TABLE `droits`
  ADD PRIMARY KEY (`id_droit`);

--
-- Index pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messagesp`
--
ALTER TABLE `messagesp`
  ADD PRIMARY KEY (`id_mp`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id_notif`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id_projet`,`nom_projet`);

--
-- Index pour la table `rassemble`
--
ALTER TABLE `rassemble`
  ADD PRIMARY KEY (`utilisateur`,`nom_equipe`);

--
-- Index pour la table `teammates`
--
ALTER TABLE `teammates`
  ADD PRIMARY KEY (`id_team_link`);

--
-- Index pour la table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id_todo`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id_msg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `chatnotif`
--
ALTER TABLE `chatnotif`
  MODIFY `id_chat_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `droits`
--
ALTER TABLE `droits`
  MODIFY `id_droit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `messagesp`
--
ALTER TABLE `messagesp`
  MODIFY `id_mp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `teammates`
--
ALTER TABLE `teammates`
  MODIFY `id_team_link` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `todo`
--
ALTER TABLE `todo`
  MODIFY `id_todo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=577;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
