<?php

require_once "../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
require_once "../model/Mail.php";
require_once "../model/entreprise/Entreprise.php";
require_once "../model/evenement/Evenement.php";
require_once "../model/administrateur/Administrateur.php";
require_once "../model/bdd/Bdd.php";

$bdd = new Bdd();
$cnx = $bdd->getBdd();

if ($_POST['selectIdentity'] === 'etudiant'){
    $etudiant = new Etudiant(array(
            "email"=>$_POST['email']
    ));
    $etudiant->newCode($cnx);
}elseif ($_POST['selectIdentity'] === 'entreprise'){
    $entreprise = new Entreprise(array(
        "email"=>$_POST['email']
    ));
    $entreprise->newCode($cnx);
}elseif($_POST['selectIdentity'] === 'entreprise') {
    $admin = new Administrateur(array(
        "email" => $_POST['email']
    ));
    $admin->newCode($cnx);
}
?>
<form action="" method="post">
    <select name="selectIdentity" id="selectIdentity" class="form-control" required>
        <option selected hidden disabled>Vous êtes ?</option>
        <option value="administrateur">Administrateur</option>
        <option value="entreprise">Entreprise</option>
        <option value="etudiant">Etudiant</option>
    </select>
<input name="email">
<button type="submit">mdpoublie</button>
</form>

