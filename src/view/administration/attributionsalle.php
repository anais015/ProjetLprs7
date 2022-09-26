<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/evenement/Evenement.php";
$bdd = new Bdd();
$evenement = new Evenement(array());
$pendingevents = $evenement->getPendingEvent($bdd); #ajouter méthode pour avoir les event en attente de validation;
#var_dump($pendingevents);
if (count($pendingevents)>=1){
    $page = "<b>Liste des événements en attente</b>";
    foreach ($pendingevents as $event) {
        $html = "<div style='border: 1px solid black'><h3 style='margin: 0'>".$event['nom']."</h3><p>".$event['description']."</p></div>";
        $page .= $html;
    }
}else{
    $page = "Pas d'événement en attente";
}
?>
<html lang="fr">
<head>
    <title>Attribution</title>
</head>
<body>
    <a href="vueadmin.php">Retour</a>
    <?=$page?>
</body>
</html>
