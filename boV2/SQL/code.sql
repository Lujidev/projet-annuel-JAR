-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 25 Juin 2017 à 19:03
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
  `image` varchar(255) DEFAULT 'defaultArticle.png',
  `auteur` int(11) NOT NULL,
  `date_publication` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `categorie_article` varchar(100) DEFAULT NULL,
  `is_liked` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id_article`, `nom_article`, `description_article`, `contenu_article`, `image`, `auteur`, `date_publication`, `date_modification`, `is_deleted`, `categorie_article`, `is_liked`) VALUES
(29, 'Ceci est un article', 'qsd', 'qsd', '594e738bef715.PNG', 3, '2017-06-24 14:13:31', NULL, 1, '10', NULL),
(28, 'qsdqsdaze', 'zae', 'qsdfdfg', '5924b6fd40c0f.PNG', 5, '2017-05-23 22:26:05', NULL, 1, '9', NULL),
(27, 'TestTest132456', 'qsdqsd', 'qsdqsd', '592359657c600.jpg', 5, '2017-05-22 21:34:29', NULL, 1, '10,9', NULL),
(19, 'bonjourImageV3', '123456', '123456', '591997822e590.jpg', 0, '2017-05-15 11:56:50', NULL, 1, '4', NULL),
(20, 'ArticleV2ImageEdit2', 'qsdqsdqsdqsd', 'qsdqsdqsd', '594ef8055db06.png', 0, '2017-05-18 21:19:39', NULL, 1, '9', NULL),
(21, 'TestAuteur', 'Description', 'qsldkjdsklfjksdj', '5921d695ef640.jpg', 5, '2017-05-21 18:04:05', NULL, 1, '10', NULL),
(22, 'MonArticle', 'qsdqsd', 'qsdqsd', '5921df39c5b5c.jpg', 3, '2017-05-21 18:40:57', NULL, 1, '10', NULL),
(23, 'testRoan', 'qsdqsd', 'sdsdf', '59234fa07a8cb.jpg', 5, '2017-05-22 20:52:48', NULL, 1, '9', NULL),
(24, 'TestArticle', 'qsdqsd', 'dfdsf', '59234fd2388cc.PNG', 5, '2017-05-22 20:53:38', NULL, 1, '9', NULL),
(25, 'Test', 'Bonjour Test', 'Bonjour TEST', '592351487f32e.jpg', 5, '2017-05-22 20:59:52', NULL, 1, '9', NULL),
(26, 'mdrAnthony', '123456789', '123456789qsd', '592352038bcb0.PNG', 5, '2017-05-22 21:02:59', NULL, 1, '', NULL),
(30, 'Bonjour', 'Ceci est un article', 'Ceci est un articleCeci est un articleCeci est un articleCeci est un articleCeci est un articleCeci est un articleCeci est un articleCeci est un articleCeci est un articleCeci est un articleCeci est un article', '594eea2da1695.jpg', 5, '2017-06-24 22:39:41', NULL, 1, '9', NULL),
(31, 'Ceci est un article 1', 'Ceci est un article 1', 'Ceci est un article 1', '595002a0c73f0.png', 5, '2017-06-25 18:36:16', NULL, 0, '9', NULL),
(32, 'Ceci est un article 2', 'Ceci est un article 2', 'Ceci est un article 2', '595002b0c1f57.png', 5, '2017-06-25 18:36:32', NULL, 1, '9', NULL),
(33, 'Ceci est un article 3', 'Ceci est un article 3', 'Ceci est un article 3', '595002bc2c6eb.png', 5, '2017-06-25 18:36:44', NULL, 1, '9', NULL);

-- --------------------------------------------------------

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
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom_categorie`, `description_categorie`, `filter`) VALUES
(1, 'Langage C', 'Langage de programmation', 'p'),
(2, 'PHP', 'Langage de programmation', 'p'),
(3, 'Langage C++', 'Langage de programmation', 'e'),
(8, 'PHP++', 'PHP++', 'e'),
(9, 'Framework', 'Framework', 'a');

-- --------------------------------------------------------

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
-- Contenu de la table `chat`
--

INSERT INTO `chat` (`id_msg`, `msg_content`, `id_user`, `id_team`, `send_time`) VALUES
(26, 'Je suis tout seul dans ce groupe ?', 32, 31, '2017-06-25 18:59:28'),
(25, 'Bonjour le groupe JS', 33, 30, '2017-06-25 18:56:11'),
(24, 'Yop tout le monde', 33, 29, '2017-06-25 18:56:01'),
(23, 'Bonjour Admin', 32, 29, '2017-06-25 18:55:35'),
(22, 'Bonjour', 5, 29, '2017-06-25 18:55:19');

