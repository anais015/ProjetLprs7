<?php
require_once "../../model/administrateur/Type.php";
require_once "../../model/bdd/Bdd.php";
$bdd = new Bdd();
$typeoffre = new Type(array(
    'idtype'=>$_POST['idtype']
));
$typeoffre->deleteType($bdd);
header("Location: ../../view/administration/gestiontypeoffre.php");