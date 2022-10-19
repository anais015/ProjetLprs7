<?php
session_start();
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";
require_once "../../model/evenement/Evenement.php";

$erreur=false;
$organiser=false;

$cnx = new Bdd();
$bdd = $cnx->getBdd();
//var_dump($_SESSION['etudiant']['id_etudiant']);
if (isset($_POST['enregistrer'])){
    $event = new Evenement(array(
        'nom'=> $_POST['nom'],
        'description'=> $_POST['description'],
        'date'=> $_POST['date'],
        'heure'=> $_POST['debut'],
        'duree'=> $_POST['duree'],
        'ref_etudiant'=>$_SESSION['etudiant']['id_etudiant']
    ));
    //var_dump($event);
    $organiser=$event->etudiantOrganiseEvenement($bdd);
    if (!$organiser) $erreur=true;
    //var_dump($organiser);
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
</head>
<body>
<nav>
    <div class="bottom-row">
        <a href="accueil.php">Accueil</a>
        <a href="trouverJob.php">Trouver un job</a>
        <a href="trouverEvenement.php">Trouver un événement</a>
        <a href="organizerEvenement.php">Organizer un événement</a>
        <a href="#">Contact</a>

        <a href="listeEvenement.php">Mes événements</a>
        <a href="candidature.php">Mes candidatures</a>
        <a href="rdv.php">Mes rendez-vous</a>
        <a href="monCompte.php">Mon compte</a>
        <a href="deconnexion.php">Se déconnecter</a>
    </div>
</nav>

<div class="container">
    <div class="container" id="alert"
    <?php
        if (!$erreur) echo 'style="display:none;"';
        else echo 'style="display:block; background-color:#f8bdc1; text-align: center"';
    ?>
    <input type="hidden"> &#9888; Erreur : Vous avez déjà créé un événement à ces heures. Veuillez créer un autre.
</div>
<div class="container" id="alert"
    <?php
        if (!$organiser) echo 'style="display:none;"';
        else echo 'style="display:block; background-color:#D3DEA5; text-align: center"';
    ?>>
    <input type="hidden"> &#10003; Reussite

</div>
<div  <?php if ($organiser) echo 'style="display:none;"';?>>
    <form action='' method='POST'>
        <label for='nom'><b>Nom de l'événement </b></label>
        <input type='text' placeholder="Nom de l'événement" name='nom'  required>

        <label for='description'><b>Description</b></label>
        <input type="text" name='description' placeholder="Description" required>

        <label for='date'><b>Date</b></label>
        <input type='date' placeholder='Date' name='date' required>

        <label for='debut'><b>Heure de début</b></label>
        <input type='time' placeholder='Heure de début' name='debut' required>

        <label for='duree'><b>Durée</b></label>
        <input type='time' placeholder='Durée' name='duree' required>

        <input type='submit' value="Enregistrer" name='enregistrer' id='enregistrer'>
</div>

</form>
</body>
</html>

