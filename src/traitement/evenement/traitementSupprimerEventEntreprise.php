<?php

session_start();

require_once "../../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/evenement/Evenement.php";
require_once "../../model/bdd/Bdd.php";

$connexion = new Bdd();
$bdd = $connexion->getBdd();

if(isset($_POST['supprimerEvenement'])) {

    $event = new Evenement(array(
        'id'=>$_POST['id_evenement']
    ));

    $eve = $event->supprimerEvenement($bdd);
    var_dump($eve);


    echo "<script>
        window.location.href = \"../../view/evenement/supprimerEventEntreprise.php\";
        alert(\"Suppression de l'événement effectué\")
        </script>";
}
else{
    echo "<script>
        window.location.href = \"../../view/evenement/supprimerEventEntreprise.php\";
        alert(\"Erreur\")
        </script>";

}


?>
