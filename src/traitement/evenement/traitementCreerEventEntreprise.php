<?php

//require_once "../../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
//require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/evenement/Evenement.php";
require_once "../../model/bdd/Bdd.php";

$connexion = new Bdd();
$bdd = $connexion->getBdd();

if(isset($_POST['creerEvenement'])) {

    $event = new Evenement(array(
        'nom'=> $_POST['nom'],
        'description'=> $_POST['description'],
        'date'=> $_POST['date'],
        'heure'=> $_POST['heure'],
        'duree'=> $_POST['duree'],
        'ref_entreprise'=>$_POST['ref_entreprise']
    ));

    $eve = $event->entrepriseCreerEvenement($bdd);

} else {
    echo "la valeur n'existe pas ! ";
}

?>
