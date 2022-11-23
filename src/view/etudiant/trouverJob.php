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
$liste_offres=$offre->listeOffreEtudiant($bdd);

foreach ($liste_offres as $value){
$check_postule=$etudiant->checkPostule($bdd,$value['id_offre']);
if (is_array($check_postule)) {
    $button = 'Postulé le '.date_format(date_create($check_postule['date']),"d/m/Y H:i");
    $btn_style='disabled="disabled"';
}else{
    $button= 'Postuler';
    $btn_style='';
    }
    /*$tblisteOffres .="<tr>
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
                    </tr>";*/
    $tblisteOffres .='
        <div class="col-md-4">
            <div class="pricing__item">
                <div class="wrap-price">
                    <!-- <div class="icon icon-user2"></div> -->
                    <h3 class="pricing__title">'.$value['titre'].'</h3>
                    <!-- <p class="pricing__sentence">Single user license</p> -->
                </div>
                <div class="wrap-price">
                    <ul class="pricing__feature-list">
                        <li class="pricing__feature">Entreprise: '.$value['nom_entreprise'].'</li>
                        <li class="pricing__feature">Adresse : '.$value['rue_entreprise'].', '. $value['ville_entreprise'].', '. $value['cp_entreprise'].'</li>
                        <li class="pricing__feature">Domaine : '.$value['domaine'].'</li>
                        <li class="pricing__feature">Contrat : '.$value['nom_type'].'</li>
                        <button class="pricing__feature btn-link">En savoir plus</button>
                    </ul>
                    <form action="" method="POST">
                        <button type"submit" class="pricing__action" name="postuler"'.$btn_style.' value="'.$value['id_offre'].'">'.$button.'</button>
                    </form>
                </div>
            </div>
        </div>      
    ';
}

if(isset($_POST['postuler'])){
    $offre=new Offre(array(
        'id'=> $_POST['postuler'],
        'ref_etudiant'=> $_SESSION['etudiant']['id_etudiant']
    ));
    $postule = $offre->etudiantPostule($bdd);
    if ($postule) echo "<script>alert(\"Postulé\")</script>";
    else echo "<script>alert(\"Erreur\")</script>";
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jobs &mdash; LPRS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
    <meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="freehtml5.co" />

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

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
                        <div id="fh5co-logo"><a href="accueil.php"><i class="icon-study"></i>LPRS<span>.</span></a></div>
                    </div>
                    <div class="col-xs-10 text-right menu-1">
                        <ul>
                            <li class="active"><a href="accueil.php">Accueil</a></li>

                            <li><a href="trouverJob.php">Chercher un job</a></li>
                            <li><a href="trouverEvenement.php">Chercher un événement</a></li>
                            <li><a href="organizerEvenement.php">Organiser un événement</a></li>
                            <li class="has-dropdown">
                                <a href="#">Mon espace</a>
                                <ul class="dropdown">
                                    <li><a href="listeEvenement.php">Mes événements</a></li>
                                    <li><a href="candidature.php">Mes candidatures</a></li>
                                    <li><a href="rdv.php">Mes rendez-vous</a></li>
                                    <li><a href="monCompte.php">Mon compte</a></li>
                                </ul>
                            </li>

                            <li class="btn-cta"><a href="deconnexion.php"><span>Se déconnecter</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="fh5co-hero">
        <div class="flexslider">
            <ul class="slides">
                <li style="background-image: url(../../style/images/img_bg_8.jpg);">
                    <div class="overlay-gradient"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center slider-text">
                                <div class="slider-text-inner">
                                    <h1 class="heading-section">Chercher un job</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </aside>

    <div id="fh5co-pricing" class="fh5co-bg-section">
        <div class="container overflow-hidden">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                    <h2>Offres d'emploi</h2>
                </div>
            </div>
            <div class="row">
                <div class="pricing pricing--rabten">
                    <?= $tblisteOffres ?>
                </div>
            </div>
        </div>
    </div>

    <footer id="fh5co-footer" role="contentinfo">
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
                    <p>RER B (Le Bourget) et Bus 133 (Albert Chardavoine) RER B (La Courneuve) et Bus 249 (Albert Chardavoine) Tramway T11: arrêt Dugny-La Courneuve</p>
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
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
<script src="../../style/js/google_map.js"></script>
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



