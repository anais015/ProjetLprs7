<?php
session_start();

require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/administrateur/Administrateur.php";
require_once "../../model/Connexion.php";

$erreur=false;

$bdd = new Bdd();
//var_dump($_POST);

if(isset($_POST['connexion'])) {
    $admin = new Administrateur(array(
        'email' => $_POST['email'],
    ));
//    var_dump($etudiant);
    $connexion=$admin->connexion($bdd,$_POST['password']);
    var_dump($connexion);

    if ($connexion) {
        $_SESSION['administrateur']=$connexion;
        header("location:../../view/administration/vueadmin.php");
    } else $erreur=true;
}
?>