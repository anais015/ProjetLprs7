<?php
require_once "../model/entreprise/Entreprise.php";
require_once "../model/bdd/Bdd.php";

$bdd = new Bdd();

$entreprise = new Entreprise(array(
    'nom'=> $_POST['nom'],
    'prenom'=> $_POST['prenom'],
    'nom_entreprise'=> $_POST['nom_entreprise'],
    'rue_entreprise'=> $_POST['rue_entreprise'],
    'ville_entreprise' => $_POST['ville_entreprise'],
    'cp_entreprise' => $_POST['cp_entreprise'],
    'email'=> $_POST['email'],
    'mot_de_passe'=> $_POST['mot_de_passe'],
    'role_societe' => $_POST['role_societe']
));
