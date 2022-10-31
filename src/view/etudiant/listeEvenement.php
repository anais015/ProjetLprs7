<?php
session_start();
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";
require_once "../../model/evenement/Evenement.php";

$cnx = new Bdd();
$bdd = $cnx->getBdd();
$tbHistorique='';
$tbOrganiser='';
$tbParticiper='';
$etat='';
$salle='';
$hidden='';

$event=new Evenement(array('ref_etudiant'=>$_SESSION['etudiant']['id_etudiant']));
$historique=$event->historique($bdd);
foreach ($historique as $value){
     $tbHistorique .="<tr>
                        <td>".$value['nom']."</td>
                        <td>".$value['date']."</td>
                        <td>".$value['heure']."</td>
                        <td><form action='../../traitement/evenement/traitementSuppression.php' method='post'>
                            <button name='supprimer' value='".$value['id_evenement']."'>Supprimer</button>
                            </form>
                        </td>
                    </tr>";

}
//$listParticiper= $event->listEventParticiper($bdd);
//foreach ($listParticiper as $value){
//    $tbParticiper .="<tr>
//                        <td>".$value[1]."</td>
//                        <td>".$value['description']."</td>
//                        <td>".$value['date']."</td>
//                        <td>".$value['heure']."</td>
//                        <td>".$value['duree']."</td>
//                        <td>".$value['salle']."</td>
//                        <td>
//                            <form action='../../traitement/evenement/traitementSuppression.php' method='post'>
//                                <button name='annuler' value='".$value['id_evenement']."'>Annuler</button>
//                            </form>
//                        </td>
//                    </tr>";
//}

$listOrganise= $event->listEventOrganise($bdd);
//var_dump($listOrganise);
foreach ($listOrganise as $value){
    if ($value['valide']==0) {
        $hidden='';
        $etat = 'En attente';
    } else {
        $hidden='hidden';
        $etat='Validé';
    }
    if (is_null($value['nom'])) $salle = 'En attente';
    else $salle=$value['nom'];
    $date=explode(" ",$value['debut']);
    $heurefin=explode(" ",$value['fin']);
    $tbOrganiser .="<tr>
                        <td>".$value['nom_event']."</td>
                        <td>".$date[0]."</td>
                        <td>".$date[1]."</td>
                        <td>".$heurefin[1]."</td>
                        <td>".$salle."</td>
                        <td>".$etat."</td>
                        <td>
                            <form action='modifierEvenement.php' method='GET'>
                                <button name='modifier' value='".$value['id_evenement']."' ".$hidden.">Modifier</button>
                            </form>
                            <form action='../../traitement/evenement/traitementSuppression.php' method='post'>
                                <button name='annuler' value='".$value['id_evenement']."' ".$hidden.">Annuler</button>
                            </form>
                        </td>
                    </tr>";
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
<h2>Événement</h2>

<div class="tab">
    <button class="tablinks" onclick="openTab(event, 'À organiser')">À organiser</button>
    <button class="tablinks" onclick="openTab(event, 'À participer')">À participer</button>
    <button class="tablinks" onclick="openTab(event, 'Historique')">Historique</button>
</div>

<div id="À organiser" class="tabcontent">
    <h3>Événement à organiser</h3>
    <table>
        <tr>
            <th>Titre du événement</th>
            <th>Date</th>
            <th>Heure de début</th>
            <th>Heure de fin</th>
            <th>Salle</th>
            <th>État</th>
            <th>Action</th>
        </tr>
        <?=$tbOrganiser?>
    </table>
</div>

<div id="À participer" class="tabcontent">
    <h3>Événement à participer</h3>
    <table>
        <tr>
            <th>Titre du événement</th>
            <th>Description</th>
            <th>Date</th>
            <th>Heure de début</th>
            <th>Heure de fin</th>
            <th>Salle</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>Alfreds Futterkiste</td>
            <td>ENGIE</td>
            <td>20-10-2022</td>
            <td>10:00</td>
            <td>2:00</td>
            <td>Germany</td>
            <td><button>Annuler</button></td>
        </tr>
    </table>
</div>

<div id="Historique" class="tabcontent">
    <h3>Historique</h3>
    <table>
        <tr>
            <th>Titre du événement</th>
            <th>Date</th>
            <th>Heure de début</th>
            <th>Heure de fin</th>
            <th>Action</th>
        </tr>
        <?=$tbHistorique;?>
    </table>
</div>

<script>
    function openTab(evt, eventType) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(eventType).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>

</body>
</html>
