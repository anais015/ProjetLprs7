<?php

class Offre
{
    private $id;
    private $titre;
    private $description;
    private $domaine;
    private $accepte;
    private $refType;

    /**
     * @param $id
     * @param $titre
     * @param $description
     * @param $domaine
     * @param $accepte
     */

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function affichage($bdd){
        $sql='SELECT * FROM offre';
        $req = $bdd->prepare($sql);
        $execute = $req->execute(array(
        ));
        return $req->fetchall();
    }

    public function creation($bdd){
        $sql='INSERT INTO offre (titre, description, domaine, refType) 
        VALUES :titre, :description, :domaine, :ref_type';
        $req = $bdd->prepare($sql);
        $execute=$req->execute(array(
            'titre' => $this->titre,
            'description' => $this->description,
            'domaine' =>$this->domaine,
            'refType' => $this->refType
        ));
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDomaine()
    {
        return $this->domaine;
    }

    /**
     * @param mixed $domaine
     */
    public function setDomaine($domaine)
    {
        $this->domaine = $domaine;
    }

    /**
     * @return mixed
     */
    public function getAccepte()
    {
        return $this->accepte;
    }

    /**
     * @param mixed $accepte
     */
    public function setAccepte($accepte)
    {
        $this->accepte = $accepte;
    }

    /**
     * @return mixed
     */
    public function getRefType()
    {
        return $this->refType;
    }

    /**
     * @param mixed $refType
     */
    public function setRefType($refType): void
    {
        $this->refType = $refType;
    }

}