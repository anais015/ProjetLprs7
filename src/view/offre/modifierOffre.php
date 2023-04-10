<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/administrateur/Type.php";
require_once "../../model/offre/Offre.php";

?>
<!doctype html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <title>Modifier une offre</title>
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
<?php
session_start();
?>

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

    <div id="fh5co-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-3 align-self-start"></div>
                <div class="col-md-6 align-self-center">

                    <h3 class="text-center">Modifier d'une offre</h3>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <form action='../../traitement/offre/traitementModifierOffre.php' method='POST'>
                                <select name="id_offre" class="form-control">
                                    <option value="" disabled selected> Choississez l'offre à modifier </option>

                                    <?php
                                    $bdd = new Bdd();
                                    $bdd=$bdd->getBdd();
                                    $offre = new Offre(array('ref_entreprise'=>$_SESSION['entreprise']['id_entreprise']));

                                    $donnees = $offre->affichage($bdd);

                                    foreach($donnees as $value) {

                                        echo "<option value=".$value['id_offre'].">".$value['titre']."</option>";
                                    }
                                    ?>

                                </select>
                        </div>
                    </div>

                        <div class="row form-group">
                        <div class="col-md-12">
                               <!--<label for='titre'><b>Titre de l'offre :</b></label>-->
                                <input type='text' class="form-control" placeholder="Titre de l'offre" name='titre'  required><br/>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <!--<label for='description'><b>Description de l'offre :</b></label>-->
                            <textarea class="form-control" placeholder="Description de l'offre" name='description' id="description" required></textarea><br/>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <!--<label for='domaine'><b>Domaine :</b></label>-->
                            <input type='text' class="form-control" placeholder='Domaine' name='domaine'  required><br>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <select name="type" class="form-control">
                                <option value="" disabled selected> Choississez le type de l'offre </option>

                                <?php
                                $bdd = new Bdd();
                                $type = new Type(array());
                                $donnees = $type->getAllType($bdd);

                                foreach($donnees as $value) {

                                    echo "<option value=".$value['id_type'].">".$value['nom_type']."</option>";
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <input type='submit' value="Modifier une offre" name='modifierOffre' id='modifierOffre' class="btn btn-primary"></input>
                        </form>
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
</body>
</html>