<?php

//require_once "../../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
//require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/evenement/Evenement.php";
require_once "../../model/bdd/Bdd.php";

$connexion = new Bdd();
$bdd = $connexion->getBdd();

if(isset($_POST['creerEvenement'])) {

    $event = new Evenement(array(
        'nom_event'=> $_POST['nom_event'],
        'description'=> $_POST['description'],
        'debut'=> $_POST['debut'],
        'fin'=> $_POST['fin'],
        'ref_entreprise'=>$_POST['ref_entreprise']
    ));

    $eve = $event->entrepriseCreerEvenement($bdd);

} else {
    echo "la valeur n'existe pas ! ";
}

?>
