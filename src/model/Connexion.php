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

    public function ajoutConnexionEtudiant(BDD $bdd){
        $req=$bdd->getBdd()->prepare('INSERT INTO connexion(date, heure, refetudiant) VALUES (CURDATE(),CURTIME(),:refetudiant)');
        $req->execute(array(
            "refetudiant"=>$this->getRefetudiant()
        ));
    }

    public function ajoutConnexionEntreprise(BDD $bdd){
        $req=$bdd->getBdd()->prepare('INSERT INTO connexion(date, heure, refentreprise) VALUES (CURDATE(),CURTIME(),:refentreprise)');
        $req->execute(array(
            "refentreprise"=>$this->getRefentreprise()
        ));
    }

    public function ajoutConnexionAdministrateur(BDD $bdd){
        $req=$bdd->getBdd()->prepare('INSERT INTO connexion(date, heure, refadministrateur) VALUES (CURDATE(),CURTIME(),:refadministrateur)');
        $req->execute(array(
            "refadministrateur"=>$this->getRefadministrateur()
        ));
    }

    /**
     * @return mixed
     */
    public function getIdconnexion()
    {
        return $this->idconnexion;
    }

    /**
     * @param mixed $idconnexion
     */
    public function setIdconnexion($idconnexion)
    {
        $this->idconnexion = $idconnexion;
    }

    /**
     * @return mixed
     */
    public function getRefetudiant()
    {
        return $this->refetudiant;
    }

    /**
     * @param mixed $refetudiant
     */
    public function setRefetudiant($refetudiant)
    {
        $this->refetudiant = $refetudiant;
    }

    /**
     * @return mixed
     */
    public function getRefadministrateur()
    {
        return $this->refadministrateur;
    }

    /**
     * @param mixed $refadministrateur
     */
    public function setRefadministrateur($refadministrateur)
    {
        $this->refadministrateur = $refadministrateur;
    }

    /**
     * @return mixed
     */
    public function getRefentreprise()
    {
        return $this->refentreprise;
    }

    /**
     * @param mixed $refentreprise
     */
    public function setRefentreprise($refentreprise)
    {
        $this->refentreprise = $refentreprise;
    }
}