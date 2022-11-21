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
$listParticiper= $event->listeEventParticipe($bdd);
if (!$listParticiper) $tbParticiper= "<tr><td colspan='7'>Vous n'avez aucun evenement à participer</td></td>";
else {
    foreach ($listParticiper as $value){
        $debut=explode(" ",$value['debut']);
        $fin=explode(" ",$value['fin']);
        $tbParticiper .="<tr>
                        <td>".$value['nom_event']."</td>
                        <td>".$value['description']."</td>
                        <td>".$debut[0]."</td>
                        <td>".$debut[1]."</td>
                        <td>".$fin[1]."</td>
                        <td>".$value['nom']."</td>
                        <td>
                            <form action='' method='post'>
                                <button name='desinscrire' value='".$value['ref_evenement']."'>Se désinscrire</button>
                            </form>
                        </td>
                    </tr>";
    }
}


$listOrganise= $event->listEventOrganise($bdd);
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
                            <form action='../../traitement/evenement/traitementSuppression.php' method='POST'>
                                <button name='annuler' value='".$value['id_evenement']."' ".$hidden.">Annuler</button>
                            </form>
                        </td>
                    </tr>";
}

if(isset($_POST['desinscrire'])){
    $event = new Evenement(array('id'=> $_POST['desinscrire']));
    $etudiant = new Etudiant(array('id'=>$_SESSION['etudiant']['id_etudiant']));
    $desincription=$etudiant->desinscrire($bdd,$event);
    if ($desincription) {
        echo '<script>alert("Vous vous êtes désinscrit au évenement")</script>';
        header("location:listeEvenement.php");
    } else echo '<script>alert("Erreur")</script>';
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
        <?=$tbParticiper?>
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
