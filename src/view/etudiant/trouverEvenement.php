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
    $debut=explode(" ",$value['debut']);
    $date=$debut[0];
    $heurre_debut=$debut[1];
    $fin=explode(" ",$value['fin']);
    $heurre_fin=$fin[1];
    $tbRechercheEvent .="<tr>
                        <td>".$value['nom_event']."</td>
                        <td>".$value['description']."</td>
                        <td>".$date."</td>
                        <td>".$heurre_debut."</td>
                        <td>".$heurre_fin."</td>
                        <td>".$value['nom']."</td>
                        <td>
                            <form action='' method='POST'>
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
<h2>Liste d'événement</h2>
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
        <?= $tbRechercheEvent ?>
    </table>
</body>

</html>
