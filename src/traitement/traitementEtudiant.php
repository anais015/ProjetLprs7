<?php
require_once "../model/bdd/Bdd.php";
require_once "../model/Utilisateur.php";
require_once "../model/etudiant/Etudiant.php";

//$logIn=true;
$cnx = new Bdd();
$bdd = $cnx->getBdd();

if(isset($_POST['inscription'])) {
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $etudiant = new Etudiant(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'mot_de_passe' => $hashed_password,
        'domaine_etude' => $_POST['domaine']
    ));
    var_dump($etudiant);
    $inscription=$etudiant->inscription($bdd);
    var_dump($inscription);
}
?>
