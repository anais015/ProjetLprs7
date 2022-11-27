<?php
session_start();
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";
require_once "../../model/evenement/Evenement.php";

$erreur=false;
$modifie=false;

$cnx = new Bdd();
$bdd = $cnx->getBdd();

$etudiant = new Etudiant(array('id'=>$_SESSION['etudiant']['id_etudiant']));
$selectedEtudiant=$etudiant->selectParId($bdd);

if (isset($_POST['modifierInfo'])){
    $etudiant = new Etudiant(array(
        'nom'=> $_POST['nom'],
        'prenom'=> $_POST['prenom'],
        'domaine_etude'=> $_POST['domaine'],
        'id'=>$_SESSION['etudiant']['id_etudiant']
    ));
    $modifierInfo=$etudiant->modifierInfo($bdd);
    if ($modifierInfo) {
            echo '
                <script>
                    window.location.href = "../../view/etudiant/monCompte.php"; 
                    alert("Modification enregistrée");
                </script>';
    }
    else echo '<script>alert("Erreur")</script>';
}
if (isset($_POST['modifierEmail'])){
    $etudiant = new Etudiant(array(
        'email'=>$_POST['email'],
        'id'=>$_SESSION['etudiant']['id_etudiant']
    ));
    $modifierEmail=$etudiant->modifierEmail($bdd,$_POST['pw']);
    if (!$modifierEmail) $erreur=true;
    else $modifie=true;
}
if (isset($_POST['modifierPw'])){
    $password = $_POST['new'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $etudiant = new Etudiant(array(
        'mot_de_passe'=> $hashed_password,
        'id'=>$_SESSION['etudiant']['id_etudiant']
    ));
    $modifierPw=$etudiant->modifierPw($bdd,$_POST['old']);
    if (!$modifierPw) $erreur=true;
    else $modifie=true;
}
?>


