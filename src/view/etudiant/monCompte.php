<?php
session_start();
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";
require_once "../../model/evenement/Evenement.php";

$cnx = new Bdd();
$bdd = $cnx->getBdd();

$etudiant = new Etudiant(array('id'=>$_SESSION['etudiant']['id_etudiant']));
$selectedEtudiant=$etudiant->selectParId($bdd);

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

<h2>Mon Compte</h2>

<form action='../../traitement/etudiant/traitementModification.php' method='POST'>
    <fieldset>
        <legend>Information Personnelle</legend>
        <div>
            <label for='nom'><b>Nom</b></label>
            <input type='text' placeholder='Nom' name='nom' value="<?=$selectedEtudiant['nom'];?>" >
        </div>
        <div>
            <label for='prenom'><b>Prénom</b></label>
            <input type='text' placeholder='Prénom' name='prenom' value="<?=$selectedEtudiant['prenom'];?>" >
        </div>
        <div>
            <label for='domaine'><b>Domaine</b></label>
            <input type='text' placeholder="Domaine d'étude" name='domaine' value="<?=$selectedEtudiant['domaine_etude'];?>" >
        </div>
            <input type='submit' name='modifierInfo' id='modifierInfo' value="Modifier">
    </fieldset>
    <fieldset>
        <legend>Email</legend>
        <div>
            <label for='email'><b>Email</b></label>
            <input type='email' placeholder='Email' name='email' >
        </div>
        <div>
            <label for='pw'><b>Mot de passe</b></label>
            <input type='password' placeholder='Saisissez votre mot de passe pour changer votre adresse email' name='pw' >
        </div>
            <input type='submit' name='modifierEmail' id='modifierEmail' value="Modifier Email">
    </fieldset>
    <fieldset>
        <legend>Mot de passe</legend>
        <div>
            <label for='old'><b>Ancien mot de passe</b></label>
            <input type='password' placeholder='Ancien mot de passe' name='old' >
        </div>
        <div>
            <label for='new'><b>Nouveau mot de passe</b></label>
            <input type='password' placeholder='Nouveau mot de passe' name='new' >
        </div>
            <input type='submit' name='modifierPw' id='modifierPw' value="Modifier Mot de passe">
    </fieldset>
</form>
</body>
</html>
