<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Mail.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/entreprise/Entreprise.php";
$bdd = new Bdd();
$mail = new Mail();
var_dump($_POST);

if (isset($_POST['validate'])){
    if(isset($_POST['id_etudiant'])) {
        $etudiant = new Etudiant(array(
            'id' => $_POST['id_etudiant'],
        ));
        $etudiant->validerCompte($bdd, $mail);
    }
    if(isset($_POST['id_entreprise'])) {
        $entreprise = new Entreprise(array(
            'id' => $_POST['id_entreprise'],
        ));
        $entreprise->validerCompte($bdd,$mail);
    }
}else{
    if(isset($_POST['id_etudiant'])) {
        $etudiant = new Etudiant(array(
            'id' => $_POST['id_etudiant']
        ));
        $mail->sendMail($_POST['email'],"Rejection de votre compte","Bonjour<br>Votre inscription étudiante sur LPRS à été refusé pour une raison quelconque ");
        $etudiant->deleteAccount($bdd);
    }
    if(isset($_POST['id_entreprise'])) {
        $entreprise = new Entreprise(array(
            'id' => $_POST['id_entreprise']
        ));
        $mail->sendMail($_POST['email'],"Rejection de votre compte","Bonjour<br>Votre inscription entreprise sur LPRS à été refusé pour une raison quelconque ");
        $entreprise->deleteAccount($bdd);
    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>