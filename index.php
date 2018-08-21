<?php
/*********************************************************************************************************************************** 
	contrôleur principal
************************************************************************************************************************************/
include 'Modele/mes_classes.php';
include 'Controleur/scripts.php';

session_start(); // On démarre la session AVANT toute chose

$TRACEUR = new Traceur; // voir avant dernière ligne pour affichage du rapport
$_BD = new base2donnees();
$VIE_DU_CACHE = 2; // en heure. Mettre à zéro lorsque j'interviens sur le site
Extraire_parametre($_ID, $_ITEM, $_SOUS_ITEM);
$_SESSION = ($_BD->Support_existe($_ID)) ? new Support($_ID) : null; // création du support s'il existe
// trois scénari possibles
if (!isset($_SESSION)) { // page d'index
	$CSS = 'style_page';
	$LOGO = '<img src="Vue/images/logo.png" alt="logo">';	// mon logo
	$TITRE = 'Liste des dossiers techniques';
	$PAGE = 'listeDsupports';
	$CACHE = 'index';
}
elseif ($_ITEM > 0) { // page du dossier technique
	$CSS = 'styleDT';
	$LOGO =  Lien($_SESSION->Image(),$_SESSION->ID(),0); // le logo est un lien la page à propos (ITEM=0)
	$TITRE = 'Dossier technique '.$_SESSION->Du_support();
	$PAGE = 'pageHTML';
	$_SESSION->setPosition($_ITEM, $_SOUS_ITEM);
	$CACHE = $_SESSION->Pti_nom().' '.$_SESSION->ID().'-'.$_SESSION->Item().'-'.$_SESSION->Sous_item();
}
else { // à propos du support
	$CSS = 'style_page';
	$LOGO =  $_SESSION->Image();	// image du support
	$TITRE = '&Agrave; propos '.$_SESSION->Du_support();
	$PAGE = 'a_propos';
	$_SESSION->setPosition(0, 0);
	$CACHE = 'a propos '.$_SESSION->Pti_nom().' '.$_SESSION->ID(); // deux support peuvent avoir le même pti nom
}
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand:400,700&effect=outline">
	<link rel="stylesheet" href="Vue/commun.css" />
	<link rel="stylesheet" href="Vue/<?php echo $CSS; ?>.css" />
	<title>Les Dossiers techniques de ChristopHe</title>
</head>

<body>

<header>
	<div id="logo"><?php echo $LOGO;?></div>
	<div id="titre"><p class="font-effect-outline"><?php echo $TITRE; ?></p></div>
</header>

<?php
$CACHE = 'Vue/cache/'.$CACHE.'.cache';
if(file_exists($CACHE) && time() - filemtime($CACHE) > $VIE_DU_CACHE * 3600)
	readfile($CACHE);
else {
	ob_start();
	include 'Vue/'.$PAGE.'.php';
	echo '<!-- cache généré le ', date("d/m/Y \à H:i"),' -->', "\n";
	$page = ob_get_contents();
	ob_end_clean();
	file_put_contents($CACHE, $page);
	echo $page;
}
?>
<footer>
<p>Site optimis&eacute; pour <img src="Vue/images/chrome.png" alt="Chrome"> et <img src="Vue/images/firefox.png" alt="Firefox">
 - <a href="#">Me contacter</a>
 - derni&egrave;re mise à jour: 21 ao&ucirc;t 2018</p>
</footer>

</body>
<?php $TRACEUR->afficher_rapport();?>
</html>
