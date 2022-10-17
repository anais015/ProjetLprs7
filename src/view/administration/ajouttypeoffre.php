<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/administrateur/Type.php";
$bdd = new Bdd();
$typeoffre = new Type(array());
?>

<html lang="fr">
<head>
    <title>Gestion Type Offre</title>
</head>
<body>
<a href="gestiontypeoffre.php">Retour</a>
<form action="../../traitement/administration/ajouttypeoffre.php" method="post">
    <label>Nom :
        <input type="text" name="nom" placeholder="Nom">
    </label>
    <button type="submit">Submit</button>
</form>
</body>
</html>