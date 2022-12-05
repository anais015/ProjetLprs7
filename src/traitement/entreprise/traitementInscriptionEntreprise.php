<?php
require_once "../../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
require_once "../../model/Mail.php";
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/bdd/Bdd.php";

$connexion = new Bdd();
$bdd = $connexion->getBdd();
$mail = new Mail();

//var_dump($_POST);die();

if(isset($_POST['inscription'])) {
    $entreprise = new Entreprise(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'nom_entreprise' => $_POST['nom_entreprise'],
        'rue_entreprise' => $_POST['rue_entreprise'],
        'ville_entreprise' => $_POST['ville_entreprise'],
        'cp_entreprise' => $_POST['cp_entreprise'],
        'email' => $_POST['email'],
        'mot_de_passe' => $_POST['password'],
        'role_societe' => $_POST['role_societe']
    ));

    $ins = $entreprise->inscription($bdd);
    echo "Inscription effectuée !";
    header('Location: ../../../index.php');
    $mail->sendMail($_POST['email'],"Bienvenue sur LPRS!","Votre inscription d'entreprise à bien été éffectué et un administrateur doit validé votre compte avant de pouvoir vous connecter!<br><br>Le service LPRS");

} else {
    echo "la valeur n'existe pas ! ";
    header('Location: ../../view/inscription.php');
}
?>
