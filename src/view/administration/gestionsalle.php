<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Salle.php";
$bdd = new Bdd();
$salle = new Salle(array());
$salles = $salle->getAllSalle($bdd);
$page = "";
$table = "<table><thead><tr><th>ID</th><th>Nom</th><th>Capacité</th></tr></thead><tbody>";
foreach ($salles as $salle){
    $table .= "<tr><td>".$salle['idsalle']."</td><td>".$salle['nom']."</td><td>".$salle['nombre_place']."</td>";
}
$table .= "</tbody></table>";
?>

<html lang="fr">
<head>
    <title>Gestion Type Offre</title>
</head>
<body>
<a href="vueadmin.php">Retour</a>
<a href="ajoutsalle.php"><button>Ajouter Salle</button></a>
<?=$table?>
</body>
</html>