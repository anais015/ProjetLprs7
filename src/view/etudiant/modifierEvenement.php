<?php
session_start();
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";
require_once "../../model/evenement/Evenement.php";

$cnx = new Bdd();
$bdd = $cnx->getBdd();
$erreur = false;
$nom=''; $date=''; $description=''; $heure=''; $duree=''; $id='';
//var_dump($_POST);
if(isset($_POST['modifier'])){
    $event=new Evenement(array('id'=>$_POST['modifier']));
//    var_dump($event);
    $selectedEvent = $event->selectParId($bdd);
    $id=$_POST['modifier'];
    $nom=$selectedEvent['nom'];
    $description=$selectedEvent['description'];
    $date=$selectedEvent['date'];
    $heure=$selectedEvent['heure'];
    $duree=$selectedEvent['duree'];
    //    var_dump($selectedEvent);
}
if(isset($_POST['enregistrer'])){
    //var_dump($_POST);
    $event = new Evenement(array(
        'nom'=> $_POST['nom'],
        'description'=>$_POST['description'],
        'date'=> $_POST['date'],
        'heure'=> $_POST['heure'],
        'duree'=> $_POST['duree'],
        'id'=>$_POST['id']
    ));
    //var_dump($event);
    $modifiedEvent=$event->modifierEvenement($bdd);
    //var_dump($modifiedEvent);
    $nom=$event->getNom();
    $description=$event->getDescription();
    $date=$event->getDate();
    $heure=$event->getHeure();
    $duree=$event->getDuree();
    if (!$modifiedEvent) $erreur=true;
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
<h2>Modifier un événement</h2>
<div class="container" id="alert"
<?php
if (!$erreur) echo 'style="display:none;"';
else echo 'style="display:block; background-color:#f8bdc1; text-align: center"';
?>
<input type="hidden"> &#9888; Erreur : Votre modification a échouée.
</div>
<div class="container" id="alert"
    <?php
    if (!$modifiedEvent) echo 'style="display:none;"';
    else echo 'style="display:block; background-color:#D3DEA5; text-align: center"';
    ?>>
    <input type="hidden"> &#10003; Evenement modifié

</div>

<div>
<form action='' method='POST'>
    <input type='hidden' name='id' value="<?=$id?>">

    <label for='nom'><b>Nom de l'événement </b></label>
    <input type='text' placeholder="Nom de l'événement" name='nom' value="<?=$nom?>" required>

    <label for='description'><b>Description</b></label>
    <input type='text' placeholder='Description' name='description' value="<?=$description?>" required>
<!--        <textarea rows="5" cols="33" name='description' placeholder="Description" value="--><?//=$selectedEvent['description']?><!--" required></textarea>-->

    <label for='date'><b>Date</b></label>
    <input type='date' placeholder='Date' name='date' value="<?=$date?>" required>

    <label for='debut'><b>Heure de début</b></label>
    <input type='time' placeholder='Heure de début' name='heure' value="<?=$heure?>" required>

    <label for='duree'><b>Durée</b></label>
    <input type='time' placeholder='Durée' name='duree' value="<?=$duree?>" required>

    <input type='submit' value="Enregistrer" name='enregistrer' id='enregistrer'>
</form>
</div>
</body>
</html>