<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";

$erreur=false;

$cnx = new Bdd();
$bdd = $cnx->getBdd();

if(isset($_POST['inscription'])) {
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $etudiant = new Etudiant(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'mot_de_passe' => $hashed_password,
        'domaine_etude' => $_POST['domaine']
    ));
//    var_dump($etudiant);
    $inscription=$etudiant->inscription($bdd);
//    var_dump($inscription);
    if (!$inscription) $erreur=true;
//    var_dump($erreur);
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
</head>
<body>
    <nav>
        <div class="bottom-row">
            <a href="../../view/etudiant/accueil.php">Accueil</a>
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
        <input type="hidden"> &#9888; Erreur : L'email entré a été dejà pris. Veuillez entrer un autre.
        <a href="../../view/inscription.php">Revenir à la page d'inscription</a>
    </div>
    <div class="container" id="alert"
        <?php
            if (!$inscription) echo 'style="display:none;"';
            else echo 'style="display:block; background-color:#D3DEA5; text-align: center"';
        ?>>
        <input type="hidden"> &#10003; Reussite : Veuillez confirmer votre email

    </div>
</body>
</html>
