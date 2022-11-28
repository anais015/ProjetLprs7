<?php
session_start();

if (!isset($_SESSION['etudiant'])) $location="../../index.php";
else $location="etudiant/accueil.php" ;
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Education &mdash; Free Website Template, Free HTML5 Template by freehtml5.co</title>
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

<div id="fh5co-register" style="background-image: url(../style/images/introuvable.jpg); height: 100%">
    <div class="overlay"></div>
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="text-left">
                <p style="font-size: 65px">OUPS !</>
                <h4 style="color: white">LA  PAGE QUE VOUS RECHERCHEZ SEMBLE INTROUVABLE.</h4>
                <p><strong>Code erreur : 404</strong></p>
                <p>Désolé mais ce lien introuble! Dirigez-vous vers la page d'accueil.</p>
                <p><a href=<?=$location;?> class="btn btn-primary btn-lg btn-reg">Retourner à la page d'accueil!</a></p>
            </div>
        </div>
    </div>
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
