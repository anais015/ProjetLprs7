<?php
$table="";
$placeHolder='Choissisez une option';
if(isset($_POST['selectIdentity'])) {
    if ($_POST['selectIdentity'] == 'administrateur') {
        $placeHolder = 'Administrateur';
        $table .= "
                <form action='../traitement/administration/inscriptionadmin.php' method='POST'>    
                <label for='nom'><b>Nom</b></label>
                <input type='text' placeholder='Nom' name='nom'  required>
                
                <label for='prenom'><b>Prénom</b></label>
                <input type='text' placeholder='Prénom' name='prenom' required>
                
                <label for='email'><b>Email</b></label>
                <input type='email' placeholder='Email' name='email' required>

                <label for='password'><b>Mot de passe</b></label>
                <input type='password' placeholder='Password' name='password' required>
                <input type='submit' name='inscription' id='inscription'>
            </form>";
    }
    if ($_POST['selectIdentity'] == 'entreprise') {
        $placeHolder = 'Entreprise';
        $table .= "
                <form action='../traitement/entreprise/traitementInscriptionEntreprise.php' method='POST'>    
                <label for='nom'><b>Nom</b></label>
                <input type='text' placeholder='Nom' name='nom'  required>
                
                <label for='prenom'><b>Prénom</b></label>
                <input type='text' placeholder='Prénom' name='prenom' required>
                
                <label for='role_entreprise'><b>Rôle de la société</b></label>
                <input type='text' placeholder='Role' name='role_societe' required>
                
                <label for='nom_entreprise'><b>Nom Entreprise</b></label>
                <input type='text' placeholder='Nom de l Entreprise' name='nom_entreprise'  required>
                
                <label for='rue_entreprise'><b>Rue</b></label>
                <input type='text' placeholder='Rue' name='rue_entreprise'  required>
                
                <label for='ville_entreprise'><b>Ville</b></label>
                <input type='text' placeholder='Ville' name='ville_entreprise'  required>
                
                <label for='cp_entreprise'><b>Code Postal</b></label>
                <input type='text' placeholder='Code Postal' name='cp_entreprise'  required>
                
                <label for='email'><b>Email</b></label>
                <input type='email' placeholder='Email' name='email' required>

                <label for='mot_de_passe'><b>Mot de passe</b></label>
                <input type='password' placeholder='Mot de passe' name='mot_de_passe' required>
                <input type='submit' name='inscription' id='inscription'>
            </form>";
    }

    if ($_POST['selectIdentity'] == 'etudiant') {
        $placeHolder = 'Etudiant';
        $table .= "
                <form action='../traitement/etudiant/traitementInscription.php' method='POST'>    
                <label for='nom'><b>Nom</b></label>
                <input type='text' placeholder='Nom' name='nom'  required>
                
                <label for='prenom'><b>Prénom</b></label>
                <input type='text' placeholder='Prénom' name='prenom' required>
                
                <label for='domaine'><b>Domaine</b></label>
                <input type='text' placeholder=\"Domaine d'étude\" name='domaine' required>
                
                <label for='email'><b>Email</b></label>
                <input type='email' placeholder='Email' name='email' required>

                <label for='password'><b>Mot de passe</b></label>
                <input type='password' placeholder='Password' name='password' required>
                <input type='submit' name='inscription' id='inscription'>
            </form>";
    }
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
            <?=$table;?>

        </div>
    </div>
</div>
</body>
</html>
