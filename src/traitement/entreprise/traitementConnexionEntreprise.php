<?php
session_start();

require_once "../../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/bdd/Bdd.php";

$connexion = new Bdd();
$bdd = $connexion->getBdd();

if(isset($_POST['connexion'])) {
    $entreprise = new Entreprise(array(
        'email' => $_POST['email']
    ));

    $co = $entreprise->connexion($bdd);

    if ($co) {
        $_SESSION['entreprise']=$co;
        header("location:../../view/entreprise/page_accueil.php");
    }
}

?>