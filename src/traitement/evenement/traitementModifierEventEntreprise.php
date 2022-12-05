<?php

session_start();

require_once "../../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/evenement/Evenement.php";
require_once "../../model/bdd/Bdd.php";

$connexion = new Bdd();
$bdd = $connexion->getBdd();
var_dump($_POST);
if(isset($_POST['modifierEvenement'])) {

    $event = new Evenement(array(
        'nom'=> $_POST['nom_event'],
        'description'=> $_POST['description'],
        'debut'=> $_POST['debut'],
        'fin'=> $_POST['fin'],
        'id'=>$_POST['id_evenement']
    ));

    $eve = $event->modifierEvenement($bdd);
    var_dump($eve);


       echo "<script>
        window.location.href = \"../../view/evenement/modifierEventEntreprise.php\";
        alert(\"Modification d'événement enregistré\")
        </script>";
    }
    else{
        echo "<script>
        window.location.href = \"../../view/evenement/modifierEventEntreprise.php\";
        alert(\"Erreur\")
        </script>";

}

?>
