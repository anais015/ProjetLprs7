<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/administrateur/Type.php";
$bdd = new Bdd();
$typeoffre = new Type(array());
$typesoffre = $typeoffre->getAllType($bdd);
$page = "";
$table = "<table><thead><tr><th>ID</th><th>Nom</th></tr></thead><tbody>";
foreach ($typesoffre as $type){
    $table .= "<tr>
                <td>".$type['id_type']."</td>
                <td>".$type['nom']."</td>
                <td>
                <form action='../../traitement/administration/supprimersalle.php' method='post'>
                    <input hidden value='".$type['id_type']."'>
                    <button type='submit'>Supprimer</button>
                </form>
                </td>";
}
$table .= "</tbody></table>";
?>

<html lang="fr">
<head>
    <title>Gestion Type Offre</title>
</head>
<body>
    <a href="vueadmin.php">Retour</a>
    <a href="ajouttypeoffre.php"><button>Ajouter Type D'offre</button></a>
    <?=$table?>
</body>
</html>