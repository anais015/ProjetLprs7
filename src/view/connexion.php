<?php
$cible="";
$placeHolder='Choissisez une option';
if(isset($_POST['selectIdentity'])) {
    if ($_POST['selectIdentity'] == 'administrateur') {
        $placeHolder = 'Administrateur';
        $cible .="";

    }
    if ($_POST['selectIdentity'] == 'entreprise') {
        $placeHolder = 'Entreprise';
        $cible .="";
    }

    if ($_POST['selectIdentity'] == 'etudiant') {
        $placeHolder = 'Etudiant';
        $cible .="";
    }
    else $cible .="#";
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
        <a href="../../index.php">Accueil</a>
        <a href="connexion.php">Se Connecter</a>
        <a href="inscription.php">S'inscrire</a>
        <a href="#">Contact</a>
    </div>
</nav>

<div>
    <div class="modal-content">
        <div class="container">
            <form action="" method="post">
                <label for="selectIdentity"><b>Vous êtes :</b></label>
                <select name="selectIdentity" id="selectIdentity" required onchange="this.form.submit()">
                    <option selected hidden disabled><?=$placeHolder;?></option>
                    <option value="administrateur">Administrateur</option>
                    <option value="entreprise">Entreprise</option>
                    <option value="etudiant">Etudiant</option>
                </select>
            </form>
            <form action='<?=$cible?>' method='POST'>
                <label for='email'><b>Email</b></label>
                <input type='email' placeholder='Email' name='email' required>

                <label for='password'><b>Mot de passe</b></label>
                <input type='password' placeholder='Password' name='password' required>

                <input type='submit' name='connexion' id='connexion'>
            </form>
        </div>
    </div>
</div>
</body>
</html>
