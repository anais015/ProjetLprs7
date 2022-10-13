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
//var_dump($_SESSION['etudiant']['id_etudiant']);
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
        <a href="../../index.php">Accueil</a>
        <a href="trouverJob.php">Trouver un job</a>
        <a href="trouverEvenement.php">Trouver un événement</a>
        <a href="organizerEvenement.php">Organizer un événement</a>
        <a href="#">Contact</a>

        <a href="listeEvenement.php">Mes événement</a>
        <a href="candidature.php">Mes candidatures</a>
        <a href="rdv.php">Mes rendez-vous</a>
        <a href="monCompte.php">Mon compte</a>
        <a href="deconnexion.php">Se déconnecter</a>
    </div>
</nav>

<form action='' method='POST'>
    <fieldset>
        <legend>Information personnelle</legend>
        <label for='nom'><b>Nom</b></label>
        <input type='text' placeholder='Nom' name='nom' value="" required>

        <label for='prenom'><b>Prénom</b></label>
        <input type='text' placeholder='Prénom' name='prenom' value="" required>

        <label for='domaine'><b>Domaine</b></label>
        <input type='text' placeholder="Domaine d'étude" name='domaine' value="" required>
        <input type='submit' name='modifierInfo' value="Modifier" id='modifierInfo'>
    </fieldset>
    <fieldset>
        <legend>Email</legend>
        <label for='email'><b>Email</b></label>
        <input type='email' placeholder='Email' name='email' value="" required>
        <input type='submit' name='modifierEmail' value="Modifier email" id='modifierEmail'>
    </fieldset>
    <fieldset>
        <legend>Mot de passe</legend>
        <label for='oldPassword'><b>Ancien mot de passe</b></label>
        <input type='password' placeholder='Ancien mot de passe' name='oldPassword' required>
        <label for='newPassword'><b>Nouveau mot de passe</b></label>
        <input type='password' placeholder='Nouveau mot de passe' name='newPassword' required>
        <input type='submit' name='modifierPw' value="Modifier mot de passe" id='modifierPw'>
    </fieldset>

</form>
</body>
</html>
