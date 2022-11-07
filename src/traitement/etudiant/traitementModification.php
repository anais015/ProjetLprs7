<?php
session_start();
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";
require_once "../../model/evenement/Evenement.php";

$erreur=false;
$modifie=false;

$cnx = new Bdd();
$bdd = $cnx->getBdd();
var_dump($_POST);

$etudiant = new Etudiant(array('id'=>$_SESSION['etudiant']['id_etudiant']));
$selectedEtudiant=$etudiant->selectParId($bdd);

if (isset($_POST['modifierInfo'])){
    $etudiant = new Etudiant(array(
        'nom'=> $_POST['nom'],
        'prenom'=> $_POST['prenom'],
        'domaine_etude'=> $_POST['domaine'],
        'id'=>$_SESSION['etudiant']['id_etudiant']
    ));
    $modifierInfo=$etudiant->modifierInfo($bdd);
    if (!$modifierInfo) $erreur=true;
    else $modifie=true;
}
if (isset($_POST['modifierEmail'])){
    $etudiant = new Etudiant(array(
        'email'=>$_POST['email'],
        'id'=>$_SESSION['etudiant']['id_etudiant']
    ));
    $modifierEmail=$etudiant->modifierEmail($bdd,$_POST['pw']);
    if (!$modifierEmail) $erreur=true;
    else $modifie=true;
}
if (isset($_POST['modifierPw'])){
    $password = $_POST['new'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $etudiant = new Etudiant(array(
        'mot_de_passe'=> $hashed_password,
        'id'=>$_SESSION['etudiant']['id_etudiant']
    ));
    var_dump($etudiant);
    $modifierPw=$etudiant->modifierPw($bdd,$_POST['old']);
    if (!$modifierPw) $erreur=true;
    else $modifie=true;
    var_dump($modifierPw);
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon Compte</title>
</head>
<body>
<nav>
    <div class="bottom-row">
        <a href="../../view/etudiant/accueil.php">Accueil</a>
        <a href="../../view/etudiant/trouverJob.php">Chercher un job</a>
        <a href="../../view/etudiant/trouverEvenement.php">Chercher un événement</a>
        <a href="../../view/etudiant/organizerEvenement.php">Organizer un événement</a>
        <a href="#">Contact</a>

        <a href="../../view/etudiant/listeEvenement.php">Mes événement</a>
        <a href="../../view/etudiant/candidature.php">Mes candidatures</a>
        <a href="../../view/etudiant/rdv.php">Mes rendez-vous</a>
        <a href="../../view/etudiant/monCompte.php">Mon compte</a>
        <a href="../../view/etudiant/deconnexion.php">Se déconnecter</a>
    </div>
</nav>
<div class="container">
    <div class="container" id="alert"
    <?php
    if (!$erreur) echo 'style="display:none;"';
    else echo 'style="display:block; background-color:#f8bdc1; text-align: center"';
    ?>
    <input type="hidden"> &#9888; Erreur.
    <a href="../../view/etudiant/monCompte.php">Revenir à la page précédente</a>
</div>
<div class="container" id="alert"
    <?php
    if (!$modifie) echo 'style="display:none;"';
    else echo 'style="display:block; background-color:#D3DEA5; text-align: center"';
    ?>
    <input type="hidden"> &#10003; Reussite : Votre compte a été mise à jour.
    <a href="../../view/etudiant/monCompte.php">Revenir à la page précédente</a>

</div>
</body>
</html>

