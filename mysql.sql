-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 06 août 2018 à 13:28
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boss_de_fin`
--

-- --------------------------------------------------------

--
-- Structure de la table `accueil`
--

DROP TABLE IF EXISTS `accueil`;
CREATE TABLE IF NOT EXISTS `accueil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lien` text NOT NULL,
  `titre` varchar(255) NOT NULL,
  `sous_titre` text NOT NULL,
  `contenu` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `position` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `accueil`
--

INSERT INTO `accueil` (`id`, `lien`, `titre`, `sous_titre`, `contenu`, `image`, `position`) VALUES
(1, 'index.php', 'Titre de la page', 'sous-titre', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec orci arcu. Praesent et augue interdum, scelerisque ex et, viverra ligula. Cras et vehicula nulla, et tempus risus. Aenean rutrum dui ac bibendum facilisis. Curabitur in nunc sed tortor placerat mattis. Vivamus lacinia augue at eros sodales, vel blandit arcu fermentum. Donec in sapien magna. Suspendisse porta facilisis enim, nec hendrerit augue. Nam suscipit, justo id interdum commodo, ipsum leo viverra elit, ut laoreet orci dolor nec libero.\r\n\r\nFusce consectetur ligula vitae nulla dapibus tempor. Quisque arcu nisi, consectetur dignissim arcu non, dapibus vulputate tortor. Integer venenatis, lacus eu scelerisque commodo, odio erat laoreet erat, auctor laoreet est neque quis sapien. Maecenas tincidunt odio orci, at dictum lacus fermentum nec. Donec scelerisque tincidunt urna et tincidunt. Maecenas sed nunc vitae ipsum gravida scelerisque.', 'accueil.jpg', ''),
(3, '', 'Post 2', 'resumer 2', '', 'index.svg', 'droite'),
(2, '', 'Post 1', 'resumer 1', '', 'index.svg', 'gauche'),
(4, '', 'Post 3', 'resumer 3', '', 'index.svg', 'gauche');

-- --------------------------------------------------------

--
-- Structure de la table `navigation`
--

DROP TABLE IF EXISTS `navigation`;
CREATE TABLE IF NOT EXISTS `navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pages` varchar(255) DEFAULT NULL,
  `nom` varchar(100) NOT NULL,
  `renommer` varchar(255) NOT NULL,
  `lien` text NOT NULL,
  `ordre` int(11) DEFAULT NULL,
  `sous_menu` varchar(100) NOT NULL,
  `actif` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=156 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `navigation`
--

INSERT INTO `navigation` (`id`, `id_pages`, `nom`, `renommer`, `lien`, `ordre`, `sous_menu`, `actif`) VALUES
(1, '1', 'page exemple', 'page exemple', 'page-exemple', 1, 'oui', 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lien` text NOT NULL,
  `titre` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sous_titre` text NOT NULL,
  `contenu` text NOT NULL,
  `actif` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`id`, `lien`, `titre`, `image`, `sous_titre`, `contenu`, `actif`) VALUES
(1, 'page-exemple', 'page exemple', 'accueil.jpg', 'Sous-titre de la page', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec orci arcu. Praesent et augue interdum, scelerisque ex et, viverra ligula. Cras et vehicula nulla, et tempus risus. Aenean rutrum dui ac bibendum facilisis. Curabitur in nunc sed tortor placerat mattis. Vivamus lacinia augue at eros sodales, vel blandit arcu fermentum. Donec in sapien magna. Suspendisse porta facilisis enim, nec hendrerit augue. Nam suscipit, justo id interdum commodo, ipsum leo viverra elit, ut laoreet orci dolor nec libero.\r\n\r\nFusce consectetur ligula vitae nulla dapibus tempor. Quisque arcu nisi, consectetur dignissim arcu non, dapibus vulputate tortor. Integer venenatis, lacus eu scelerisque commodo, odio erat laoreet erat, auctor laoreet est neque quis sapien. Maecenas tincidunt odio orci, at dictum lacus fermentum nec. Donec scelerisque tincidunt urna et tincidunt. Maecenas sed nunc vitae ipsum gravida scelerisque.', 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(255) NOT NULL,
  `couleur_pri` varchar(255) NOT NULL DEFAULT '#FFF',
  `couleur_sec` varchar(255) NOT NULL DEFAULT '#FFF',
  `couleur_txt` varchar(255) NOT NULL DEFAULT '#FFF',
  `actif` varchar(11) NOT NULL DEFAULT 'oui',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`id`, `theme`, `couleur_pri`, `couleur_sec`, `couleur_txt`, `actif`) VALUES
(4, 'template-1', '#faf2e6', '#ddf7fd', '#8200fa', 'non'),
(2, 'template-2', '#faf6f2', '#2e2d1c', '#ff4500', 'non'),
(3, 'template-3', '#f6f5ff', '#cecece', '#b800ff', 'non'),
(1, 'default', '#FFF', '#ececec', '#212529', 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `actif` varchar(11) NOT NULL DEFAULT 'oui',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `nom`, `actif`) VALUES
(1, 'admin', 'admin', 'admin', 'oui');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
