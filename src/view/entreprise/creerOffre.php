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

<h1>Création d'un événement</h1>

<form action='../../traitement/evenement/traitementCreerEventEntreprise.php' method='POST'>
    <label for='nom'><b>Nom de l'événement :</b></label>
    <input type='text' placeholder='Nom' name='nom'  required>

    <label for='description'><b>Description de l'événement :</b></label>
    <textarea placeholder='Description' name='description' id="description" required></textarea>

    <label for='date'><b>Date de l'événement :</b></label>
    <input type='date' placeholder='date' name='date' required>

    <label for='heure'><b>Heure du commencement : </b></label>
    <input type='time' placeholder='heure' name='heure' min="07:00" max="20:00" required>
    <small> Un événement ne peut que commencer à 7h !</small>

    <label for='duree'><b>Durée de l'événement :</b></label>
    <input type='time' placeholder='duree' name='duree'  required>
    <br>
    <button type='submit' name='creerEvenement' id='creerEvenement'><span class="bn39span">Créer</span></button>
</form>

</body>
</html>
