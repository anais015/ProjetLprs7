<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Salle.php";
$bdd = new Bdd();
$salle = new Salle(array());
?>

<html lang="fr">
<head>
    <title>Gestion Type Offre</title>
</head>
<body>
<a href="vueadmin.php">Retour</a>
<form action="../../traitement/administration/ajoutsalle.php" method="post">
    <label>Nom :
        <input type="text" name="nom" placeholder="Nom">
    </label><br>
    <label>Nombre de place :
        <input type="number" name="nombre_place">
    </label>
    <button type="submit">Submit</button>
</form>
</body>
</html>