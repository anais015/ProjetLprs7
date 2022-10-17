<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Organiser un événement </title>
    <link rel="stylesheet" href="../../style/styleEntreprise.css">
</head>
<body>

<ul>
    <li><a href="page_accueil.php">Accueil</a></li>
    <li><a href="modifProfil.php">Modification de profil</a></li>
    <li><a href="../contact.php">Contact</a></li>
    <li><a href="deconnexion.php">Déconnexion</a></li>
</ul>

<h1>Création d'un événement</h1>

<form action='../../traitement/entreprise/traitementCreerEvent.php' method='POST'>
    <label for='nom'><b>Nom de l'événement :</b></label>
    <input type='text' placeholder='Nom' name='nom'  required>

    <label for='description'><b>Description de l'événement :</b></label>
    <input type='text' placeholder='description' name='description' id="description" required>

    <label for='date'><b>Date de l'événement :</b></label>
    <input type='date' placeholder='date' name='date' required>

    <label for='heure'><b>Heure du commencement : </b></label>
    <input type='time' placeholder='heure' name='heure' min="07:00" max="20:00" required>
    <small> Un événement ne peut que commencer à 7h !</small>

    <label for='duree'><b>Durée de l'événement :</b></label>
    <input type='time' placeholder='duree' name='duree'  required>
    <br>
    <button type='submit' name='creer' id='creer'>Créer</button>
</form>

</body>
</html>
