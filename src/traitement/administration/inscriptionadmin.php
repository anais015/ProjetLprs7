<?php
require_once "../model/administrateur/Administrateur.php";
require_once "../model/bdd/Bdd.php";
$bdd = new Bdd();
$admin = new Administrateur(array(
    'nom'=>$_POST['nom'],
    'prenom'=>$_POST['prenom'],
    'email'=>$_POST['email'],
    'mot_de_passe'=>$_POST['password']
));
$admin->ajoutAdmin($bdd);