<?php

session_start();
require_once "../../model/Utilisateur.php";
require_once "../../model/administrateur/Administrateur.php";
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Connexion.php";
$bdd = new Bdd();
$connexion = new Connexion(array());
var_dump($_POST);
if(isset($_POST['connexion'])){
    $admin = new Administrateur(array(
        "email"=>$_POST['email']
    ));

    $cnx = $admin->connexion($bdd, $_POST['password']);

    if ($cnx){
        $_SESSION['administrateur'] = $cnx;
        header("Location: ../../view/administration/vueadmin.php");
    }else{
        echo "Email ou Mot de passe incorrecte, réessayer !";
        //header('Location: ../../view/connexion.php');
    }
}