<?php

session_start();

require_once "../../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/offre/Offre.php";
require_once "../../model/bdd/Bdd.php";

$connexion = new Bdd();
$bdd = $connexion->getBdd();

if(isset($_POST['modifierOffre'])) {

    $offre = new Offre(array(
        'titre'=> $_POST['titre'],
        'description'=> $_POST['description'],
        'domaine'=>$_POST['domaine'],
        'refType'=>$_POST['type'],
        ));
    var_dump($offre);
    $uneoffre = $offre->entrepriseModifierOffre($bdd);

    echo "<script>
        window.location.href = \"../../view/offre/creerOffre.php\";
        alert(\"Création effectuée !\")
        </script>";

} else {
    echo "<script>
        window.location.href = \"../../view/offre/creerOffre.php\";
        alert(\"Echec de la création !\")
         </script>";
}
?>