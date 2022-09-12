<?php

abstract class Utilisateur
{
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;

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

    protected function getPassword()
    {
        return $this->password;
    }

    protected function setPassword($password)
    {
        $this->password = $password;
    }

}