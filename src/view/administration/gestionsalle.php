<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Salle.php";
$bdd = new Bdd();
$salle = new Salle(array());
$salles = $salle->getAllSalle($bdd);
$page = "";
$table = "<table><thead><tr><th>ID</th><th>Nom</th><th>Capacité</th><th>Supprimer</th></tr></thead><tbody>";
foreach ($salles as $salle){
    $table .= "<tr><td>".$salle['id_salle']."</td><td>".$salle['nom']."</td><td>".$salle['nombre_place']."</td><td><form action='../../traitement/administration/supprimersalle.php' method='post'><input hidden value='".$salle['id_salle']."'><button type='submit'>Supprimer</button></form></td>";
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