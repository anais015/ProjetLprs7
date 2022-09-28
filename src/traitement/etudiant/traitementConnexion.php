<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";

$erreur=false;

$cnx = new Bdd();
$bdd = $cnx->getBdd();
//var_dump($_POST);

if(isset($_POST['connexion'])) {
//    $password = $_POST['password'];
//    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $etudiant = new Etudiant(array(
        'email' => $_POST['email'],
//        'mot_de_passe' => $hashed_password
    ));
    var_dump($etudiant);
    $connexion=$etudiant->connexion($bdd,$_POST['password']);
    var_dump($connexion);
//    if (!$inscription) $erreur=true;
//    var_dump($erreur);
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
<div class="container" id="alert"
    <?php
    if (!$connexion) header("location:../../view/etudiant/accueil.php")
    ?>

</div>
</body>
</html>