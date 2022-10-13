<?php
require_once "../../model/Salle.php";
require_once "../../model/bdd/Bdd.php";
$bdd = new Bdd();
$salle = new Salle(array(
    'nom'=>$_POST['nom'],
    'nombreplace'=>$_POST['nombre_place']
));
$salle->ajoutSalle($bdd);