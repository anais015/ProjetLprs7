<?php

session_start();
unset($_SESSION['email']);
unset($_SESSION['mot_de_passe']);
session_destroy();
header('Location: ../../../index.php');

?>

<!doctype html>
<html lang="fr">
<body>
<h1> Vous avez été déconnecté ! </h1>
</body>
</html>
