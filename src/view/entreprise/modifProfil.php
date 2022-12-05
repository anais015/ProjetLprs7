<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title> Modification Profil </title>

</head>
<body>

<ul>
    <li><a href="page_accueil.php">Accueil</a></li>
    <li><a href="deconnexion.php">Déconnexion</a></li>
</ul>

<h1> Modification de profil </h1>

<form action='../../traitement/entreprise/traitementModifProfilEntreprise.php' method='POST'>
    <label for='nom'><b>Nom :</b></label>
    <input type='text' placeholder='Nom' name='nom'  required>

    <label for='prenom'><b>Prénom :</b></label>
    <input type='text' placeholder='Prénom' name='prenom' required>

    <label for='role_entreprise'><b>Rôle de la société :</b></label>
    <input type='text' placeholder='Rôle' name='role_societe' required>

    <label for='nom_entreprise'><b>Nom de l'entreprise :</b></label>
    <input type='text' placeholder='Nom de l Entreprise' name='nom_entreprise'  required>

    <label for='rue_entreprise'><b>Rue :</b></label>
    <input type='text' placeholder='Rue' name='rue_entreprise'  required>

    <label for='ville_entreprise'><b>Ville :</b></label>
    <input type='text' placeholder='Ville' name='ville_entreprise'  required>

    <label for='cp_entreprise'><b>Code Postal :</b></label>
    <input type='text' placeholder='Code Postal' name='cp_entreprise'  required>
    <br>
    <button type='submit' name='modifier' id='modification'> Modifier </button>
</form>

</body>
</html>