<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/entreprise/Entreprise.php";
$bdd = new Bdd();
$etudiant = new Etudiant(array());
$entreprise = new Entreprise(array());
$pendingaccounts = $etudiant->getPendingAccount($bdd) + $entreprise->getPendingAccount($bdd); #ajouter méthode pour avoir les event en attente de validation;
if (count($pendingaccounts)>=1){
    $page = "<b>Liste des comptes en attentes</b>";
    foreach ($pendingaccounts as $account) {
        $html = "<div style='background-color: lightgray'><h3>".$account['nom']."</h3><br><p>".$account['description']."</p></div>";
        $page .= $html;
    }
}else{
    $page = "Pas de compte en attente";
}
?>
<html lang="fr">
<head>

    <title>Validation Compte</title>
</head>
<body>
    <a href="vueadmin.php">Retour</a>
    <?=$page?>
</body>
</html>
