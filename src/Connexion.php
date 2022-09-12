<?php

class Connexion
{
    private $idconnexion;
    private $date;
    private $heure;
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
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param mixed $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
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