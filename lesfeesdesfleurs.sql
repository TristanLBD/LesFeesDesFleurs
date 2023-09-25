-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 19 jan. 2023 à 17:51
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lesfeesdesfleurs`
--

-- --------------------------------------------------------

--
-- Structure de la table `lieux_livraisons`
--

DROP TABLE IF EXISTS `lieux_livraisons`;
CREATE TABLE IF NOT EXISTS `lieux_livraisons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ville` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10253 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `lieux_livraisons`
--

INSERT INTO `lieux_livraisons` (`id`, `ville`) VALUES
(10220, 'saint-marcel sur aude'),
(10221, 'sallèles'),
(10222, 'saint nazaire d\'aude'),
(10223, 'le somail'),
(10224, 'marcorignan'),
(10225, 'ginestas'),
(10227, 'mirepeïsset'),
(10228, 'ventenac en minervois'),
(10229, 'moussan'),
(10230, 'névian'),
(10231, 'bize minervois'),
(10232, 'argeliers'),
(10233, 'sainte-valière'),
(10234, 'agel'),
(10235, 'canet d\'aude'),
(10236, 'paraza'),
(10237, 'roubia'),
(10238, 'raissac'),
(10239, 'mailhac'),
(10240, 'pouzols'),
(10241, 'villedaigne'),
(10243, 'cuxac d\'aude'),
(10244, 'ouveillan'),
(10245, 'narbonne'),
(10246, 'coursan'),
(10247, 'lézignan corbières');

-- --------------------------------------------------------

--
-- Structure de la table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `pwd` longtext NOT NULL,
  `role` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `manager`
--

INSERT INTO `manager` (`id`, `email`, `pwd`, `role`) VALUES
(1, 'azerty@gmail.com', '$2y$12$VXAw7j17cQFV/KvGCYvcSezGcSbOD3rngBfxI2V6LtqCBneecrxaW', 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `workers`
--

DROP TABLE IF EXISTS `workers`;
CREATE TABLE IF NOT EXISTS `workers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(70) NOT NULL,
  `img` varchar(50) NOT NULL DEFAULT 'photo-placholder.png',
  `expertise` int(11) NOT NULL,
  `backgroundIMG` varchar(70) NOT NULL DEFAULT 'background-placeholder.png',
  `fonction` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `workers`
--

INSERT INTO `workers` (`id`, `nom`, `img`, `expertise`, `backgroundIMG`, `fonction`) VALUES
(25, 'Tristan', 'Tristan.png', 2003, 'Tristan-background.webp', 'Dev');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
