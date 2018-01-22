
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;




CREATE TABLE IF NOT EXISTS `Items_menu` (
  `support_ID` int(10) unsigned NOT NULL,
  `item` tinyint(1) unsigned NOT NULL,
  `sous_item` tinyint(1) unsigned NOT NULL default '0',
  `texte` text collate latin1_general_ci NOT NULL,
  `script` varchar(20) collate latin1_general_ci NOT NULL,
  UNIQUE KEY `support-page unique` (`support_ID`,`item`,`sous_item`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


INSERT INTO `Items_menu` (`support_ID`, `item`, `sous_item`, `texte`, `script`) VALUES
(0, 1, 0, 'Mise en situation', 'MES'),
(0, 2, 0, 'Diagramme pieuvre', 'pieuvre'),
(0, 3, 0, 'Dessin d&apos;ensemble', 'dessin_densemble'),
(0, 4, 0, '&Eacute;clat&eacute;', 'eclate'),
(0, 5, 0, 'Nomenclature', 'nomenclature'),
(1, 1, 0, 'Mise en situation', 'MES'),
(1, 2, 0, 'Nomenclature', 'nomenclature'),
(1, 3, 0, '&Eacute;clat&eacute;', 'eclate'),
(2, 1, 0, 'Mise en situation', 'MES'),
(2, 2, 0, 'Fonctionnement', 'fonctionnement'),
(2, 2, 1, '&Eacute;tape 1', 'position1'),
(2, 2, 2, '&Eacute;tape 2', 'position2'),
(2, 2, 3, '&Eacute;tape 3', 'position3'),
(2, 3, 0, 'Caract&eacute;ristiques', 'caracteristiques'),
(2, 4, 0, 'Dessin d&apos;ensemble', 'dessin_densemble'),
(2, 5, 0, '&Eacute;clat&eacute;', 'eclate'),
(3, 1, 0, 'Mise en situation', 'MES'),
(3, 2, 0, 'Fonctionnement', 'fonctionnement'),
(3, 2, 1, 'Mont&eacute;e', 'montee'),
(3, 2, 2, 'Descente', 'descente'),
(3, 3, 0, 'Analyse fonctionnelle', 'pieuvre'),
(3, 4, 0, 'Dessin d&apos;ensemble', 'dessin_densemble'),
(3, 5, 0, 'Nomenclature', 'nomenclature'),
(3, 6, 0, '&Eacute;clat&eacute;', 'eclate'),
(4, 1, 0, 'Mise en situation', 'MES'),
(4, 2, 0, 'Fonctionnement', 'fonctionnement'),
(4, 2, 1, 'mont&eacute;e', 'monte'),
(4, 2, 2, 'descente', 'descend'),
(4, 2, 3, 'pr&eacute;cautions d&apos;utilisation', 'precautions'),
(4, 3, 0, 'Mouvements du cric', 'mvt'),
(4, 3, 1, 'de face', 'mvt-face'),
(4, 3, 2, 'en perspective', 'mvt-3d'),
(4, 4, 0, 'Analyse fonctionnelle', 'AF'),
(4, 4, 1, 'diagramme des int&eacute;racteurs', 'pieuvre'),
(4, 4, 2, 'FAST "Levage du v&eacute;hicule"', 'fast_levage'),
(4, 4, 3, 'FAST "D&eacute;pose du v&eacute;hicule"', 'fast_depose'),
(4, 5, 0, '&Eacute;clat&eacute;', 'eclate_cric'),
(4, 6, 0, 'Nomenclature', 'nomenclature'),
(4, 7, 0, 'Nomenclature', 'nomenclature'),
(4, 8, 0, 'Entretien du cric', 'entretien'),
(4, 8, 1, 'Probl&egrave;me au levage', 'pb_levage'),
(4, 8, 2, 'Probl&egrave;me à la descente', 'pb_descente'),
(5, 1, 0, 'Mise en situation', 'MES'),
(5, 2, 0, 'Fonctionnement', 'fonctionnement'),
(5, 3, 0, 'Analyse fonctionnelle', 'AF'),
(5, 4, 0, 'Dessin d&apos;ensemble', 'dessin_densemble'),
(5, 5, 0, 'Nomenclature', 'nomenclature'),
(6, 1, 0, 'Mise en situation', 'MES'),
(6, 2, 0, 'Fonctionnement', 'fonctionnement'),
(6, 3, 0, 'Dessin d&apos;ensemble', 'dessin_densemble'),
(6, 4, 0, 'Nomenclature', 'nomenclature'),
(6, 5, 0, '&Eacute;clat&eacute;', 'eclate'),
(6, 6, 0, 'Classes d&apos;&eacute;quivalence', 'CE'),
(7, 1, 0, 'Mise en situation', 'MES'),
(7, 2, 0, 'Fonctionnement', 'fonctionnement'),
(7, 3, 0, 'Dessin d&apos;ensemble', 'dessin_densemble'),
(7, 4, 0, 'Nomenclature', 'nomenclature'),
(7, 5, 0, '&Eacute;clat&eacute;', 'eclate'),
(8, 1, 0, 'Mise en situation', 'MES'),
(8, 2, 0, 'Diagramme A-0', 'A-0'),
(8, 3, 0, 'Dessin d&apos;ensemble', 'dessin_densemble'),
(8, 4, 0, '&Eacute;clat&eacute;', 'eclate'),
(8, 5, 0, 'Nomenclature', 'nomenclature'),
(9, 1, 0, 'Mise en situation', 'MES'),
(9, 2, 0, 'Fonctionnement', 'fonctionnement'),
(9, 3, 0, 'Dessin d&apos;ensemble', 'dessin_densemble'),
(9, 4, 0, 'Nomenclature', 'nomenclature'),
(9, 5, 0, '&Eacute;clat&eacute;', 'eclate'),
(10, 1, 0, 'Mise en situation', 'MES'),
(10, 2, 0, 'Fonctionnement', 'fonctionnement'),
(10, 3, 0, 'Nomenclature', 'nomenclature'),
(10, 4, 0, '&Eacute;clat&eacute;', 'eclate'),
(11, 1, 0, 'Mise en situation', 'MES'),
(11, 2, 0, 'Dessin d&apos;ensemble', 'dessin_densemble'),
(11, 3, 0, 'Nomenclature', 'nomenclature'),
(11, 4, 0, '&Eacute;clat&eacute;', 'eclate'),
(12, 1, 0, 'Mise en situation', 'MES'),
(12, 1, 1, 'Dispositif de transfert', 'dispositif_transfert'),
(12, 1, 2, '&eacute;tape 1', 'transfert1'),
(12, 1, 4, '&eacute;tape 2', 'transfert2'),
(12, 1, 5, '&eacute;tape 3 et 4', 'transfert3et4'),
(12, 1, 6, '&eacute;tape 5', 'transfert5'),
(12, 1, 7, '&eacute;tape 6', 'transfert6'),
(12, 2, 0, '&Eacute;clat&eacute;', 'eclate_CE'),
(12, 2, 1, 'CE1: b&acirc;ti', 'CE1'),
(12, 2, 2, 'CE2: tige de v&eacute;rin', 'CE2'),
(12, 2, 3, 'CE3: biellette', 'CE3'),
(12, 2, 4, 'CE4: deux doigts', 'CE4'),
(12, 2, 5, 'CE5: un doigt', 'CE5'),
(12, 3, 0, 'M&eacute;canique', 'mecanique'),
(12, 3, 1, 'd&eacute;placement de la tige''', 'tige'),
(12, 3, 2, 'd&eacute;placement de la pince', 'pince'),
(12, 3, 3, 'effort de la tige de v&eacute;rin', 'effort_verin'),
(12, 3, 4, 'effort de l&apos;articulation', 'effort_articulation'),
(13, 1, 0, 'Mise en situation', 'MES'),
(13, 2, 0, 'Fonctionnement', 'fonctionnement'),
(13, 3, 0, 'Dessin d&apos;ensemble', 'dessin_densemble'),
(13, 4, 0, 'Nomenclature', 'nomenclature'),
(13, 5, 0, '&Eacute;clat&eacute;', 'eclate'),
(14, 1, 0, 'Mise en situation', 'MES'),
(14, 2, 0, 'Vue d&apos;ensemble', 'ensemble'),
(14, 3, 0, 'Vue &eacute;clat&eacute;e', 'vue_eclatee'),
(14, 4, 0, 'Nomenclature', 'nomenclature'),
(15, 1, 0, 'Mise en situation', 'MES'),
(15, 2, 0, 'Diagramme A-0', 'A-0'),
(15, 3, 0, 'Dessin d&apos;ensemble', 'dessin_densemble'),
(15, 4, 0, '&Eacute;clat&eacute;', 'eclate'),
(15, 5, 0, 'Nomenclature', 'nomenclature'),
(16, 1, 0, 'Mise en situation', 'MES'),
(16, 2, 0, 'Fonctionnement', 'fonctionnement'),
(16, 3, 0, 'Caract&eacute;ristiques', 'caracteristiques');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
