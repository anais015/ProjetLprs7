<?php
require_once "../../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/evenement/Evenement.php";
require_once "../../model/bdd/Bdd.php";
session_start();
$connexion = new Bdd();
$bdd = $connexion->getBdd();

if(isset($_POST['annuler'])) {
    $array=json_decode($_POST['annuler'],true);
    $event=new Evenement(array(
        'id'=>$array['id_evenement'],
        'nom'=>$array['nom_event'],
        'description'=>$array['description'],
        'debut'=>$array['debut'],
        'fin'=>$array['fin'],
        'ref_entreprise'=>$array['ref_entreprise']
    ));

    $eve = $event->supprimerEvenement($bdd);
    if($eve){
        echo "<script>
        window.location.href = \"../../view/entreprise/listeEventEntreprise.php\";
        alert(\"Evénement supprimé\")
        </script>";
    }
    else{
        echo "<script>
        window.location.href = \"../../view/entreprise/listeEventEntreprise.php\";
        alert(\"Erreur\")
        </script>";
    }
}
?>