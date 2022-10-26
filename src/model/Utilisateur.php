<?php

abstract class Utilisateur
{
    protected int $id;
    protected ?string $nom;
    protected ?string $prenom;
    protected ?string $email;
    protected ?string $mot_de_passe;

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
        $this->mot_de_passe = $mot_de_passe;
    }

}