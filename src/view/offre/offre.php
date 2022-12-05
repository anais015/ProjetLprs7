<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/administrateur/Type.php";
require_once "../../model/offre/Offre.php";
?>

<!doctype html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <title>Page - offre</title>
    <!--<link rel="stylesheet" href="../../style/styleEntreprise.css">-->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="../../style/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="../../style/css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="../../style/css/bootstrap.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="../../style/css/magnific-popup.css">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="../../style/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../style/css/owl.theme.default.min.css">

    <!-- Flexslider  -->
    <link rel="stylesheet" href="../../style/css/flexslider.css">

    <!-- Pricing -->
    <link rel="stylesheet" href="../../style/css/pricing.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="../../style/css/style.css">

    <!-- Modernizr JS -->
    <script src="../../style/js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="../../style/js/respond.min.js"></script>
    <![endif]-->

    <!-- pour le tableau -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <style>
        table{
            background-color: #fd7e14;
            table-layout: auto;
            width: 250px;
        }
        td, th{
            color: #1e2125;
            font-family: "Rage Italic";
        }
        .main-block {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 25px;
            background: rgba(0, 0, 0, 0.5);
        }
        .left-part, form {
            padding: 25px;
        }
        .left-part {
            text-align: center;
        }
        .fa-graduation-cap {
            font-size: 72px;
        }
        form {
            background: rgba(0, 0, 0, 0.7);
        }
        .title {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .info {
            display: flex;
            flex-direction: column;
        }
        input, select {
            padding: 5px;
            margin-bottom: 30px;
            background: transparent;
            border: none;
            border-bottom: 1px solid #eee;
        }
        input::placeholder {
            color: #eee;
        }

        option:focus {
            border: none;
        }
        option {
            background: black;
            border: none;
        }
        .checkbox input {
            margin: 0 10px 0 0;
            vertical-align: middle;
        }

        @media (min-width: 568px) {
            .main-block {
                flex-direction: row;
                height: calc(100% - 50px);
            }
            .left-part, form {
                flex: 1;
                height: auto;
            }

            select, p {
                padding: 0;
                margin: 0;
                outline: none;
                font-family: Roboto, Arial, sans-serif;
                font-size: 16px;
                color: #eee;
            }
    </style>
</head>
<body>

<!--<div class="fh5co-loader"></div>-->

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
                        <div id="fh5co-logo"><a href="../entreprise/page_accueil.php"><i class="icon-study"></i>LPRS<span>.</span></a></div>
                    </div>
                    <div class="col-xs-10 text-right menu-1">
                        <ul>
                            <li class="active"><a href="../entreprise/page_accueil.php">Accueil</a></li>
                            <li class="has-dropdown">
                                <a href="../evenement/evenement.php">Evénement</a>
                                <ul class="dropdown">
                                    <li><a href="../evenement/creerEventEntreprise.php">Création d'événements</a></li>
                                    <li><a href="../evenement/modifierEventEntreprise.php">Modification d'événement</a></li>
                                    <li><a href="../evenement/supprimerEventEntreprise.php">Suppression d'événement</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="offre.php">Offres</a> <!-- Select -->
                                <ul class="dropdown">
                                    <li><a href="creerOffre.php">Création d'offre d'emplois</a></li> <!-- insert -->
                                    <li><a href="modifierOffre.php">Modification des offres d'emplois</a></li> <!-- Update -->
                                    <li><a href="supprimerOffre.php" >Suppression des offres d'emplois</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="../RDV/gestionRDV.php">RDV entreprise-étudiant</a>
                                <ul class="dropdown">
                                    <li><a href="../RDV/organiserRdv.php">Création de RDV</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="../entreprise/profil.php">Profil</a>
                                <ul class="dropdown">
                                    <li><a href="../entreprise/modifProfil.php">Modifier Profil</a></li>
                                </ul>
                            </li>
                            <li><a href="../contact.php">Contact</a></li>
                            <li class="btn-cta"><a href="../entreprise/deconnexion.php"><span>Se déconnecter</span></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <aside id="fh5co-hero">
        <div class="flexslider">
            <ul class="slides">
                <li style="background-image: url(../../../src/style/image-entreprise/vecteezy_hand-shaking-which-print-screen-on-wooden-cube-block-in_6969586_600.jpg);">
                    <div class="overlay-gradient"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center slider-text">
                                <div class="slider-text-inner">
                                    <p><a class="btn btn-primary btn-lg" href="creerOffre.php">Créer des offres d'emplois</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url(../../../src/style/image-entreprise/modifier.png);">
                    <div class="overlay-gradient"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center slider-text">
                                <div class="slider-text-inner">
                                    <p><a class="btn btn-primary btn-lg btn-learn" href="modifierOffre.php">Modifier des offres d'emplois</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url(../../../src/style/image-entreprise/supprimer.jpg);">
                    <div class="overlay-gradient"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center slider-text">
                                <div class="slider-text-inner">
                                    <p><a class="btn btn-primary btn-lg btn-learn" href="supprimerOffre.php">Supprimer des offres</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </aside>

    <div id="fh5co-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-3 align-self-start"></div>
                <div class="col-md-6 align-self-center">

                    <h3 class="text-center">Liste des offres créé</h3>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <div class="main-block">
                                <div class="left-part">
                                    <table id="table_id" class="display">
                                        <thead>
                                        <tr>
                                            <th>id de offre</th>
                                            <th>Nom de offre</th>
                                            <th>Description</th>
                                            <th>Domaine</th>
                                           <!-- <th>Type</th>-->
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $bdd = new Bdd();
                                        $bdd=$bdd->getBdd();
                                        $offre = new Offre(array('ref_entreprise'=>$_SESSION['entreprise']['id_entreprise']));
                                        $donnees = $offre->affichage($bdd);

                                        foreach($donnees as $value){

                                            echo "<tr><td>".$value['id_offre']."</td><td>"
                                                .$value['titre']."</td><td>".$value['description']."</td><td>"
                                                .$value['domaine']./*"</td><td>".$value['type'].*/"</td></tr>";

                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Partie du bas -->

    <footer id="fh5co-footer" role="contentinfo" style="background-image: url(../../style/images/img_bg_4.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-4 fh5co-widget">
                    <h3>LYCÉE PRIVÉ ET UFA ROBERT SCHUMAN</h3>
                    <p>Enseignement catholique sous contrat d'association avec l'Etat
                        Etablissement habilité à percevoir la taxe d'apprentissage</p>
                    <p> 5 avenue du Général de Gaulle - 93440 Dugny</p>
                    <p>administration@lyceerobertschuman.com</p>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1 fh5co-widget">
                    <h3>LIENS RAPIDES</h3>
                    <ul class="fh5co-footer-links">
                        <li><a href="../contact.php">Contact</a></li>
                        <li><a href="#">Accès</a></li>
                        <li><a href="https://0931573e.index-education.net/pronote/">Espace Pronote</a></li>
                        <li><a href="https://www.youtube.com/watch?v=5fQu2KygRL0&ab_channel=RobertSchuman">Vidéo Etablissement</a></li>
                        <li><a href="https://www.facebook.com/robertschumandugny">Facebook</a></li>
                    </ul>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-6 col-md-push-1 fh5co-widget">
                    <h3>ACCÈS</h3>
                    <p>RER B (Le Bourget) et Bus 133 (Albert Chardavoine)<br/> RER B (La Courneuve) et Bus 249 (Albert Chardavoine) Tramway T11 : arrêt Dugny-La Courneuve</p>
                </div>
            </div>

            <div class="row copyright">
                <div class="col-md-12 text-center">
                    <p>
                        <small class="block">&copy; 2016 - Micromagic - Tous droits réservés.</small>
                    </p>
                </div>
            </div>

        </div>
    </footer>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

<!-- jQuery -->
<script src="../../style/js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="../../style/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="../../style/js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="../../style/js/jquery.waypoints.min.js"></script>
<!-- Stellar Parallax -->
<script src="../../style/js/jquery.stellar.min.js"></script>
<!-- Carousel -->
<script src="../../style/js/owl.carousel.min.js"></script>
<!-- Flexslider -->
<script src="../../style/js/jquery.flexslider-min.js"></script>
<!-- countTo -->
<script src="../../style/js/jquery.countTo.js"></script>
<!-- Magnific Popup -->
<script src="../../style/js/jquery.magnific-popup.min.js"></script>
<script src="../../style/js/magnific-popup-options.js"></script>
<!-- Count Down -->
<script src="../../style/js/simplyCountdown.js"></script>
<!-- Main -->
<script src="../../style/js/main.js"></script>
<script>
    var d = new Date(new Date().getTime() + 1000 * 120 * 120 * 2000);

    // default example
    simplyCountdown('.simply-countdown-one', {
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate()
    });

    //jQuery example
    $('#simply-countdown-losange').simplyCountdown({
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate(),
        enableUtc: false
    });
</script>
<script> $(document).ready( function () {
        $('#table_id').DataTable();
    } );</script>
</body>
</html>