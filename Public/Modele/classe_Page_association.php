<?php
require"Modele/classe_Page.php";

class Page_association extends Page {
/*	Affiche une page avec titre avec une image qui est un lien vers un fichier
 * C'est le cas des dessins d'ensemble et des éclatés.
 * Les fichiers sont au format edrawing de SolidWorks de préférence
 * */

	private $image;				// nom de l'image à afficher avec son extension
	private $fichier;			// nom du fichier associé à l'image avec son extension
	private $commentaireHTML;	// code html du commentaire ajouté en dessous de l'image'

 	public function __construct(array $TparamURL = []) {
		parent::__construct($TparamURL);
		// image et dossier instanciées dans le constructeur de la classe mère

		// valeurs par défaut
		$this->codeTitre = "Association image-fichier"; // créée dans la classe-mère
		$this->commentaireHTML = null;
		// pas de feuille de style supplémentaire à déclarer
	}

/* ***************************
 * MUTATEURS (SETTER)
 * ***************************/

	// les différents types d'association
	public function setDessinDensemble($titre = null)	{
		$valeur = isset($titre) ? $titre : "Dessin d&apos;ensemble";
		$this->setTitreAssociation($valeur);
	}

	public function setEclate($titre = null)			{
		$valeur = isset($titre) ? $titre : "&Eacute;clat&eacute;";
		$this->setTitreAssociation($valeur);
		$this->commentaireHTML = "<p style=\"text-align:center\">Dans e-Drawing, cliquez sur l&apos;ic&ocirc;ne <img src=\"/images/icone_eclater_rassembler.png\" alt = \"icone\"> pour &eacute;clater/rassembler la maquette num&eacute;rique</p>";
	}
	// fin de la liste

	public function setTitreAssociation($titre = null) {
		$this->codeTitre = isset($titre) ? $titre : "";
	}

	public function SetImage($image) {	// défini l'image à afficher
		$this->image = PEUNC\classes\Page::BaliseImage("/Supports/{$this->dossier}images/{$image}", "{$this->codeTitre} {$this->du_support}", 'class="association"');
	}

	public function setFichier($fichier) {	// défini le fichier à télécharger avec recherche d'existence du fichier
		$fichier = "Supports/{$this->dossier}fichiers/{$fichier}";
		$this->fichier = (file_exists($fichier)) ? "/" . $fichier : "#";
	}

	public function setCommentaire($commentaire) { $this->commentaireHTML = $commentaire; }

/* Le controleur a la structure suivante :
 * <?php
 * $this->setDessinDensemble() ou $this->setEclate() ou ...
 * Remarque: cette manière de faire permet de faire planter php en cas d'erreur de nom
 *
 * this->SetImage(...)
 * this->setFichier(...)
 * */

/* ***************************
 * ASSESSURS (GETTER)
 * ***************************/
	public function getSection() { // redéfinition du code pour afficher la page
		return	$this->getTitrePage()	// titre de la page
			.	"<p style=\"text-align:center\">Cliquez sur l&apos;image pour t&eacute;l&eacute;charger le fichier associ&eacute;.</p>\n"	// insctruction
			.	"<a href=\"{$this->fichier}\">{$this->image}</a>\n"					// image est un lien
			.	(isset($this->commentaireHTML) ? $this->commentaireHTML : "");	// éventuel commentaire sous l'image
	}
}
