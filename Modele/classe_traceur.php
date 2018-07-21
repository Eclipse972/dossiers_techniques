<?php
class Traceur {
	private $rapport;
	
public function __construct() {
	$this->rapport = null; // rapport vide
}

public function message($message) { // ajout d'un message dans le rapport
	$this->rapport[] = $message;
}

public function lieu($fonction) { // pour affihcer la fonction dans laquelle est lancée le traceur
	$this->message('Lieu : '.$fonction.' ----------------------');
}

public function afficher_variable($nom, $valeur) { // ne permet d'aficher que des variables simples. Pour un tableau il faut utiliser des boucles pour chaque case
	$this->message('variable '.$nom.' = '.$valeur);
}

public function afficher_tableau($nom, $tableau) {
	$this->message('tableau : '.$nom.' ----------------------');
	foreach($tableau as $cle => $valeur) {
		$this->message($cle.' => '.$valeur);
	}
	$this->message('fin de tableau '.$nom." ----------------------\n");
}

public function afficher_rapport() {
	echo '<!-- '; // début du bloc de commentaire
	if (isset($this->rapport)) {
		echo '--------------------- RAPPORT DU ', date("d/m/Y \à H:i:s"),"--------------------- \n";
		foreach($this->rapport as $ligne) { echo $ligne, "\n"; }
	} else echo "--------------------- RAPPORT VIERGE ---------------------";
	echo ' -->',"\n";
}
}

