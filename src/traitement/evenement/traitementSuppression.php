<?php
session_start();
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";
require_once "../../model/evenement/Evenement.php";

$cnx = new Bdd();
$bdd = $cnx->getBdd();
$h2=''; $msg='';
$supprimer=false;
$annuler=false;
$erreur=false;

//var_dump($_POST);
if(isset($_POST['annuler'])){
    $h2='Annuler un événement';
    $event = new Evenement(array(
        'id'=>$_POST['annuler']
    ));
    $annuler=$event->supprimerEvenement($bdd);
//    var_dump($annuler);
    if($annuler) $msg='Événement annulé';
    else $msg="Erreur : Votre annulation n'a pas été prise en compte.";

}
if(isset($_POST['supprimer'])){
    $h2='Supprimer un événement';
    $event = new Evenement(array(
        'id'=>$_POST['supprimer']
    ));
    $supprimer=$event->supprimerEvenement($bdd);
//    var_dump($supprimer);
    if($supprimer) $msg='Événement supprimé';
    else $msg="Erreur : Votre suppression n'a pas été prise en compte.";

}
?><!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body>
<nav>
    <div class="bottom-row">
        <a href="../../view/etudiant/accueil.php">Accueil</a>
        <a href="../../view/etudiant/trouverJob.php">Trouver un job</a>
        <a href="../../view/etudiant/trouverEvenement.php">Trouver un événement</a>
        <a href="../../view/etudiant/organizerEvenement.php">Organizer un événement</a>
        <a href="#">Contact</a>

        <a href="../../view/etudiant/listeEvenement.php">Mes événement</a>
        <a href="../../view/etudiant/candidature.php">Mes candidatures</a>
        <a href="../../view/etudiant/rdv.php">Mes rendez-vous</a>
        <a href="../../view/etudiant/monCompte.php">Mon compte</a>
        <a href="../../view/etudiant/deconnexion.php">Se déconnecter</a>
    </div>
</nav>
<h2><?=$h2;?></h2>

<div>
    <div>
        <div class="container" id="alert"
        <?php
        if (!$erreur) echo 'style="display:none;"';
        else echo 'style="display:block; background-color:#f8bdc1; text-align: center"';
        ?>
        <input type="hidden"> &#9888; <?=$msg;?>
        <a href="../../view/etudiant/listeEvenement.php">Revenir à la liste d'événement</a>
    </div>
    <div class="container" id="alert"
    <?php
    if (!$annuler) echo 'style="display:none;"';
    if ($annuler) echo 'style="display:block; background-color:#D3DEA5; text-align: center"';
    if (!$supprimer) echo 'style="display:none;"';
    if ($supprimer) echo 'style="display:block; background-color:#D3DEA5; text-align: center"';
    ?>
    <input type="hidden"> &#10003; <?=$msg;?>
    <a href="../../view/etudiant/listeEvenement.php">Revenir à la liste d'événement</a>
</div>

</body>
</html>
