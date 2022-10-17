<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/evenement/Evenement.php";
require_once "../../model/Salle.php";
$bdd = new Bdd();
$salle = new Salle(array());
$evenement = new Evenement(array());
$salles = $salle->getAllSalle($bdd);
$pendingevents = $evenement->getPendingEvent($bdd); #ajouter méthode pour avoir les event en attente de validation;
#var_dump($pendingevents);
if (count($pendingevents)>=1){
    $eventlist   = "<b>Liste des événements en attente</b>";
    foreach ($pendingevents as $event) {
        $eventelement = "<div style='border: 1px solid black'>
                            <h3 style='margin: 0'>".$event['nom']."</h3>
                            <p>".$event['description']. "</p>
                            <form action='../../traitement/administration/traitementevenement.php' method='post'><input hidden name='evenement'     value='" .$event['id_evenement']."'>
                            <select required name='salle'>";
        foreach ($salles as $salle){
            $eventelement .= "<option value='".$salle['id_salle']."'>".$salle['nom']." ".$salle["nombre_place"]."</option>";
        }
        $eventelement .= "</select><button name='accepter' type='submit'>Accepter l'évènement et l'attribuer à la salle selectionner</button>
                          <button name='supprimer' type='submit'>Supprimer</button></form></div>";
        $eventlist .= $eventelement;
    }
}else{
    $eventlist = "Pas d'événement en attente";
}
?>
<html lang="fr">
<head>
    <title>Attribution</title>
</head>
<body>
    <a href="vueadmin.php">Retour</a>
    <?=$eventlist?>
</body>
</html>
