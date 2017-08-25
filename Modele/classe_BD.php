<?php
class base2donnees {
var $serveur;
var $login;
var $mdp;
var $base;
var $reponse;

function base2donnees() { // constructeur
	// ouverture et connexion à la base
}
function Fermer() {
	// fermeture de la base de données
}
function Support($id) {
	$support = Select_support_article($id); // lecture de la base
	if ($support != null) 
		return new Support($support[0], $support[1], $support[2], $support[3], $support[4]);
	else return null;
}
function Vignette($id) {
	$support = Select_support($id); // lecture de la base
	if ($support != null) {
		$nom = $support[0];
		$image='<img src="'.Image($support[1],'Supports/'.$support[2].'/').'" alt = "'.$nom.'">';
		return $nom.$image;
	} else return null;
}

}	// fin de la classe base de données

// simulation des requếtes --------------------------------------------------
// table support
function Select_support($id) {
	switch($id) {	//		nom  du support					pti_nom					dossier			articles_ID
	case  0: return array('bouton poussoir',				'BP',				'BP',					1);
	case  1: return array('but&eacute;e 5 axes',			'butee', 			'butee5axes',			2);
	case  2: return array('cambreuse',						'cambreuse',		'cambreuse',			2);
	case  3: return array('cric bouteille',					'cric',				'cric_bouteille',		1);
	case  4: return array('cric hydraulique 2 tonnes',		'cric',				'cric_hydraulique',		1);
	case  5: return array('&eacute;lectrovanne',			'electrovanne',		'electrovanne',			3);
	case  6: return array('&eacute;tau de mod&eacute;lisme','etau',				'etau',					3);
	case  7: return array('extracteur de roulement',		'extracteur',		'extracteur2roulement',	3);
	case  8: return array('mini coupe-tube',				'mini_coupe-tube',	'coupe-tube',			1);
	case  9: return array('pince de marquage',				'pince',			'x2marquage',			2);
	case 10: return array('pince de robot',					'pince',			'pince2robot',			2);
	case 11: return array('pompe &agrave; palettes',		'pompe',			'pompeApalettes',		2);
	case 12: return array('pr&eacute;henseur de culasse',	'prehenseur',		'prehenseur',			1);
	case 13: return array('vanne sph&eacute;rique',			'vanne',			'vanne',				2);
	case 14: return array('alternateur',					'alternateur',		'alternateur',			3);
	default: return null;
	}
}

// table articles
function Select_article($id) {
	switch($id) {
	case 1: return array('du ',			'le ');
	case 2: return array('de la ',		'la ');
	case 3: return array('de l&apos;',	'l&apos;');
	default:return null;
	}
}

// jointure support-article
function Select_support_article($id) {
	$reponse = Select_support($id);
	if ($reponse != null) {
		$articles  = Select_article($reponse[3]);
		$reponse[] = $articles[0];
		$reponse[] = $articles[1];
	}
	return $reponse;
}
?>
