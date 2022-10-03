<?php

class Salle
{
    private $idsalle;
    private $nom;
    private $nombre_place;

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

    public function getAllSalle(BDD $bdd){
        $req = $bdd->getBdd()->query('SELECT * FROM salle');
        return $req->fetchAll();
    }

    public function ajoutSalle(BDD $bdd){
        $req = $bdd->getBdd()->prepare('INSERT INTO salle(nom, nombre_place) VALUES (:nom,:nombre_place)');
        $req->execute(array(
            "nom"=>$this->getNom(),
            "nombre_place"=>$this->getNombrePlace()
        ));
    }


    /**
     * @return mixed
     */
    public function getIdsalle()
    {
        return $this->idsalle;
    }

    /**
     * @param mixed $idsalle
     */
    public function setIdsalle($idsalle)
    {
        $this->idsalle = $idsalle;
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
    public function getNombrePlace()
    {
        return $this->nombre_place;
    }

    /**
     * @param mixed $nombre_place
     */
    public function setNombrePlace($nombre_place)
    {
        $this->nombre_place = $nombre_place;
    }
}