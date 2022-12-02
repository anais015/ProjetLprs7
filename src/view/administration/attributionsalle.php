<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/evenement/Evenement.php";
require_once "../../model/Salle.php";
$bdd = new Bdd();
$salle = new Salle(array());
$evenement = new Evenement(array());
$salles = $salle->getAllSalle($bdd);
$pendingevents = $evenement->getPendingEvent($bdd);
if (count($pendingevents)>=1){
    $eventlist   = "<b>Liste des événements en attente</b>";
    foreach ($pendingevents as $event) {
        $eventelement = "<div style='border: 1px solid black'>
                            <h3 style='margin: 0'>".$event['nom']."</h3>
                            <p>".$event['description']. "</p>
                            <form action='../../traitement/administration/traitementevenement.php' method='post'><input hidden name='evenement'     value='" .$event['id_evenement']."'>
                            <select required name='salle'>";
        foreach ($salles as $salle){
            $eventelement .= "<option value='".$salle['id_salle']."'>".$salle['nom']." ".$salle["nombre_place"]."</option>";
        }
        $eventelement .= "</select><button name='accepter' type='submit'>Accepter l'évènement et l'attribuer à la salle selectionner</button>
                          <button name='supprimer' type='submit'>Supprimer</button></form></div>";
        $eventlist .= $eventelement;
    }
}else{
    $eventlist = "Pas d'événement en attente";
}
?>
<html lang="fr">
<head>
    <title>Attribution</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
    <meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="freehtml5.co" />

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


</head>
<body>
<div class="fh5co-loader"></div>

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
                                <a href="#">Relations Entreprises</a>
                                <ul class="dropdown">
                                    <li><a href="#">Stage</a></li>
                                    <li><a href="#">Offres d'emplois</a></li>
                                    <li><a href="#">Partenariat entreprises</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Vie de l'établissement</a></li>
                            <li><a href="#">International</a></li>
                            <li><a href="#">Erasmus+</a></li>

                            <li><a href="#">Contact</a></li>
                            <li class='btn-cta'><a href='../../../src/view/administration/vueadmin.php'><span>Tableau de bord</span></a></li>
                            <li class='btn-cta'><a href='../../../src/view/administration/deconnexion.php'><span>S'inscrire</span></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </nav>
    <a href="vueadmin.php">Retour</a>
    <?=$eventlist?>

    <footer id="fh5co-footer" role="contentinfo" style="background-image: url(../../../src/style/images/img_bg_4.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-4 fh5co-widget">
                    <h3>LYCÉE PRIVÉ ET UFA ROBERT SCHUMAN</h3>
                    <p>Enseignement catholique sous contrat d'association avec l'Etat
                        Etablissement habilité à percevoir la taxe d'apprentissage</p>
                    <p>Adresse : 5 Avenue du Général de Gaulle - 93440 Dugny</p>
                    <p>Email : administration@lyceerobertschuman.com</p>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1 fh5co-widget">
                    <h3>LIENS RAPIDES</h3>
                    <ul class="fh5co-footer-links">
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Accès</a></li>
                        <li><a href="https://0931573e.index-education.net/pronote/">Espace Pronote</a></li>
                        <li><a href="https://www.youtube.com/watch?v=5fQu2KygRL0&ab_channel=RobertSchuman">Vidéo Etablissement</a></li>
                        <li><a href="https://www.facebook.com/robertschumandugny">Facebook</a></li>
                    </ul>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-6 col-md-push-1 fh5co-widget">
                    <h3>ACCÈS</h3>
                    <p>RER B (Le Bourget) et Bus 133 (Albert Chardavoine)<br/> RER B (La Courneuve) et Bus 249 (Albert Chardavoine) Tramway T11: arrêt Dugny-La Courneuve</p>
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
    <script src="../../../src/style/js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="../../../src/style/js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="../../../src/style/js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="../../../src/style/js/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <script src="../../../src/style/js/jquery.stellar.min.js"></script>
    <!-- Carousel -->
    <script src="../../../src/style/js/owl.carousel.min.js"></script>
    <!-- Flexslider -->
    <script src="../../../src/style/js/jquery.flexslider-min.js"></script>
    <!-- countTo -->
    <script src="../../../src/style/js/jquery.countTo.js"></script>
    <!-- Magnific Popup -->
    <script src="../../../src/style/js/jquery.magnific-popup.min.js"></script>
    <script src="../../../src/style/js/magnific-popup-options.js"></script>
    <!-- Count Down -->
    <script src="../../../src/style/js/simplyCountdown.js"></script>
    <!-- Main -->
    <script src="../../../src/style/js/main.js"></script>
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
</body>
</html>
