<?php

session_start();

require_once "../../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/offre/Offre.php";
require_once "../../model/bdd/Bdd.php";

$connexion = new Bdd();
$bdd = $connexion->getBdd();
if(isset($_POST['supprimerOffre'])){

    $offre = new Offre(array(
        'id'=>$_POST['id_offre']
    ));

    $supp = $offre->entrepriseSupprimerOffre($bdd);

    echo "<script>
        window.location.href = \"../../view/offre/supprimerOffre.php\";
        alert(\"Suppression effectuée !\")
        </script>";

} else {
    echo "<script>
        window.location.href = \"../../view/offre/supprimerOffre.php\";
        alert(\"Echec de la suppression !\")
         </script>";
}
?>
