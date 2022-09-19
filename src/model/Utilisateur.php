<?php

abstract class Utilisateur
{
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $mot_de_passe;

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

    protected function setNom($nom)
    {
        $this->nom = $nom;
    }

    protected function getPrenom()
    {
        return $this->prenom;
    }

    protected function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    protected function getEmail()
    {
        return $this->email;
    }

    protected function setEmail($email)
    {
        $this->email = $email;
    }

    protected function getMot_de_passe()
    {
        return $this->mot_de_passe;
    }

    protected function setMot_de_passe($mot_de_passe)
    {
        $this->mot_de_passe = $mot_de_passe;
    }

}