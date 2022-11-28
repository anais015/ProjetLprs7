<?php
require_once "../../model/Utilisateur.php";
require_once "../../model/bdd/Bdd.php";
require_once "../../model/administrateur/Administrateur.php";

$erreur=false;

$bdd = new Bdd();

if(isset($_POST['inscription'])) {

    $administrateur = new Administrateur(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'mot_de_passe' => $_POST['password']
    ));

    $ins = $administrateur->inscription($bdd);
    echo "Inscription effectuée !";
    header('Location: ../../../index.php');

} else {
    echo "la valeur n'existe pas ! ";
    header('Location: ../../view/inscription.php');
}
?>