<?php
session_start();
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/Connexion.php";
require_once "../../model/evenement/Evenement.php";

$cnx = new Bdd();
$bdd = $cnx->getBdd();
$tbEvent='';
$etat='';
$salle='';
$hidden='';

$event=new Evenement(array('ref_entreprise'=>$_SESSION['entreprise']['id_entreprise']));
$listeEvents = $event->listEventEntreprise($bdd);
foreach ($listeEvents as $listeEvent) {
    if ($listeEvent['valide']==0) {
        $hidden='';
        $etat = 'En attente';
    } else {
        $hidden='hidden';
        $etat='Validé';
    }
    if (is_null($listeEvent['nom'])) $salle = 'En attente';
    else $salle=$listeEvent['nom'];
    $date=explode(" ",$listeEvent['debut'])[0];
    $date=date_format(date_create($date),"d/m/Y");
    $heuredebut=explode(" ",$listeEvent['debut'])[1];
    $heurefin=explode(" ",$listeEvent['fin'])[1];
    $heuredebut=date_format(date_create($heuredebut),"H:i");
    $heurefin=date_format(date_create($heurefin),"H:i");
    $tbEvent .="<tr>
                        <td>".$listeEvent['nom_event']."</td>                            
                        <td>".$date."</td>
                        <td>".$heuredebut."</td>
                        <td>".$heurefin."</td>
                        <td>".$salle."</td>
                        <td>".$etat."</td>
                        <td>
                            <form action='modifierEventEntreprise.php' method='GET'>
                                <button class='btn btn-outline-secondary' name='modifier' value='".json_encode($listeEvent)."' ".$hidden.">Modifier</button>
                            </form>
                            <form action='../../traitement/evenement/traitmentSupprimerEventEntreprise.php' method='POST'>
                                <button class='btn btn-outline-secondary' name='annuler' value='".json_encode($listeEvent)."' ".$hidden.">Annuler</button>
                            </form>
                        </td>
                    </tr>";
}

?>
<!doctype html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <title>Modifier un événement</title>

    <!--<link rel="stylesheet" href="../../style/styleEntreprise.css">-->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="../../../src/style/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="../../../src/style/css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="../../../src/style/css/bootstrap.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="../../../src/style/css/magnific-popup.css">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="../../../src/style/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../../src/style/css/owl.theme.default.min.css">

    <!-- Flexslider  -->
    <link rel="stylesheet" href="../../../src/style/css/flexslider.css">

    <!-- Pricing -->
    <link rel="stylesheet" href="../../../src/style/css/pricing.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="../../../src/style/css/style.css">

    <!-- Modernizr JS -->
    <script src="../../../src/style/js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="../../../src/style/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="page">
    <nav class="fh5co-nav" role="navigation">
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <p class="site">www.lyceerobertschuman.com</p>
                        <p class="num">Tel: 01 48 37 74 26</p>
                        <ul class="fh5co-social">
                            <li><a href="#"><i class="icon-facebook2"></i></a></li>
                            <li><a href="#"><i class="icon-twitter2"></i></a></li>
                            <li><a href="#"><i class="icon-dribbble2"></i></a></li>
                            <li><a href="#"><i class="icon-github"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="top-menu">
            <div class="container">
                <div class="row">
                    <div class="col-xs-2">
                        <div id="fh5co-logo"><a href="../../../index.php"><i class="icon-study"></i>LPRS<span>.</span></a></div>
                    </div>
                    <div class="col-xs-10 text-right menu-1">
                        <ul>
                            <li class="active"><a href="../../../index.php">Accueil</a></li>
                            <li class="has-dropdown">
                                <a href="#">Formations</a>
                                <ul class="dropdown">
                                    <li><a href="#">Lycée Professionnel</a></li>
                                    <li><a href="#">Lycée Technologique</a></li>
                                    <li><a href="#">Enseignement supérieur et UFA</a></li>
                                    <li><a href="#">Organigramme</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="#">Partie Entreprise</a>
                                <ul class="dropdown">
                                    <li><a href="profil.php">Profil</a></li>
                                    <li><a href="creerOffre.php">Création d'offre d'emplois</a></li>
                                    <li><a href="creerEventEntreprise.php">Création d'événements</a></li>
                                    <li><a href="listeEventEntreprise.php">Liste d'événements</a></li>
                                    <li><a href="organiserRdv.php">RDV entreprise-étudiant</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Vie de l'établissement</a></li>
                            <li><a href="#">International</a></li>
                            <li><a href="#">Erasmus+</a></li>

                            <li><a href="../contact.php">Contact</a></li>
                            <li class="btn-cta"><a href="../../../src/view/entreprise/deconnexion.php"><span>Se déconnecter</span></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <div id="fh5co-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-3 align-self-start"></div>
                <div class="col-md-6 align-self-center">

                    <h3 class="text-center">Liste  d'événements</h3>

                    <table id="myTable1" class="table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th scope="col">Titre du événement</th>
                            <th scope="col">Date</th>
                            <th scope="col">Début</th>
                            <th scope="col">Fin</th>
                            <th scope="col">Salle</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?=$tbEvent?>
                        <tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
