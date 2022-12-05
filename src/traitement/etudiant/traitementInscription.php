<?php
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Mail.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";

$erreur=false;
$mail = new Mail();
$cnx = new Bdd();
$bdd = $cnx->getBdd();

if(isset($_POST['inscription'])) {
    $etudiant = new Etudiant(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'mot_de_passe' => $_POST['password'],
        'domaine_etude' => $_POST['domaine']
    ));
//    var_dump($etudiant);
    $inscription=$etudiant->inscription($bdd);
//    var_dump($inscription);
    if ($inscription){
        echo '
                <script>
                    window.location.href = "../../view/inscription.php"; 
                    alert("Votre compte a été créé. Veuillez patienter pour la validation de votre compte.");
                </script>';
        $mail->sendMail($_POST['email'],"Bienvenue sur LPRS!","Votre inscription étudiant à bien été éffectué et un administrateur doit validé votre compte avant de pouvoir vous connecter!<br><br>Le service LPRS");
    }
    else {
        echo '
                <script>
                    window.location.href = "../../view/inscription.php"; 
                    alert("Erreur !");
                </script>';
    }
}
?>