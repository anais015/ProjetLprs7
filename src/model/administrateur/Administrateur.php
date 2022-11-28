<?php

class Administrateur extends Utilisateur
{
    public function __construct(array $donnees){
        parent::__construct($donnees);
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees){
        foreach ($donnees as $key => $value){
            $method='set'.ucfirst($key);
            if (method_exists($this,$method)){
                $this->$method($value);
            }
        }
    }

    public function inscription(BDD $bdd){
        $req=$bdd->getBdd()->prepare('SELECT * FROM administrateur WHERE email=:email');
        $req->execute(array("email"=>$this->getEmail()));
        $res=$req->fetch();

        if (is_array($res)){
            session_start();
            $_SESSION['err_message'] = "Adresse email déjà inscrite";
            return false;
        }else{
            $req=$bdd->getBdd()->prepare('INSERT INTO administrateur(nom,prenom,email,mot_de_passe) VALUES (:nom,:prenom,:mail,:password)');
            $req->execute(array(
                "nom"=>$this->getNom(),
                "prenom"=>$this->getPrenom(),
                "mail"=>$this->getEmail(),
                "password"=>$this->getMot_de_passe()
            ));
            return true;
        }
    }

    public function connexion(BDD $bdd, $mdpsaisi){
        $req=$bdd->getBdd()->prepare('SELECT * FROM administrateur WHERE email=:email');
        $req->execute(array("email"=>$this->getEmail()));
        $res=$req->fetch();

        if (is_array($res)){
            if (password_verify($mdpsaisi, $res['mot_de_passe'])){
                $conn = new Connexion(array('refadministrateur'=>$res['id_administrateur']));
                $conn->ajoutConnexionAdministrateur($bdd);
                return $res;
            }else return $res;
        }else return $res;
    }
}