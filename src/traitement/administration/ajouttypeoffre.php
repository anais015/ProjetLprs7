<?php
require_once "../../model/administrateur/Type.php";
require_once "../../model/bdd/Bdd.php";
$bdd = new Bdd();
$typeoffre = new Type(array(
    'nom'=>$_POST['nom']
));
$typeoffre->ajoutType($bdd);
header("Location: ../../view/administration/gestiontypeoffre.php");