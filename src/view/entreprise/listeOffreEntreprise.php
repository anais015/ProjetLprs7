<?php
session_start();
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/Connexion.php";
require_once "../../model/offre/Offre.php";

require_once "../../model/evenement/Evenement.php";
$cnx = new Bdd();
$bdd = $cnx->getBdd();
$tbOffres='';


$offre=new Offre(array('ref_entreprise'=>$_SESSION['entreprise']['id_entreprise']));
$listeOffres = $offre->listOffreEntreprise($bdd);
foreach ($listeOffres as $listeOffre) {
    $tbOffres .="<tr>
                        <td>".$listeOffre['titre']."</td>                            
                        <td>".$listeOffre['description']."</td>
                        <td>".$listeOffre['domaine']."</td>
                         <td>".$listeOffre['nom_type']."</td>
                        <td>
                            <form action='listeCandidats.php' method='GET'>
                                <button class='btn btn-outline-secondary' name='candidats' value='".json_encode($listeOffre)."'>Consulter candidats</button>
                            </form>
                        </td>
                    </tr>";
}

?>
<!doctype html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <title>Liste d'offres</title>

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
                <div class="col-md-12 align-self-center">

                    <h3 class="text-center">Liste  d'offres</h3>

                    <table id="myTable1" class="table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">Description</th>
                            <th scope="col">Domaine</th>
                            <th scope="col">Contrat</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?=$tbOffres?>
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
