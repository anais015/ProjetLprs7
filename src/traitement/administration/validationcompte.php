<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/entreprise/Entreprise.php";
$bdd = new Bdd();

if(isset($_POST['id_etudiant'])) {
    $etudiant = new Etudiant(array(
        'id' => $_POST['id_etudiant'],
    ));
    $etudiant->validerCompte($bdd);
}
if(isset($_POST['id_entreprise'])) {
    $entreprise = new Entreprise(array(
        'id' => $_POST['id_entreprise'],
    ));
    $entreprise->validerCompte($bdd);
}
?>