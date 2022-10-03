<?php

session_start();

require_once "../../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Connexion.php";

$connexion = new Bdd();
$bdd = $connexion->getBdd();

if(isset($_POST['connexion'])) {
    $entreprise = new Entreprise(array(
        'email' => $_POST['email']
    ));

    $co = $entreprise->connexion($bdd, $_POST['password']);

    if ($co) {

        $_SESSION['entreprise'] = $co;
        header("Location: ../../view/entreprise/page_accueil.php");
        //

    } else {
        echo "Email ou Mot de passe incorrecte, réessayer !";
        header('Location: ../../view/connexion.php');
    }
}

?>