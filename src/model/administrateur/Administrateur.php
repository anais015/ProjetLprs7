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

    public function ajoutAdmin(BDD $bdd){
        $req=$bdd->getBdd()->prepare('INSERT INTO administrateur(nom,prenom,email,mot_de_passe) VALUES (:nom,:prenom,:mail,:password)');
        $req->execute(array(
            "nom"=>$this->getNom(),
            "prenom"=>$this->getPrenom(),
            "mail"=>$this->getEmail(),
            "mdp"=>$this->getMot_de_passe()
        ));
    }
}