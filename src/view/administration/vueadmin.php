<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/evenement/Evenement.php";
require_once "../../model/etudiant/Etudiant.php";
$bdd = new Bdd();
$evenement = new Evenement(array());
$entreprise = new Entreprise(array());
$etudiant = new Etudiant(array());
$pendingevents = $evenement->getPendingEvent($bdd);
$countpe = count($pendingevents);
$pendingaccounts = $etudiant->getPendingAccount($bdd) + $entreprise->getPendingAccount($bdd);
$countpa = count($pendingaccounts);
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
    <a href="../../../index.php">Retour</a>
    <div style="margin: auto 0;text-align: center;">
        <?=$page;?><br>
        <a href="attributionsalle.php">Attribution de salle en attente (<?=$countpe?>)</a><br>
        <a href="validationcompte.php">Validation des compte en attente (<?=$countpa?>)</a>
    </div>
</body>
</html>