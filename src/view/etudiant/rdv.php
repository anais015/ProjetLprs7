<?php

session_start();
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";
require_once "../../model/offre/Offre.php";
require_once "../../model/rdv/Rdv.php";

$cnx = new Bdd();
$bdd = $cnx->getBdd();
$statut='';
$style='';
$message1='';
$message2='';

$tblisteRdvs = '';
$tblisteHistoriques = '';

if(isset($_POST['accepter'])){
    $rdv=new Rdv(array(
        'id'=> $_POST['accepter'],
        'refEtudiant'=> $_SESSION['etudiant']['id_etudiant']
    ));
    $accepter = $rdv->accepterRdv($bdd);
}

if(isset($_POST['decliner'])){
    $rdv=new Rdv(array(
        'id'=> $_POST['decliner'],
        'refEtudiant'=> $_SESSION['etudiant']['id_etudiant']
    ));
    $decliner = $rdv->declinerRdv($bdd);
}

$rdv= new Rdv(array('refEtudiant' => $_SESSION['etudiant']['id_etudiant']));
//var_dump($_SESSION['etudiant']['id_etudiant']);
//var_dump($etudiant);
$liste_rdvs=$rdv->listeRdv($bdd);
//var_dump($liste_rdvs);
if (empty($liste_rdvs)) $message1 = "Aucun rendez-vous à venir";
else {
    foreach ($liste_rdvs as $value){
        if (!is_null($value['accepte'])) {
            $style="style='display: none'";
            if (!$value['accepte']) $statut="Décliné";
            else $statut = "Accepté";
        }
        else $style="style='display: block'";

        $date=explode(" ",$value['horaire'])[0];
        $heure=explode(" ",$value['horaire'])[1];

        $tblisteRdvs .="<tr>
                        <td>".$value['titre']."</td>
                        <td>".$value['nom_entreprise']."</td>
                        <td>$date</td>
                        <td>$heure</td>
                        <td>".$value['description']."</td>
                        <td>".$value['domaine']."</td>
                        <td>".$value['nom_type']."</td>
                        <td>".$value['lieux']."</td>
                        <td>$statut</td>
                        <td>
                             <form action='' method='POST'>
                                <button name='accepter' value='".$value['id_rdv']."' ".$style.">Accepter</button>
                                <button name='decliner' value='".$value['id_rdv']."' ".$style.">Décliner</button>
                            </form>
                        </td>
                    </tr>";
    }
}

$liste_historiques=$rdv->historiqueRdv($bdd);
//var_dump($liste_historiques);
if (empty($liste_historiques))$message2 = "Aucun rendez-vous passé";
else {
    foreach ($liste_historiques as $value){
        if (is_null($value['accepte'])) $statut="--";
        elseif (!$value['accepte']) $statut="Décliné";
        else $statut = "Accepté";
        $date=explode(" ",$value['horaire'])[0];
        $heure=explode(" ",$value['horaire'])[1];

        $tblisteHistoriques .="<tr>

                        <td>".$value['titre']."</td>
                        <td>".$value['nom_entreprise']."</td>
                        <td>$date</td>
                        <td>$heure</td>
                        <td>".$value['description']."</td>
                        <td>".$value['domaine']."</td>
                        <td>".$value['nom_type']."</td>
                        <td>".$value['lieux']."</td>
                        <td>$statut</td>
                        <td>
                             <form action='' method='POST'>
                                <button name='accepter' value='".$value['id_rdv']."'>Accepter</button>
                                <button name='decliner' value='".$value['id_rdv']."'>Décliner</button>
                            </form>
                        </td>
                    </tr>";
    }
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
    <h2>Mes rendez-vous</h2>

    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'À venir')">À venir</button>
        <button class="tablinks" onclick="openTab(event, 'Historique')">Historique</button>
    </div>

    <div id="À venir" class="tabcontent">
        <h3>Rendez-vous à venir</h3>
        <?=$message1;?>
        <table>
            <tr>
                <th>Titre</th>
                <th>Entreprise</th>
                <th>Date</th>
                <th>Horaire</th>
                <th>Description</th>
                <th>Domaine</th>
                <th>Type de contrat</th>
                <th>Adresse</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
            <?=$tblisteRdvs?>
        </table>
    </div>

    <div id="Historique" class="tabcontent">
        <h3>Historique</h3>
        <?=$message2;?>
        <table>
            <tr>
                <th>Titre</th>
                <th>Entreprise</th>
                <th>Date</th>
                <th>Horaire</th>
                <th>Description</th>
                <th>Domaine</th>
                <th>Type de contrat</th>
                <th>Adresse</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
            <?=$tblisteHistoriques;?>
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
<?php

