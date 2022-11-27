<?php
session_start();

require_once "../../model/bdd/Bdd.php";
require_once "../../model/Utilisateur.php";
require_once "../../model/etudiant/Etudiant.php";
require_once "../../model/Connexion.php";

$erreur=false;

$cnx = new Bdd();
$bdd = $cnx->getBdd();
//var_dump($_POST);

if(isset($_POST['connexion'])) {
    $etudiant = new Etudiant(array(
        'email' => $_POST['email'],
    ));
    //var_dump($etudiant);
    $connexion=$etudiant->connexion($bdd,$_POST['password']);
    //var_dump($connexion);

    if ($connexion){
        $_SESSION['etudiant']=$connexion;
        sleep(2     );
        echo '
                <script>
                    window.location.href = "../../view/etudiant/accueil.php"; 
                </script>';
    } else {
        echo '
                <script>
                    window.location.href = "../../view/connexion.php"; 
                    alert("Erreur !");
                </script>';
    }
}

?>

