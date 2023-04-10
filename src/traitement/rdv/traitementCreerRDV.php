<?php

session_start();

require_once "../../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/rdv/Rdv.php";
require_once "../../model/bdd/Bdd.php";
require_once "../../model/offre/Offre.php";

$connexion = new Bdd();
$bdd = $connexion->getBdd();

if(isset($_POST['OrgRDV'])) {

    $rdv = new Rdv(array(
        'horaire' => $_POST['horaire'],
        'lieux' =>$_POST['lieux'],
        'refEtudiant'=>$_POST['id_etudiant'],
        'refOffre'=>$_POST['id_offre']
    ));

    $LesRDV = $rdv->creationRDV($bdd);

    echo "<script>
        window.location.href = \"../../view/rdv/organiserRDV\";
        alert(\"RDV enregistré\")
        </script>";
} else{
    echo "<script>
        window.location.href = \"../../view/rdv/organiserRDV\";
        alert(\"Erreur\")
        </script>";
}

?>
