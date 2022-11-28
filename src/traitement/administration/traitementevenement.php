<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/evenement/Evenement.php";
require_once "../../model/Salle.php";
$bdd = new Bdd();
$salle = new Salle(array(
    "id"=>$_POST['salle']
));
$evenement = new Evenement(array(
    "id"=>$_POST['evenement']
));
var_dump($_POST);
if (isset($_POST['accepter'])){
    $evenement->assignSalle($bdd, $_POST['salle']);
}else{
    $evenement->deleteEvent($bdd);
}
header("Location: ../../view/administration/attributionsalle.php");