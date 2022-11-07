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

$tblisteCandidatures = '';

$etudiant= new Etudiant(array('id' => $_SESSION['etudiant']['id_etudiant']));
//var_dump($_SESSION['etudiant']['id_etudiant']);
//var_dump($etudiant);
$liste_candidatures=$etudiant->listeCandidature($bdd);
//var_dump($liste_candidatures);

foreach ($liste_candidatures as $value){
    if (is_null($value['id_rdv'])) $statut="Candidature envoyée";
    else $statut = "Entretien accordé";

    $tblisteCandidatures .="<tr>
                        <td>".$value['titre']."</td>
                        <td>".$value['description']."</td>
                        <td>".date_format(date_create($value['date']),"d/m/Y H:i")  ."</td>
                        <td>".$value['nom_entreprise']."</td>
                        <td>".$value['domaine']."</td>
                        <td>".$value['nom_type']."</td>
                        <td>".$value['rue_entreprise'].", ". $value['ville_entreprise'].", ". $value['cp_entreprise']."</td>
                        <td>$statut</td>
                    </tr>";
}

if(isset($_POST['postuler'])){
    $offre=new Offre(array(
        'id'=> $_POST['postuler'],
        'ref_etudiant'=> $_SESSION['etudiant']['id_etudiant']
    ));
//    var_dump($offre);
    $postule = $offre->etudiantPostule($bdd);
    if (!$postule) $erreur=true;
//    var_dump($postule);
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
    <h2>Mes candidatures</h2>
    <table>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Date de postule</th>
            <th>Entreprise</th>
            <th>Domaine</th>
            <th>Type de contrat</th>
            <th>Adresse</th>
            <th>Statut</th>
        </tr>
        <?= $tblisteCandidatures ?>
    </table>
    </body>

    </html>
<?php
