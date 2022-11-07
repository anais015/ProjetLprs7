<?php

session_start();

require_once "../../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/offre/Offre.php";
require_once "../../model/bdd/Bdd.php";

$connexion = new Bdd();
$bdd = $connexion->getBdd();

if(isset($_POST['creerOffre'])) {

$offre = new Offre(array(
    'nom'=> $_POST['nom'],
    'description'=> $_POST['description'],
    'domaine'=>$_POST['domaine'],
    'ref_entreprise'=>$_SESSION['id_entreprise']
));

$uneoffre = $offre->entrepriseCreerOffre($bdd);

} else {
    echo "la valeur n'existe pas ! ";
}
?>