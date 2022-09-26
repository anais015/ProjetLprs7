<?php
if(isset($_SESSION['id_admin'])){
    $page="";
}else{
    $page = "Vous n'êtes pas connecté en tant qu'administrateur";
}
?>
<html lang="fr">
<head>
    <title>Administrateur</title>
</head>
<body>
    <div style="margin: auto 0;text-align: center;">
        <?=$page;?><br>
        <a href="attributionsalle.php">Attribution de salle</a>
    </div>
</body>
</html>