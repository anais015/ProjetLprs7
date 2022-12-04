<?php
require_once "../../model/administrateur/Type.php";
require_once "../../model/bdd/Bdd.php";
$bdd = new Bdd();
session_start();
var_dump($_SESSION);
$typeoffre = new Type(array(
    'nom'=>$_POST['nom'],
    'refAdmin'=>$_SESSION['administrateur']['id_administrateur']
));
$typeoffre->ajoutType($bdd);
header("Location: ../../view/administration/gestiontypeoffre.php");