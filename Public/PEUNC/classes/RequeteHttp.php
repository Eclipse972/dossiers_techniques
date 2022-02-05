<?php
/*
	Cette classe décode une requête http et renvoie :
		* la position dans l'arborescence même s'il s'agit d'une erreur serveur
		* la méthode utilisée (GET ou POST pour le moment)
		* un tableu contenant la liste des paramètres pré-traités sous la forme d'un tableau associatif

	La position dans l'arborescence. Elle est représentée par un triplet (alpha, beta, gamma) par importance décroissante
	Si alpha >=0 => pages du site
	(X;0;0) => page de 1er niveau. 	(0;0;0) -> page d'accueil.

	(X;Y;0) avec Y>0 => page de 2e niveau

	(X;Y;Z) avec Z>0 => page de 3e niveau

	si alpha<0 => page spéciales PEUNC ou autre
	(-1;code;0) -> page d'erreur avec son code
	(-2;0;0) -> formulaire de contact

	Les pages d'erreur serveur gérées sont: 404,403 et 500 mais on peut en rajouter d'autres

	tableau asoiatif des paramètres. Les paramètres en dehors de la liste autorisé sont ignorés. Enseuite chaque paramètres est nettoyé.
*/
namespace PEUNC;

require_once 'PEUNC/classes/BDD.php';

class HttpRouter {
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
		{	// Toutes les erreurs serveur sont traitées ici via le script index.php. Cf .htaccess
			case 403:	// accès interdit
			case 500:	// erreur serveur
				list($alpha, $beta, $gamma) = [-1, $codeRedirecion, 0];	break;
			case 200:	// le script est lancé sans redirection => page d'accueil
				$alpha = $beta = $gamma	= 0;
				break;
			case 404:	// Ma source d'inspiration: http://urlrewriting.fr/tutoriel-urlrewriting-sans-moteur-rewrite.htm Merci à son auteur
				list($URL, $reste) = explode("?", $_SERVER['REQUEST_URI'], 2);

				// interrogation de la BD pour retrouver la position dans l'arborescence
				$Treponse = $BD->ResultatSQL("SELECT niveau1, niveau2, niveau3 FROM Vue_Routes WHERE URL = ? and methodeHttp = ?", [$URL, $this->methode]);
				$alpha	= $Treponse["niveau1"];
				$beta	= $Treponse["niveau2"];
				$gamma	= $Treponse["niveau3"];

				if (isset($alpha))	// l'URL existe?
					header("Status: 200 OK", false, 200);		// modification pour dire au navigateur que tout va bien finalement
				else list($alpha, $beta, $gamma) = [-1, 404, 0];// erreur 404!
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
