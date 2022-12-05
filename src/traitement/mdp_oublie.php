<?php
session_start();
require_once "../model/bdd/Bdd.php";
require_once "../model/Utilisateur.php";
require_once "../model/etudiant/Etudiant.php";
require_once "../model/entreprise/Entreprise.php";
require_once "../model/administrateur/Administrateur.php";

$cnx = new Bdd();
$bdd = $cnx->getBdd();
var_dump($_POST);

?>
