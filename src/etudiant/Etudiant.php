<?php

class Etudiant extends Utilisateur
{
    private $domaine_etude;
    private $valide;

    public function __construct(array $donnees){
        parent::__construct($donnees);
    }

    public function inscription($bdd){
        $sql ='SELECT * FROM etudiant WHERE email = :email ';
        $request = $bdd->prepare($sql);
        $execute = $request->execute(array('email'=> $this->email));
        if($execute) {
            $result = $request->fetch();
            if (is_array($result)) return false;
        }
        else {
            $sql='INSERT INTO etudiant (nom, prenom, email, mot_de_passe, domaine_etude) VALUES (:nom, :prenom, :email, :mot_de_passe, :domaine_etude)';
            $request = $bdd->prepare($sql);
            $execute=$request->execute(array(
                'nom'=> $this->nom,
                'prenom'=> $this->prenom,
                'email'=> $this->email,
                'mot_de_passe'=> $this->mot_de_passe,
                'domaine_etude'=> $this->domaine_etude
            ));
            if($execute)return true;
            else return false;
        }
    }
}