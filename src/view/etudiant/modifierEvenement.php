<?php
session_start();
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";
require_once "../../model/evenement/Evenement.php";

$cnx = new Bdd();
$bdd = $cnx->getBdd();
$nom = '';
$debut = '';
$description = '';
$fin = '';
$id = '';
$hidden = '';
$modifiedEvent = false;
$erreur = false;
//var_dump($_POST);
if (isset($_GET['modifier'])) {
    $event = new Evenement(array('id' => $_GET['modifier']));
//    var_dump($event);
    $selectedEvent = $event->selectParId($bdd);
    $id = $selectedEvent->getId();
    $nom = $selectedEvent->getNom();
    $description = $selectedEvent->getDescription();
    $debut = $selectedEvent->getDebut();
    $fin = $selectedEvent->getFin();
} else $hidden = 'style="display:none"';

if (isset($_POST['enregistrer'])) {
//    var_dump($_POST);
    $event = new Evenement(array(
        'nom' => $_POST['nom'],
        'description' => $_POST['description'],
        'debut' => $_POST['debut'],
        'fin' => $_POST['fin'],
        'id' => $_POST['id']
    ));
//    var_dump($event);
    $modifiedEvent = $event->modifierEvenement($bdd);
    $selectedEvent = $event->selectParId($bdd);
    $id = $selectedEvent->getId();
    $nom = $selectedEvent->getNom();
    $description = $selectedEvent->getDescription();
    $debut = $selectedEvent->getDebut();
    $fin = $selectedEvent->getFin();
//    var_dump($modifiedEvent);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body>
<nav>
    <div class="bottom-row">
        <a href="accueil.php">Accueil</a>
        <a href="trouverJob.php">Chercher un job</a>
        <a href="trouverEvenement.php">Chercher un événement</a>
        <a href="organizerEvenement.php">Organizer un événement</a>
        <a href="#">Contact</a>

        <a href="listeEvenement.php">Mes événements</a>
        <a href="candidature.php">Mes candidatures</a>
        <a href="rdv.php">Mes rendez-vous</a>
        <a href="monCompte.php">Mon compte</a>
        <a href="deconnexion.php">Se déconnecter</a>
    </div>
</nav>
<h2>Modifier un événement</h2>
<div>
    <div>
        <div class="container" id="alert"
        <?php
        if (!$erreur) echo 'style="display:none;"';
        else echo 'style="display:block; background-color:#f8bdc1; text-align: center"';
        ?>
        <input type="hidden"> &#9888; Erreur : Votre modification n'a pas été prise en compte.
    </div>
    <div class="container" id="alert"
    <?php
    if (!$modifiedEvent) echo 'style="display:none;"';
    else echo 'style="display:block; background-color:#D3DEA5; text-align: center"';
    ?>
    <input type="hidden"> &#10003; Événement mis à jour.
    <a href="../../view/etudiant/listeEvenement.php">Revenir à la liste d'événement</a>
</div>

<div <?= $hidden; ?>>
    <form action='' method='POST'>
        <input type='hidden' name='id' value="<?= $id; ?>">

        <label for='nom'><b>Nom de l'événement </b></label>
        <input type='text' placeholder="Nom de l'événement" name='nom' value="<?= $nom; ?>" required>

        <label for='description'><b>Description</b></label>
        <input type="text" name='description' placeholder="Description" value="<?= $description; ?>" required>

        <label for='debut'><b>Début</b></label>
        <input type='datetime-local' placeholder='Heure de début' name='debut' value="<?= $debut; ?>" required>

        <label for='fin'><b>Fin</b></label>
        <input type='datetime-local' placeholder='Heure de fin' name='fin' value="<?= $fin; ?>" required>

        <input type='submit' value="Enregistrer" name='enregistrer' id='enregistrer'>
    </form>
</div>

</div>
</body>
</html>