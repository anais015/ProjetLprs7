<!doctype html>
<html lang="fr">
    <head>

        <meta charset="utf-8">
        <title>Organiser un événement</title>

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
        <style> #rouge{ color: red; }</style>
    </head>
    <body>
    <?php
    session_start();
    //var_dump($_SESSION);
    ?>
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
                                    <a href="evenement.php">Evénement</a>
                                    <ul class="dropdown">
                                        <li><a href="creerEventEntreprise.php">Création d'événements</a></li>
                                        <li><a href="modifierEventEntreprise.php">Modification d'événement</a></li>
                                        <li><a href="supprimerEventEntreprise.php">Suppression d'événement</a></li>
                                    </ul>
                                </li>
                                <li class="has-dropdown">
                                    <a href="../offre/offre.php">Offres</a> <!-- Select -->
                                    <ul class="dropdown">
                                        <li><a href="../offre/creerOffre.php">Création d'offre d'emplois</a></li> <!-- insert -->
                                        <li><a href="../offre/modifierOffre.php">Modification des offres d'emplois</a></li> <!-- Update -->
                                        <li><a href="../offre/supprimerOffre.php" >Suppression des offres d'emplois</a></li>
                                    </ul>
                                </li>
                                <li><a href="../RDV/organiserRdv.php">RDV entreprise-étudiant</a></li>
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

        <div id="fh5co-contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 align-self-start"></div>
                    <div class="col-md-6 align-self-center">

                        <h3 class="text-center">Création d'un événement</h3>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <form action='../../traitement/evenement/traitementCreerEventEntreprise.php' method='POST'>
                                        <input type='text' class="form-control" placeholder="Nom de l'événement" name='nom_event'  required>

                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                     <textarea class="form-control" placeholder="Description de l'événement" name='description' id="description" required></textarea>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for='debut'><b>Date et heure de début :</b></label>
                                    <input type='datetime-local' class="form-control" placeholder='début' name='debut' required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for='fin'><b>Date et heure de fin : </b></label>
                                    <input type='datetime-local' class="form-control" placeholder='fin' name='fin' required>
                                </div>
                            </div>

                        <div class="form-group text-center">
                            <p id="rouge">Attention : la date de l'événement doit être le même jour et l'heure doit être entre 18h et 23h</p>
                            <br>
                            <input type='submit' value="Créer un événement" name='creerEvenement' id='creerEvenement' class="btn btn-primary"></input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
