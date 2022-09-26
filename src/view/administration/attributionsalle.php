<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/evenement/Evenement.php";
$bdd = new Bdd();
$evenement = new Evenement(array());
$pendingevent = array($evenement); #ajouter méthode pour avoir les event en attente de validation;
if (count($pendingevent)>1){
    $page = "pendingevent";
}else{
    $page = "Pas d'événement en attente";
}
?>
<html lang="fr">
<head>
    <title>Attribution</title>
</head>
<body>
    <?=$page?>
</body>
</html>
