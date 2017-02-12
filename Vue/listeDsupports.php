<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8" />	
	<link rel="stylesheet" href="Vue/style_liste.css" />
	<title>Les Dossiers techniques de ChristopHe</title>
</head>

<body>
<div id="page"><!-- contient tout l'affichage -->

<header>
	<p>Liste des dossiers techniques</p>
</header>

<section>
	<h1>Cliquez sur l&#145;image ou le nom du support pour ouvrir son dossier technique</h1>
	<table>
	<?php
		$_SESSION[SUPPORT] = null; // on détruit le support en cours
		// prévoir test du navigateur à faire pour afficher une alerte
		
		$No_colonne = -1;
		$NB_colonne = 4;
		foreach ($LISTE_SUPPORTS as $id => $support)	{
			$No_colonne++;
			$No_colonne = $No_colonne % $NB_colonne;
			if($No_colonne==0)	echo "\n\t", '<tr>';								// nouvelle ligne
			echo "\n\t\t", '<td><a href="index.php?support=', $id, '">';	// lien
			echo '<img src="', $support->dossier.'images/', $support->image, '" alt="', $support->nom, '">'; // image
			echo $support->nom;	// nom du support
			echo '</a></td>';		// fin de cellule
			if($No_colonne==$NB_colonne-1) echo "\n\t", '</tr>';	// fin de ligne si dernière colonne atteinte
		}
		// en sortie on s'arrete sur une colonne autre que la dernière
		if($No_colonne!=$NB_colonne-1) echo "\n\t", '</tr>', "\n";
	?>
	</table>
</section>

<footer>
<?php include 'pied2page.php'; ?>
</footer>

</div>
</body>
</html>
