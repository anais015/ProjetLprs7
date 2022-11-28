<?php

require_once "../../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/evenement/Evenement.php";
require_once "../../model/bdd/Bdd.php";

session_start();

$connexion = new Bdd();
$bdd = $connexion->getBdd();

if(isset($_POST['creerEvenement'])) {
    $event = new Evenement(array(
        'nom'=> $_POST['nom_event'],
        'description'=> $_POST['description'],
        'debut'=> $_POST['debut'],
        'fin'=> $_POST['fin'],
        'ref_entreprise'=>$_SESSION['entreprise']['id_entreprise']
    ));
    $eve = $event->entrepriseCreerEvenement($bdd);
    if($eve){
        echo "<script>
        window.location.href = \"../../view/entreprise/creerEventEntreprise.php\";
        alert(\"Evénement enregistré\")
        </script>";
    }
    else{
        echo "<script>
        window.location.href = \"../../view/entreprise/creerEventEntreprise.php\";
        alert(\"Erreur\")
        </script>";
    }
}
?>
