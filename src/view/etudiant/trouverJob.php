<?php

session_start();
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";
require_once "../../model/offre/Offre.php";

$cnx = new Bdd();
$bdd = $cnx->getBdd();
$erreur= false;
$postule= false;
$button= 'Postuler';
$btn_style='';

$tblisteOffres = '';

$offre = new Offre(array('ref_etudiant' => $_SESSION['etudiant']['id_etudiant']));
$etudiant = new Etudiant(array('id' => $_SESSION['etudiant']['id_etudiant']));
//var_dump($_SESSION['etudiant']['id_etudiant']);
$liste_offres=$offre->listeOffreEtudiant($bdd);
//var_dump($liste_offres);

foreach ($liste_offres as $value){
$check_postule=$etudiant->checkPostule($bdd,$value['id_offre']);
//var_dump($check_postule);
if (is_array($check_postule)) {
    $button = 'Postulé le '.date_format(date_create($check_postule['date']),"d/m/Y H:i");
    $btn_style='disabled="disabled"';
}
    $tblisteOffres .="<tr>
                        <td>".$value['titre']."</td>
                        <td>".$value['description']."</td>
                        <td>".$value['nom_entreprise']."</td>
                        <td>".$value['domaine']."</td>
                        <td>".$value['nom_type']."</td>
                        <td>".$value['rue_entreprise'].", ". $value['ville_entreprise'].", ". $value['cp_entreprise']."</td>
                        <td>
                            <form action='' method='POST'>
                                <button name='postuler'".$btn_style." value='".$value['id_offre']."'>".$button."</button>
                            </form>
                        </td>
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
    <h2>Liste d'offre</h2>

    <div class="container">
        <div class="container" id="alert"
        <?php
        if (!$erreur) echo 'style="display:none;"';
        else echo 'style="display:block; background-color:#f8bdc1; text-align: center"';
        ?>
        <input type="hidden"> &#9888; Vous avez déja postulé à cette offre.
    </div>
    <div class="container">
    <div class="container" id="alert"
        <?php
        if (!$postule) echo 'style="display:none;"';
        else echo 'style="display:block; background-color:#D3DEA5; text-align: center"';
        ?>
        <input type="hidden"> &#10003; Postulé.

    </div>
    <table>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Entreprise</th>
            <th>Domaine</th>
            <th>Type de contrat</th>
            <th>Adresse</th>
            <th>Action</th>
        </tr>
        <?= $tblisteOffres ?>
    </table>
    </body>

    </html>
<?php