-- --------------------------------------------------------

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
-- Contenu de la table `chatnotif`
--

INSERT INTO `chatnotif` (`id_chat_notif`, `id_user`, `id_team`, `old_nb`, `new_nb`) VALUES
(30, 5, 32, 0, 0),
(29, 5, 29, 0, 3),
(28, 33, 29, 3, 3),
(27, 33, 30, 1, 1),
(26, 32, 29, 3, 3),
(25, 32, 31, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_commentaire` int(11) NOT NULL,
  `contenu` text,
  `auteur` int(11) NOT NULL,
  `lien_article` int(11) NOT NULL,
  `date_publication` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `computer`
--

CREATE TABLE `computer` (
  `id_pc` int(11) NOT NULL,
  `name_pc` varchar(255) NOT NULL,
  `cpu` varchar(255) NOT NULL,
  `gpu` varchar(255) NOT NULL,
  `ram` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `computer`
--

INSERT INTO `computer` (`id_pc`, `name_pc`, `cpu`, `gpu`, `ram`, `brand`) VALUES
(1, 'HP Omen', 'Intel I7', 'GTX 1060', 16, 'HP'),
(2, 'Asus Rog', 'Intel I5', 'GTX 980TI', 32, 'Asus'),
(3, 'MSI pc puissant', 'Intel I3', 'GTX 960M', 6, 'MSI');

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

CREATE TABLE `droits` (
  `id_droit` int(11) NOT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `droits`
--

INSERT INTO `droits` (`id_droit`, `role`) VALUES
(1, 'visiteur'),
(2, 'rédacteur'),
(3, 'moderateur'),
(4, 'membre_equipe'),
(5, 'sous_chef_equipe'),
(6, 'chef_equipe');

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE `equipes` (
  `id` int(11) NOT NULL,
  `nom_equipe` varchar(50) NOT NULL,
  `description_equipe` varchar(255) NOT NULL,
  `createur` int(11) NOT NULL,
  `nb_article` int(11) NOT NULL DEFAULT '0',
  `categorie_equipe` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `equipes`
--

INSERT INTO `equipes` (`id`, `nom_equipe`, `description_equipe`, `createur`, `nb_article`, `categorie_equipe`) VALUES
(29, 'ESGI', 'ESGI', 5, 0, '3'),
(30, 'Equipe Javascript', 'Equipe Javascript', 33, 0, '8'),
(31, 'Equipe C', 'Equipe C', 32, 0, '3'),
(32, 'Equipe Eleve', '$user[\'id_utilisateur\']', 5, 0, '8');

-- --------------------------------------------------------

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

-- --------------------------------------------------------

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

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `id_projet` int(11) NOT NULL,
  `nom_projet` varchar(50) NOT NULL,
  `description_projet` text,
  `id_team` int(11) DEFAULT NULL,
  `categorie_projet` varchar(100) DEFAULT NULL,
  `img_projet` varchar(255) DEFAULT 'defaultProject.png',
  `project_statut` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `projets`
--

INSERT INTO `projets` (`id_projet`, `nom_projet`, `description_projet`, `id_team`, `categorie_projet`, `img_projet`, `project_statut`) VALUES
(35, 'Projet langage C', 'Projet langage C', 31, '1', '594ffe760cab0.png', 0),
(34, 'Projet Team JS', 'Projet Team JS', 30, '2', '594ffcb33e368.png', 1),
(33, 'Projet Team ESGI', 'Projet Team ESGI', 29, '2', '594ffc429df0f.png', 0);

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
-- Contenu de la table `teammates`
--

INSERT INTO `teammates` (`id_team_link`, `id_team`, `id_user`, `is_accepted`) VALUES
(70, 30, 33, '1'),
(71, 31, 32, '1'),
(73, 29, 33, '1'),
(67, 29, 5, '1'),
(72, 29, 32, '1'),
(74, 32, 5, '1');

-- --------------------------------------------------------

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
-- Contenu de la table `todo`
--

INSERT INTO `todo` (`id_todo`, `content`, `team`, `is_done`) VALUES
(594, 'La mort', 35, 1),
(593, 'Pointeurs', 35, 1),
(592, 'Remplacer le C', 34, 0),
(591, 'AnÃ©antir le Php', 34, 0),
(590, 'Javascript', 34, 1),
(587, 'qsdqsd', 32, 1),
(576, 'qsdqsd', 25, 0),
(573, 'qsdqsd', 22, 1),
(574, 'qsdkjd', 22, 1),
(575, 'qsdqsd', 22, 1),
(580, 'qsdqsd', 27, 0),
(581, 'qsdqsd', 27, 1),
(582, 'qsdqsd', 27, 0),
(562, 'bonjour333', 21, 1),
(557, 'azeazezr', 18, 0),
(558, 'adsdqsd', 19, 1),
(588, 'qsdqsd', 32, 0),
(589, 'Ajax', 34, 1),
(561, 'bonjour', 21, 1),
(556, 'tartert', 18, 1),
(554, 'qsdqsd', 14, 1),
(555, 'sdfsdf', 14, 1),
(553, 'sdfdsfsdf', 14, 0),
(549, 'mdrrrr', 12, 0),
(550, 'qdsdfsdf', 12, 1),
(551, 'qsdqdsfdsf', 12, 0),
(552, 'qsdqsdqsd', 14, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'defaultAvatar.png',
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

INSERT INTO `utilisateurs` (`id_utilisateur`, `email`, `pseudo`, `avatar`, `mdp`, `presentation`, `date_creation`, `date_modification`, `activation`, `is_deleted`, `access_token`, `droit`) VALUES
(5, 'admin@gmail.com', 'admin', '594ffa1c61e9a.jpg', '$2y$10$PiAYRBrk4GoCnWpC2wBNzObWhlyR3eNSdtrl5U7jPtUT12RGCAc0S', 'Nouvelle Description', '2017-05-15 12:39:48', NULL, '1', 0, '85b1f057a9973fcbe58682674ed2ee36', 3),
(32, 'sananes@gmail.com', 'M.Sananes', '594ff74e1f1b6.png', '$2y$10$gQ3BZLBW/tRUwamlQvU8yuS2bR0DQanmSJk4pftSFPHtPneRsZQh6', 'Bonjour, j\'adore le C. Le C c\'est bien. Apprenez le C.', '2017-06-25 17:48:00', NULL, '1', 0, 'dd40a52b9d12fbb3c131606386aad82b', 2),
(33, 'briatte@gmail.com', 'M.Briatte', '594ffaceed1d5.jpg', '$2y$10$WVK4acCIn69sqXUs9.JO3u644EyvhtMm06HKypWhfsbExGoC5KYhC', 'Js > PhP', '2017-06-25 18:02:57', NULL, '1', 0, '65f3eb494884985845f3efb52000420a', 2),
(1, 'BonjourAdmin@gmail.com', 'globalAdmin', 'defaultAvatar', '$2y$10$PiAYRBrk4GoCnWpC2wBNzObWhlyR3eNSdtrl5U7jPtUT12RGCAc0S', 'Ceci est une présentation', '2017-06-24 19:01:32', NULL, '1', 0, NULL, 3);

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
-- Index pour la table `computer`
--
ALTER TABLE `computer`
  ADD PRIMARY KEY (`id_pc`);

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
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id_msg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `chatnotif`
--
ALTER TABLE `chatnotif`
  MODIFY `id_chat_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `computer`
--
ALTER TABLE `computer`
  MODIFY `id_pc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `droits`
--
ALTER TABLE `droits`
  MODIFY `id_droit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `messagesp`
--
ALTER TABLE `messagesp`
  MODIFY `id_mp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT pour la table `teammates`
--
ALTER TABLE `teammates`
  MODIFY `id_team_link` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT pour la table `todo`
--
ALTER TABLE `todo`
  MODIFY `id_todo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=602;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- CONFIG O MATIK

CREATE TABLE filtres_composants (
       id INT NOT NULL PRIMARY KEY,
       filtre VARCHAR(250) NOT NULL
);

INSERT INTO filtres_composants (id, filtre) VALUES (0, 'Compatible avec tout');
INSERT INTO filtres_composants (id, filtre) VALUES (1, 'Intel');

CREATE TABLE composants (
       id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
       comp_type VARCHAR(30) NOT NULL,
       comp_name VARCHAR(30) NOT NULL,
       brand VARCHAR(25) NOT NULL,	
       price REAL NOT NULL,
       description VARCHAR(500) NOT NULL,
       create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
       filtre INT NOT NULL DEFAULT '0' REFERENCES filtres_composants (filtre)
);

INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('cpu', 'Core i7', 'intel', 500.99, 'Super');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('cpu', 'Core i5', 'intel', 350.50, 'Cool');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('cpu', 'Pentium', 'amd', 100, 'Pas top');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('cpu', 'Tracteur', 'amd', 50, 'Not safe');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('screen', 'DLE1916E', 'Dell', 199.90, '20pouces');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('screen', 'LG19M38A-B', 'LG', 94.80, '60Hz 19pouces');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('screen', 'S19E450BW', 'SAMSUNG', 130.50, '19pouces');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('ram', 'DDR3', 'Kingstone', 21.90, 'G2o');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('ram', 'DDR3', 'Corsair', 20, '2Go');
