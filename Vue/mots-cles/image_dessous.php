<?php 
// echo $oSupport->Générer_page_image($T_instruction);
$titre = $T_instruction['param1'];
$image = $T_instruction['param2'];
$commentaire = $T_instruction['param3'];
$hauteur = $T_instruction['param4'];

$page = new Page_image($image);
$page->Dénommer($titre);
$page->Afficher($commentaire, false, $hauteur);
