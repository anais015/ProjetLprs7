<!doctype html>
<html lang="fr">
    <head>

        <meta charset="utf-8">
        <title>Organiser un événement</title>
        <link rel="stylesheet" href="../../style/styleEntreprise.css">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0-next.1/esm/popper.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"></script>
    </head>
    <body>
    <header>
        <!--- Navbar --->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand text-white" href="page_accueil.php"><i class="fa-duotone fa-book"></i>Accueil</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nvbCollapse" aria-controls="nvbCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="nvbCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item pl-1">
                            <a class="nav-link" href="#"><i class="fa fa-home fa-fw mr-1"></i>test</a>
                        </li>
                        <li class="nav-item active pl-1">
                            <a class="nav-link" href="#"><i class="fa fa-th-list fa-fw mr-1"></i>test</a>
                        </li>
                        <li class="nav-item pl-1">
                            <a class="nav-link" href="#"><i class="fa fa-info-circle fa-fw mr-1"></i>test</a>
                        </li>
                        <li class="nav-item pl-1">
                            <a class="nav-link" href="#"><i class="fa fa-phone fa-fw fa-rotate-180 mr-1"></i>test</a>
                        </li>
                        <li class="nav-item pl-1">
                            <a class="nav-link" href="../contact.php"><i class="fa fa-user-plus fa-fw mr-1"></i>Contact</a>
                        </li>
                        <li class="nav-item pl-1">
                            <a class="nav-link" href="deconnexion.php"><i class="fa fa-power-off" aria-hidden="true"></i>Déconnexion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--# Navbar #-->
    </header>


<?php
session_start();
var_dump($_SESSION);
?>
        <h1>Création d'un événement</h1>

        <form action='../../traitement/evenement/traitementCreerEventEntreprise.php' method='POST'>
            <label for='nom_event'><b>Nom de l'événement :</b></label>
            <input type='text' placeholder="Nom de l'événement" name='nom_event'  required>

            <label for='description'><b>Description de l'événement :</b></label>
            <textarea placeholder='Description' name='description' id="description" required></textarea>

            <label for='debut'><b>Date et heure de début de l'événement :</b></label>
            <input type='datetime-local' placeholder='début' name='debut' required>

            <label for='fin'><b>Date et heure de fin de l'événement : </b></label>
            <input type='datetime-local' placeholder='fin' name='fin' required>

            <br>
            <button type='submit' name='creerEvenement' id='creerEvenement'>Créer</button>
        </form>

    </body>
</html>
