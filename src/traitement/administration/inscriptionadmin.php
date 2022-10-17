<?php
require_once "../../model/Utilisateur.php";

require_once "../../model/administrateur/Administrateur.php";
require_once "../../model/bdd/Bdd.php";
$bdd = new Bdd();
var_dump($_POST);
$admin = new Administrateur(array(
    'nom'=>$_POST['nom'],
    'prenom'=>$_POST['prenom'],
    'email'=>$_POST['email'],
    'mot_de_passe'=>$_POST['password']
));
$admin->inscription($bdd);