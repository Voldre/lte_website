-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 25 Avril 2020 à 20:56
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Structure de la table `personnages_v2`
--

CREATE TABLE IF NOT EXISTS `personnages_v2` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `degats` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `timeEndormi` int(10) unsigned NOT NULL DEFAULT '0',
  `timeWait` int(11) NOT NULL,
  `coups_envoyees` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `atout` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `niveaux` int(11) NOT NULL,
  `experiences` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
