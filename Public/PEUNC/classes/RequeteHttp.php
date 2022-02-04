<?php	// requête http
namespace PEUNC;

/* contexte sauvegardé dans la session (alpha, beta, gamma) par importance décroissante
	Si alpha >=0 => pages du site
	(X;0;0) => page de 1er niveau. 	(0;0;0) -> page d'accueil.

	(X;Y;0) avec Y>0 => page de 2e niveau

	(X;Y;Z) avec Z>0 => page de 3e niveau

	si alpha<0 => page spéciales PEUNC ou autre
	(-1;code;0) -> page d'erreur avec son code
	(-2;0;0) -> formulaire de contact
*/

require_once 'PEUNC/classes/BDD.php';

class HttpRequest {
	// position
	private $alpha;
	private $beta;
	private $gamma;

	// pour le futur
	private $methode;
	private $Tparam;
	private $IP;

	public function __construct()
	{
		$this->methode = $_SERVER['REQUEST_METHOD'];

		// recherche de la position dans l'application
		$BD = new BDD;
		$codeRedirecion = $_SERVER['REDIRECT_STATUS'];
		switch($codeRedirecion)
		{	// Toutes les erreurs serveur renvoient ici. Cf .htaccess
			case 403:	// accès interdit
			case 500:	// erreur serveur
				list($alpha, $beta, $gamma) = [-1, $codeRedirecion, 0];	break;
			case 200:	// le script est lancé sans redirection
				if(empty($_POST)) { // c'est la page d'accueil
					$alpha = 0;
				} else {	// traitement de formulaire de contact
					$alpha = -2;
				}
				$beta = $gamma	= 0;
				break;
			case 404:	// Ma source d'inspiration: http://urlrewriting.fr/tutoriel-urlrewriting-sans-moteur-rewrite.htm Merci à son auteur
				list($URL, $paramPage, $problem) = explode("?", $_SERVER['REQUEST_URI'], 3);
				if(isset($problem))	throw new \Exception("format URL incorrect");

				// interrogation de la BD pour retrouver la position dans l'arborescence
				$Treponse = $BD->ResultatSQL("SELECT niveau1, niveau2, niveau3 FROM Vue_URLvalides WHERE URL = ?", [$URL]);
				$alpha	= $Treponse["niveau1"];
				$beta	= $Treponse["niveau2"];
				$gamma	= $Treponse["niveau3"];

				if (isset($alpha))	{	// adresse valide, on ne touche à rien
					header("Status: 200 OK", false, 200);	// modification pour dire au navigateur que tout va bien finalement
				} else	list($alpha, $beta, $gamma) = [-1, 404, 0];	// l'adresse invalide reste affichée dans la barre d'adresse'
				break;
			default:
				list($alpha, $beta, $gamma) = [-1, 0, 0];	// erreur inconnue
		}
		list($this->alpha, $this->beta, $this->gamma) = [$alpha, $beta, $gamma];
	}

//	Accesseurs ================================================================================================================================
	public function getAlpha()	{ return $this->alpha; }
	public function getBeta()	{ return $this->beta; }
	public function getGamma()	{ return $this->gamma; }
	public function getMethode(){ return $this->methode; }
}
