<?php
session_start();
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/Connexion.php";
require_once "../../model/evenement/Evenement.php";
if (isset($_GET['candidats'])){
    $array=json_decode($_GET['candidats'],true);
    $listePostule=new Postule(array(
        'id'=>$array['id_evenement'],
        'nom'=>$array['nom_event'],
        'description'=>$array['description'],
        'debut'=>$array['debut'],
        'fin'=>$array['fin'],
        'ref_entreprise'=>$array['ref_entreprise']
    ));
}

?>