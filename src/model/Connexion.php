<?php

class  Connexion
{
    private $idconnexion;
    private $refetudiant;
    private $refadministrateur;
    private $refentreprise;

    public function __construct(array $donnees){
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

    public function getIdconnexion()
    {
        return $this->idconnexion;
    }

    public function setIdconnexion($idconnexion)
    {
        $this->idconnexion = $idconnexion;
    }

    public function getRefetudiant()
    {
        return $this->refetudiant;
    }

    public function setRefetudiant($refetudiant)
    {
        $this->refetudiant = $refetudiant;
    }

    public function getRefadministrateur()
    {
        return $this->refadministrateur;
    }

    public function setRefadministrateur($refadministrateur)
    {
        $this->refadministrateur = $refadministrateur;
    }

    public function getRefentreprise()
    {
        return $this->refentreprise;
    }

    public function setRefentreprise($refentreprise)
    {
        $this->refentreprise = $refentreprise;
    }

    public function ajoutConnexionEtudiant($bdd){
        $req=$bdd->prepare('INSERT INTO connexion(date, heure, ref_etudiant) VALUES (CURDATE(),CURTIME(),:refetudiant)');
        $execute = $req->execute(array(
            "refetudiant"=>$this->getRefetudiant()
        ));
        if ($execute) return true;
        else return false;
    }

    public function ajoutConnexionEntreprise($bdd){
        $req=$bdd->prepare('INSERT INTO connexion(date, heure, ref_entreprise) VALUES (CURDATE(),CURTIME(),:refentreprise)');
        $req->execute(array(
            "refentreprise"=>$this->getRefentreprise()
        ));
    }

    public function ajoutConnexionAdministrateur($bdd){
        $req=$bdd->prepare('INSERT INTO connexion(date, heure, ref_administrateur) VALUES (CURDATE(),CURTIME(),:refadministrateur)');
        $req->execute(array(
            "refadministrateur"=>$this->getRefadministrateur()
        ));
    }

}