<?php
session_start();

require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";

$erreur=false;

$cnx = new Bdd();
$bdd = $cnx->getBdd();
//var_dump($_POST);

if(isset($_POST['connexion'])) {
    $etudiant = new Etudiant(array(
        'email' => $_POST['email'],
    ));
//    var_dump($etudiant);
    $connexion=$etudiant->connexion($bdd,$_POST['password']);
    var_dump($connexion);

    if ($connexion) {
        $_SESSION['etudiant']=$connexion;
        header("location:../../view/etudiant/accueil.php");
    } else $erreur=true;
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
</head>
<body>
<nav>
    <div class="bottom-row">
        <a href="../../../index.php">Accueil</a>
        <a href="../../view/connexion.php">Se Connecter</a>
        <a href="../../view/inscription.php">S'inscrire</a>
        <a href="#">Contact</a>
    </div>
</nav>
<div class="container">
    <div class="container" id="alert"
    <?php
    if (!$erreur) echo 'style="display:none;"';
    else echo 'style="display:block; background-color:#f8bdc1; text-align: center"';
    ?>
    <input type="hidden"> &#9888; Erreur : Veuillez réessayer.
    <a href="../../view/connexion.php">Revenir à la page de connexion</a>
</div>

</body>
</html>
