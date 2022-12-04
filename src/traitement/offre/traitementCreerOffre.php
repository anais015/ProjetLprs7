<?php

session_start();

require_once "../../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/offre/Offre.php";
require_once "../../model/bdd/Bdd.php";

$connexion = new Bdd();
$bdd = $connexion->getBdd();

if(isset($_POST['creerOffre'])) {

$offre = new Offre(array(
    'titre'=> $_POST['titre'],
    'description'=> $_POST['description'],
    'domaine'=>$_POST['domaine'],
    'refType'=>$_POST['type'],
    'ref_entreprise'=>$_SESSION['entreprise']['id_entreprise']
));
var_dump($offre);
$uneoffre = $offre->entrepriseCreerOffre($bdd);

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