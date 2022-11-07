<!doctype html>
<html lang="fr">
    <head>

        <meta charset="utf-8">
        <title>Créer une offre</title>
        <link rel="stylesheet" href="../../style/styleEntreprise.css">

    </head>
    <body>

        <nav>
            <ul>
                <li><a href="page_accueil.php">Accueil</a></li>
                <li><a href="../contact.php">Contact</a></li>
                <li><a href="deconnexion.php">Déconnexion</a></li>
            </ul>
        </nav>

        <?php
        session_start();
        ?>

        <h1>Création d'une offre</h1>

        <form action='../../traitement/entreprise/traitementCreerOffre.php' method='POST'>
            <label for='titre'><b>Titre de l'offre :</b></label>
            <input type='text' placeholder='titre' name='titre'  required>

            <label for='description'><b>Description de l'offre :</b></label>
            <textarea placeholder='Description' name='description' id="description" required></textarea>

            <label for='domaine'><b>Domaine :</b></label>
            <input type='text' placeholder='domaine' name='domaine'  required>
            <br>
            <button type='submit' name='creerOffre' id='creerOffre'><span class="bn39span">Créer</span></button>
        </form>

    </body>
</html>
