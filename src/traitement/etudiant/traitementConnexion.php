<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";

$cnx = new Bdd();
$bdd = $cnx->getBdd();
//var_dump($_POST);

if(isset($_POST['connexion'])) {
//    $password = $_POST['password'];
//    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $etudiant = new Etudiant(array(
        'email' => $_POST['email'],
//        'mot_de_passe' => $hashed_password
    ));
    var_dump($etudiant);
    $connexion=$etudiant->connexion($bdd,$_POST['password']);
    var_dump($connexion);
//    if (!$inscription) $erreur=true;
//    var_dump($erreur);
}