<?php

class Type
{
    private $idtype;
    private $nom;
    private $refadmin;

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

    public function getAllType(BDD $bdd){
        $req = $bdd->getBdd()->query('SELECT * FROM type');
        return $req->fetchAll();
    }

    /**
     * @return mixed
     */
    public function getIdtype()
    {
        return $this->idtype;
    }

    /**
     * @param mixed $idtype
     */
    public function setIdtype($idtype)
    {
        $this->idtype = $idtype;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getRefadmin()
    {
        return $this->refadmin;
    }

    /**
     * @param mixed $refadmin
     */
    public function setRefadmin($refadmin)
    {
        $this->refadmin = $refadmin;
    }
}