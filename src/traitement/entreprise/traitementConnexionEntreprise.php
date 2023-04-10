<?php

session_start();

require_once "../../model/Utilisateur.php"; // D'abord instancier Utilisateur puis le reste !!
require_once "../../model/entreprise/Entreprise.php";
require_once "../../model/bdd/Bdd.php";
require_once "../../model/Connexion.php";

$connexion = new Bdd();
$bdd = $connexion->getBdd();

if(isset($_POST['connexion'])) {
    $entreprise = new Entreprise(array(
        'email' => $_POST['email']
    ));

    //var_dump($_POST);
    $co = $entreprise->connexion($bdd, $_POST['password']);
    //var_dump($co);

        $_SESSION['entreprise'] = $co;

        echo "<script>
            window.location.href = \"../../view/entreprise/page_accueil.php\";
            alert(\"Connexion !\")
            </script>";


    } else {

        echo "<script>
            window.location.href = \"../../view/connexion.php\";
            alert(\"Echec de la connection, Email ou Mot de passe incorrecte, réessayer !\")
             </script>";

}

?>