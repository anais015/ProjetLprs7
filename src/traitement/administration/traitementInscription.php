<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/administrateur/Administrateur.php";

$erreur=false;

$cnx = new Bdd();
$bdd = $cnx->getBdd();

if(isset($_POST['inscription'])) {
    $admin = new Administrateur(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'mot_de_passe' => $_POST['password'],
        'domaine_etude' => $_POST['domaine']
    ));
  var_dump($admin);
    $inscription=$admin->inscription($bdd);
    var_dump($inscription);
    if (!$inscription) $erreur=true;
    var_dump($erreur);
}
?>