-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--
-- Serveur: dossiers.techniques.sql.free.fr
-- Généré le : Ven 29 Novembre 2019 à 17:33
-- Version du serveur: 5.0.83
-- Version de PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `dossiers_techniques`
--

-- --------------------------------------------------------

--
-- Structure de la vue `Vue_code_vignettes`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`dossiers.techniques`@`172.20.%` SQL SECURITY DEFINER VIEW `Vue_code_vignettes` AS select concat(_latin1'<a href="pageDT.php?p=',char((97 + `Supports`.`ID`)),_latin1'">',`Supports`.`nom`,_latin1'<br><img src="Supports/',`Supports`.`dossier`,_latin1'/images/',`Supports`.`pti_nom`,_latin1'.png" alt="',`Supports`.`nom`,_latin1'"></a>') AS `code` from `Supports` order by `Supports`.`pti_nom`,`Supports`.`nom`;

--
-- VIEW  `Vue_code_vignettes`
-- Données: aucune
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
