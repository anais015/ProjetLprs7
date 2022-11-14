<?php

abstract class Utilisateur
{
    protected ?int $id=null;
    protected ?string $nom=null;
    protected ?string $prenom=null;
    protected ?string $email=null;
    protected ?string $mot_de_passe=null;


    protected function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    protected function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    protected function getId()
    {
        return $this->id;
    }

    protected function setId($id)
    {
        $this->id = $id;
    }

    protected function getNom()
    {
        return $this->nom;
    }

    protected function setNom(string $nom)
    {
        $nom=trim($nom);
        if(strlen($nom)<50 && strlen($nom)>0){
            $this->nom = $nom;
            return true;
        }
        return false;
     }

    protected function getPrenom()
    {
        return $this->prenom;
    }

    protected function setPrenom(string $prenom)
    {
        $prenom=trim($prenom);
        if(strlen($prenom)<50 && strlen($prenom)>0){
            $this->prenom = $prenom;
            return true;
        }
        return false;
    }

    protected function getEmail()
    {
        return $this->email;
    }

    protected function setEmail(string $email)
    {
        $this->email = $email;
    }

    protected function getMot_de_passe()
    {
        return $this->mot_de_passe;
    }

    protected function setMot_de_passe(string $mot_de_passe)
    {
        $length = strlen($mot_de_passe);
        $uppercase = preg_match('/[A-Z]/', $mot_de_passe);
        $lowercase = preg_match('/[a-z]/', $mot_de_passe);
        $number    = preg_match('/[0-9]/', $mot_de_passe);
        $specialChars = preg_match('/[^\w]/', $mot_de_passe);

        if($length>=8 && $uppercase && $lowercase && $number && $specialChars){
            $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);
            $this->mot_de_passe = $hashed_password;
            return true;
        }
        return false;
    }

}