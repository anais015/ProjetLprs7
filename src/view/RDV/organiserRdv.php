<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/administrateur/Type.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/offre/Offre.php";
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Organiser RDV </title>
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
                                <a href="../evenement/evenement.php">Ev??nement</a>
                                <ul class="dropdown">
                                    <li><a href="../evenement/creerEventEntreprise.php">Cr??ation d'??v??nements</a></li>
                                    <li><a href="../evenement/modifierEventEntreprise.php">Modification d'??v??nement</a></li>
                                    <li><a href="../evenement/supprimerEventEntreprise.php">Suppression d'??v??nement</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="../offre/offre.php">Offres</a> <!-- Select -->
                                <ul class="dropdown">
                                    <li><a href="../offre/creerOffre.php">Cr??ation d'offre d'emplois</a></li> <!-- insert -->
                                    <li><a href="../offre/modifierOffre.php">Modification des offres d'emplois</a></li> <!-- Update -->
                                    <li><a href="../offre/supprimerOffre.php" >Suppression des offres d'emplois</a></li>
                                </ul>
                            </li>
                            <li class="has-dropdown">
                                <a href="../RDV/gestionRDV.php">RDV entreprise-??tudiant</a>
                                <ul class="dropdown">
                                    <li><a href="../RDV/organiserRdv.php">Cr??ation de RDV</a></li>
                                </ul>
                            </li>
                            <li><a href="../entreprise/profil.php">Profil</a></li>

                            <li><a href="../contact.php">Contact</a></li>
                            <li class="btn-cta"><a href="../entreprise/deconnexion.php"><span>Se d??connecter</span></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <!-- cr??ation d'un rdv -->

    <p> Cr??ation d'un rdv</p>

    <form action='../../traitement/rdv/traitementCreerRDV.php' method='POST'>
        <label for="choix-etudiant">Etudiant :</label>
        <select name="etudiant" id="choix-etudiant">
            <option value="">Choisissez l'??tudiant</option>
            <?php
            $bdd = new Bdd();
            $etu = new Etudiant(array());
            $donnees = $etu->selectParId($bdd);

            foreach($donnees as $value) {

                echo "<option value=".$value['id_etudiant'].">".$value['nom']."</option>";
            }
            ?>
        </select>
        <br/><br/>
        <label for="choix-offre">Offre :</label>
        <select name="offre" id="choix-offre">
            <option value="">Choisissez l'offre</option>
            <?php
            $bdd = new Bdd();
            $offre = new Offre(array());
            $donnees = $offre->affichage($bdd);

            foreach($donnees as $value) {

                echo "<option value=".$value['id_offre'].">".$value['titre']."</option>";
            }
            ?>
        </select>

        <br/><br/>
        <label for="choix-horaire">Horaire :</label>
        <input type="time" id="choix-horaire" name="horaire"
               min="06:00" max="22:00" required>
        <br/><br/>
        <label for="choix-lieux">Lieux :</label>
        <input type='text' placeholder='Lieux' name='lieux'  required>
    </form>

    <!-- Partie du bas -->

    <footer id="fh5co-footer" role="contentinfo" style="background-image: url(../../style/images/img_bg_4.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-4 fh5co-widget">
                    <h3>LYC??E PRIV?? ET UFA ROBERT SCHUMAN</h3>
                    <p>Enseignement catholique sous contrat d'association avec l'Etat
                        Etablissement habilit?? ?? percevoir la taxe d'apprentissage</p>
                    <p> 5 avenue du G??n??ral de Gaulle - 93440 Dugny</p>
                    <p>administration@lyceerobertschuman.com</p>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1 fh5co-widget">
                    <h3>LIENS RAPIDES</h3>
                    <ul class="fh5co-footer-links">
                        <li><a href="../contact.php">Contact</a></li>
                        <li><a href="#">Acc??s</a></li>
                        <li><a href="https://0931573e.index-education.net/pronote/">Espace Pronote</a></li>
                        <li><a href="https://www.youtube.com/watch?v=5fQu2KygRL0&ab_channel=RobertSchuman">Vid??o Etablissement</a></li>
                        <li><a href="https://www.facebook.com/robertschumandugny">Facebook</a></li>
                    </ul>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-6 col-md-push-1 fh5co-widget">
                    <h3>ACC??S</h3>
                    <p>RER B (Le Bourget) et Bus 133 (Albert Chardavoine)<br/> RER B (La Courneuve) et Bus 249 (Albert Chardavoine) Tramway T11 : arr??t Dugny-La Courneuve</p>
                </div>
            </div>

            <div class="row copyright">
                <div class="col-md-12 text-center">
                    <p>
                        <small class="block">&copy; 2016 - Micromagic - Tous droits r??serv??s.</small>
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
</body>
</html>
