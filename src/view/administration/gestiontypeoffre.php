<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/administrateur/Type.php";
$bdd = new Bdd();
$typeoffre = new Type(array());
$typesoffre = $typeoffre->getAllType($bdd);
$page = "";
foreach ($typesoffre as $type){
    $html = "<div style='background-color: lightgray'><h3>".$type['nom']."</h3></div>";
    $page .= $html;
}
?>

<html lang="fr">
<head>
    <title>Gestion Type Offre</title>
</head>
<body>
    <a href="vueadmin.php">Retour</a>
    <?=$page?>
</body>
</html>