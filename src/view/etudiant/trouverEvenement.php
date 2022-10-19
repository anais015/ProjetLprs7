<?php

session_start();
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";
require_once "../../model/evenement/Evenement.php";

$cnx = new Bdd();
$bdd = $cnx->getBdd();

$tbRechercheEvent = '';
$etat = '';
$salle = '';
$event = new Evenement(array('ref_etudiant' => $_SESSION['etudiant']['id_etudiant']));

$listeRechercheEvent= $event->listRechercheEvent($bdd);
//var_dump($listeRechercheEvent);
foreach ($listeRechercheEvent as $value){
    $tbRechercheEvent .="<tr>
                        <td>".$value[1]."</td>
                        <td>".$value['description']."</td>
                        <td>".$value['date']."</td>
                        <td>".$value['heure']."</td>
                        <td>".$value['duree']."</td>
                        <td>".$value[6]."</td>
                        <td>
                            <form action='' method='post'>
                                <button name='participer' value='".$value['id_evenement']."'>Participer</button>
                            </form>
                        </td>
                    </tr>";
}

if(isset($_POST['participer'])){
    $event=new Evenement(array(
        'id'=> $_POST['participer'],
        'ref_etudiant'=> $_SESSION['etudiant']['id_etudiant']
    ));

    var_dump($event);
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
<h2>Chercher un Événement</h2>
    <table>
        <tr>
            <th>Titre du événement</th>
            <th>Description</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Durée</th>
            <th>Salle</th>
            <th>Action</th>
        </tr>
        <?= $tbRechercheEvent ?>
    </table>
</body>
<!--SELECT `nom`, `date`,`heure`, ADDTIME(`heure`,`duree`) AS fin FROM evenement;-->
<!--CREATE TRIGGER `event_duplicate_insert` BEFORE INSERT ON `evenement`-->
<!--FOR EACH ROW-->
<!--BEGIN-->
<!--IF EXISTS (SELECT `heure`, ADDTIME(`heure`,`duree`) FROM evenement WHERE `heure` <= NEW.`heure` AND ADDTIME(`heure`,`duree`) > ADDTIME(NEW.`heure`,NEW.`duree`)) THEN-->
<!--SIGNAL SQLSTATE '45000'-->
<!--SET MESSAGE_TEXT = 'An error occurred';-->
<!--END IF;-->

</html>
