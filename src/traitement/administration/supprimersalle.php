<?php
require_once "../../model/Salle.php";
require_once "../../model/bdd/Bdd.php";
$bdd = new Bdd();
var_dump($_POST);
$salle = new Salle(array(
    'idsalle'=>$_POST['idsalle']
));
echo $salle->deleteSalle($bdd);
header("Location: ../../view/administration/gestionsalle.php");