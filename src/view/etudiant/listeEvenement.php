<?php
session_start();

require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";
require_once "../../model/evenement/Evenement.php";

if (!isset($_SESSION['etudiant'])) header('Location:../pageIntrouvable.php');

$cnx = new Bdd();
$bdd = $cnx->getBdd();
$tbHistorique='';
$tbOrganiser='';
$tbParticiper='';
$etat='';
$salle='';
$hidden='';

$event=new Evenement(array('ref_etudiant'=>$_SESSION['etudiant']['id_etudiant']));
$historique=$event->historique($bdd);
foreach ($historique as $value){
    $date=explode(" ",$value['debut'])[0];
    $date=date_format(date_create($date),"d/m/Y");
    $heuredebut=explode(" ",$value['debut'])[1];
    $heurefin=explode(" ",$value['fin'])[1];
    $heuredebut=date_format(date_create($heuredebut),"H:i");
    $heurefin=date_format(date_create($heurefin),"H:i");
    $tbHistorique .="<tr>
                        <form  action='fiche_evenement.php' method='get'>
                            <td><button class='btn btn-link' name='ref_event' value='".$value['id_evenement']."'>".$value['nom_event']."</button></td>                            
                        </form>
                        <td>".$date."</td>
                        <td>".$heuredebut."</td>
                        <td>".$heurefin."</td>
                        <td>
                        <form action='../../traitement/description/traitementSuppression.php' method='post'>
                            <button class='btn btn-link' name='details' value='".$value['id_evenement']."'>Détail</button>
                        </form>
                        </td>
                    </tr>";

}
$listParticiper= $event->listeEventParticipe($bdd);
if (!$listParticiper) $tbParticiper= "<tr><td colspan='7'>Vous n'avez aucun description à participer</td></td>";
else {
    foreach ($listParticiper as $value){
        $date=explode(" ",$value['debut'])[0];
        $date=date_format(date_create($date),"d/m/Y");
        $heuredebut=explode(" ",$value['debut'])[1];
        $heurefin=explode(" ",$value['fin'])[1];
        $heuredebut=date_format(date_create($heuredebut),"H:i");
        $heurefin=date_format(date_create($heurefin),"H:i");
        $tbParticiper .="<tr>
                            <form  action='fiche_evenement.php' method='get'>
                                <td><button class='btn btn-link' name='ref_event' value='".$value['ref_evenement']."'>".$value['nom_event']."</button></td>                            
                            </form>
                            <td>".$date."</td>
                            <td>".$heuredebut."</td>
                            <td>".$heurefin."</td>
                            <td>".$value['nom']."</td>
                            <form action='' method='post'>
                                <td><button class='btn btn-outline-secondary' name='desinscrire' value='".$value['ref_evenement']."'>Se désinscrire</button></td>
                            </form>
                    </tr>";
    }
}

$listOrganise= $event->listEventOrganise($bdd);
foreach ($listOrganise as $value){
    if ($value['valide']==0) {
        $hidden='';
        $etat = 'En attente';
    } else {
        $hidden='hidden';
        $etat='Validé';
    }
    if (is_null($value['nom'])) $salle = 'En attente';
    else $salle=$value['nom'];
    $date=explode(" ",$value['debut'])[0];
    $date=date_format(date_create($date),"d/m/Y");
    $heuredebut=explode(" ",$value['debut'])[1];
    $heurefin=explode(" ",$value['fin'])[1];
    $heuredebut=date_format(date_create($heuredebut),"H:i");
    $heurefin=date_format(date_create($heurefin),"H:i");
    $tbOrganiser .="<tr>
                        <form  action='fiche_evenement.php' method='get'>
                            <td><button class='btn btn-link' name='ref_event' value='".$value['id_evenement']."'>".$value['nom_event']."</button></td>                            
                        </form>
                        <td>".$date."</td>
                        <td>".$heuredebut."</td>
                        <td>".$heurefin."</td>
                        <td>".$salle."</td>
                        <td>".$etat."</td>
                        <td>
                            <form action='modifierEvenement.php' method='GET'>
                                <button class='btn btn-outline-secondary' name='modifier' value='".$value['id_evenement']."' ".$hidden.">Modifier</button>
                            </form>
                            <form action='../../traitement/description/traitementSuppression.php' method='POST'>
                                <button class='btn btn-outline-secondary' name='annuler' value='".$value['id_evenement']."' ".$hidden.">Annuler</button>
                            </form>
                        </td>
                    </tr>";
}

if(isset($_POST['desinscrire'])){
    $event = new Evenement(array('id'=> $_POST['desinscrire']));
    $etudiant = new Etudiant(array('id'=>$_SESSION['etudiant']['id_etudiant']));
    $desincription=$etudiant->desinscrire($bdd,$event);
    if ($desincription) {
        echo '<script>alert("Vous vous êtes désinscrit au évenement")</script>';
        header("location:listeEvenement.php");
    } else echo '<script>alert("Erreur")</script>';
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mes événements &mdash; LPRS</title>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

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
            $(document).ready(function () {
                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
                });

                $('table.table').DataTable({
                    paging: true,
                });

            });;</script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

    </script>
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
                <li style="background-image: url(../../style/images/img_bg_11.jpg);">
                    <div class="overlay-gradient"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center slider-text">
                                <div class="slider-text-inner">
                                    <h1 class="heading-section">Mes événements</h1>
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
                <div class="col-md-1 align-self-start"></div>
                <div class="col-md-10 align-self-center">
                    <h3 class="text-center">Mes événements</h3>

                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active">
                                <a href="#tab-table1" data-toggle="tab">À organiser</a>
                            </li>
                            <li>
                                <a href="#tab-table2" data-toggle="tab">À participer</a>
                            </li>
                            <li>
                                <a href="#tab-table3" data-toggle="tab">Historique</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-table1">
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
                                        <?=$tbOrganiser?>
                                    <tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab-table2">
                                <table id="myTable2" class="table" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th scope="col">Titre du événement</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Début</th>
                                        <th scope="col">Fin</th>
                                        <th scope="col">Salle</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?=$tbParticiper?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="tab-table3">
                                <table id="myTable3" class="table" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                    <tr>
                                        <th scope="col">Titre du événement</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Début</th>
                                        <th scope="col">Fin</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?=$tbHistorique;?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                            <!--<table id="table_id" class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Offres</th>
                                    <th scope="col">Entreprise</th>
                                    <th scope="col">Date de postule</th>
                                    <th scope="col">Contrat</th>
                                    <th scope="col">Statut</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?/*= $tblisteCandidatures */?>
                                </tbody>
                            </table>-->
                </div>
                <div class="col-md-1 align-self-end"></div>
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

</body>
</html>
