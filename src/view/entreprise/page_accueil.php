<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Page d'accueil pour entreprise </title>
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

        <!--<h2> Page d'accueil </h2>
        <h4> ... même si elle est moche ! &#128521;</h4>-->


<!-- Partie du bas -->
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