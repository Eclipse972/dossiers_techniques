<?php
class Fichier {
	protected $fichier;

	public function __construct($fichier, $dossier, $substitution = '#')
		{ $this->fichier = (file_exists($dossier.$fichier)) ? $dossier.$fichier : $substitution; }
	
	public function Chemin() { return $this->fichier; } // renvoi le chemin d'accès complet

	public function Lien($texte) { return '<a href="'.$this->fichier.'">'.$texte.'</a>'; }

	public function Existe() { return ($this->fichier != '#'); }
}

class Zip extends Fichier {
	public function __construct($fichier, $dossier) { parent::__construct($fichier.'.zip', $dossier.'fichiers/'); }
}

class Image extends Fichier {
	public function __construct($fichier, $dossier) {
		if (!strpos($fichier, '.')) // le fichier n'a pas d'extension
			$fichier .= '.png';	// alors c'est un png
		parent::__construct($fichier, $dossier, 'Vue/pas2photo.png');
	}
	public function Existe() { return ($this->fichier != 'Vue/pas2photo.png'); }

	public function Balise($alt, $supplement = '')	{ return '<img src="'.$this->fichier.'" '.$supplement.' alt="'.$alt.'">'; }
}

class Association_image_fichier {
// contient le chemin complet pour accéder ...
	protected $image;	// à l'image
	protected $fichier;	// au fichier

	public function __construct($dossier, $image, $fichier) {
		// les noms de l'image et du fichier contiennent leur extension mais n'ont pas forcément des noms identiques
		$image = new Image($image, $dossier.'images/');
		$fichier = new Fichier($fichier, $dossier.'fichiers/');
		if (!$image->Existe() && !$fichier->Existe())
			trigger_error('L&apos;association image-fichier est vide', E_USER_WARNING);
		$this->image = $image->Chemin();
		$this->fichier = $fichier->Chemin();
	}

	public function Associer($alt, $supplement = '') {	// renvoi le code d'une image liée avec son fichier
		return '<a href="'.$this->fichier.'"><img src="'.$this->image.'" '.$supplement.' alt = "'.$alt.'"></a>';
	}
}

class Piece extends Association_image_fichier {
	private	$nom;
	private	$repere;
	private $quantite;
	private $matiere;
	private $URL_matiere;
	private $observation;

	public function __construct($T_param) {  // pièce hydratée par la BD
		$this->nom = $T_param['nom'];
		$this->repere = $T_param['repere'];
		$this->quantite = $T_param['quantite'];	
		$this->matiere = $T_param['matiere'];
		$this->URL_matiere =  $T_param['URL_wiki'];
		$this->observation =  $T_param['observation'];
		$T_param['dossier'] = 'Supports/'.$T_param['dossier'].'/';

		parent::__construct($T_param['dossier'], $T_param['fichier'], $T_param['fichier'].$T_param['extension']); // constructeur de la classe mère.
		// Rem: l'image et le fichier doivent porter le même nom. image_alt = nom de la pièce
	}

	public function Code($matière = true, $observation = true) {
		$code = '<tr>'."\n";
		$code .= '<td>'.$this->repere.'</td>'."\n";
		$code .= '<td>'.$this->Associer($this->nom).'</td>'."\n";	// lien image-fichier
		$code .= '<td>'.$this->nom;
		if($this->quantite > 1)					// si plusieurs exemplaires
			$code .= ' (x'.$this->quantite.')';	// alors on rajoute la quantité
		$code .= '</td>'."\n";	// on ferme la cellule

		if ($matière) { // colonne matière renseignée
			$code .= '<td>';
			if($this->matiere!='')	
				$code .= '<a href="https://fr.wikipedia.org/wiki/'.$this->URL_matiere.'" target="_blank">'.$this->matiere.'</a>';
			$code .= '</td>'."\n";
		}

		if ($observation)	// colonne observation renseignée
			$code .= '<td>'.$this->observation.'</td>'."\n";
		$code .= '</tr>'; // fin de la ligne
		return $code."\n\n";
	}
}

