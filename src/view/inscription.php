<?php
$table="";
$placeHolder='Vous êtes';
if(isset($_POST['selectIdentity'])) {
    if ($_POST['selectIdentity'] == 'administrateur') {
        $placeHolder = 'Administrateur';
        $table .= "
                <div class='row form-group'>
				<form action='../traitement/administration/inscriptionadmin.php' method='POST'>
				<div class='col-md-6'>
					<input type='text' class='form-control' placeholder='Nom' name='nom'  required='required'>
				</div>
				<div class='col-md-6'>
					<input type='text' class='form-control' placeholder='Prénom' name='prenom' required='required'>
				</div>
			</div>
			<div class='row form-group'>
				<div class='col-md-12'>
					<input type='email' class='form-control' placeholder='Email' name='email' required='required'>
				</div>
			</div>
			<div class='row form-group'>
				<div class='col-md-12'>
					<input type='password' class='form-control' placeholder='Password' name='password' required='required'>
                    <small>Le mot de passe doit contenir au moins 8 caractères, 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial</small>
				</div>
			</div>

			<div class='form-group text-center'>
				<input type='submit' value=\"S'incrire\" name='inscription' id='inscription' class='btn btn-primary'>
				</form>
			</div>
                ";
    }
    if ($_POST['selectIdentity'] == 'entreprise') {
        $placeHolder = 'Entreprise';
        $table .= "
        <div class='row form-group'>
				<form action='../traitement/entreprise/traitementInscriptionEntreprise.php' method='POST'>  
				<div class='col-md-6'>
					<input type='text' class='form-control' placeholder='Nom' name='nom' required='required'>
				</div>
				<div class='col-md-6'>
					<input type='text' class='form-control' placeholder='Prénom' name='prenom' required='required'>
				</div>
			</div>
			<div class='row form-group'>
				<div class='col-md-12'>
					<input type='text' class='form-control' placeholder='Rôle de la société' name='role_societe' required='required'>
				</div>
			</div>
			<div class='row form-group'>
				<div class='col-md-12'>
                <input type='text' class='form-control' placeholder='Nom de l Entreprise' name='nom_entreprise' required='required'>
				</div>
			</div>
			<div class='row form-group'>
				<div class='col-md-12'>
					<input type='text' class='form-control' placeholder='Rue' name='rue_entreprise' required='required'>
				</div>
			</div>
			<div class='row form-group'>
				<div class='col-md-6'>
					<input type='text' class='form-control'placeholder='Ville' name='ville_entreprise' required='required'>
				</div>
				<div class='col-md-6'>
					<input type='text' class='form-control' placeholder='Code Postal' name='cp_entreprise' required='required'>
				</div>
			</div>
			<div class='row form-group'>
				<div class='col-md-12'>
					<input type='email' class='form-control' placeholder='Email' name='email' required='required'>
				</div>
			</div>
			<div class='row form-group'>
				<div class='col-md-12'>
					<input type='password' class='form-control' placeholder='Password' name='password' required='required'>
					<small>Le mot de passe doit contenir au moins 8 caractères, 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial</small>
				</div>
			</div>
			<div class='form-group text-center'>
				<input type='submit' value=\"S'incrire\" name='inscription' id='inscription' class='btn btn-primary'>
				</form>
			</div>
                ";
    }

    if ($_POST['selectIdentity'] == 'etudiant') {
        $placeHolder = 'Etudiant';
        $table .= "
                <div class='row form-group'>
				<form action='../traitement/etudiant/traitementInscription.php' method='POST'>   
				<div class='col-md-6'>
					<input type='text' class='form-control' placeholder='Nom' name='nom' required='required'>
				</div>
				<div class='col-md-6'>
					<input type='text' class='form-control' placeholder='Prénom' name='prenom' required='required'>
				</div>
			</div>
			<div class='row form-group'>
				<div class='col-md-12'>
					<input type='text' class='form-control' placeholder=\"Domaine d'étude\" name='domaine' required='required'>
				</div>
			</div>
			<div class='row form-group'>
				<div class='col-md-12'>
					<input type='email' class='form-control' placeholder='Email' name='email' required='required'>
				</div>
			</div>
			<div class='row form-group'>
				<div class='col-md-12'>
					<input type='password' class='form-control' placeholder='Password' name='password' required='required'>
                    <small>Le mot de passe doit contenir au moins 8 caractères, 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial</small>
				</div>
			</div>
			<div class='form-group text-center'>
				<input type='submit' value=\"S'incrire\" name='inscription' id='inscription' class='btn btn-primary'>
				</form>
			</div>
            ";
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>S'inscrire &mdash; LPRS</title>
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
    <link rel="stylesheet" href="../style/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="../style/css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="../style/css/bootstrap.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="../style/css/magnific-popup.css">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="../style/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../style/css/owl.theme.default.min.css">

    <!-- Flexslider  -->
    <link rel="stylesheet" href="../style/css/flexslider.css">

    <!-- Pricing -->
    <link rel="stylesheet" href="../style/css/pricing.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="../style/css/style.css">

    <!-- Modernizr JS -->
    <script src="../style/js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="../style/js/respond.min.js"></script>
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
                        <div id="fh5co-logo"><a href="../../index.php"><i class="icon-study"></i>LPRS<span>.</span></a></div>
                    </div>
                    <div class="col-xs-10 text-right menu-1">
                        <ul>
                            <li><a href="../../index.php">Accueil</a></li>
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
                                    <li><a href="#">Offres d'emploies</a></li>
                                    <li><a href="#">Partenariat entreprises</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Vie de l'établissement</a></li>
                            <li><a href="#">International</a></li>
                            <li><a href="#">Erasmus+</a></li>

                            <li><a href="#">Contact</a></li>
                            <li class="btn-cta"><a href="connexion.php"><span>Se connecter</span></a></li>
                            <li class="btn-cta"><a href="inscription.php"><span>S'inscrire</span></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <aside id="fh5co-hero">
        <div class="flexslider">
            <ul class="slides">
                <li style="background-image: url(../style/images/img_bg_5.jpg);">
                    <div class="overlay-gradient"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center slider-text">
                                <div class="slider-text-inner">
                                    <h1 class="heading-section">S'inscrire</h1>
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
                    <h3 class="text-center">S'inscrire</h3>
                    <div class="row form-group">
                        <div class="col-md-13">
                            <form action="" method="post">
                                <select class="form-control" name="selectIdentity" id="selectIdentity" required onchange="this.form.submit()">
                                    <option selected hidden disabled><?=$placeHolder;?></option>
                                    <option value="administrateur">Administrateur</option>
                                    <option value="entreprise">Entreprise</option>
                                    <option value="etudiant">Etudiant</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="row form-group">
                        <?=$table;?>
                    </div>
                </div>
                <div class="col-md-3 align-self-end"></div>
                </div>

        </div>
    </div>

    <footer id="fh5co-footer" role="contentinfo" style="background-image: url(../style/images/img_bg_5.jpg);">
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
<script src="../style/js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="../style/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="../style/js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="../style/js/jquery.waypoints.min.js"></script>
<!-- Stellar Parallax -->
<script src="../style/js/jquery.stellar.min.js"></script>
<!-- Carousel -->
<script src="../style/js/owl.carousel.min.js"></script>
<!-- Flexslider -->
<script src="../style/js/jquery.flexslider-min.js"></script>
<!-- countTo -->
<script src="../style/js/jquery.countTo.js"></script>
<!-- Magnific Popup -->
<script src="../style/js/jquery.magnific-popup.min.js"></script>
<script src="../style/js/magnific-popup-options.js"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
<script src="../style/js/google_map.js"></script>
<!-- Count Down -->
<script src="../style/js/simplyCountdown.js"></script>
<!-- Main -->
<script src="../style/js/main.js"></script>

</body>
</html>
