<?php

class Offre
{
    private $id;
    private $titre;
    private $description;
    private $domaine;
    private $accepte;

    /**
     * @param $id
     * @param $titre
     * @param $description
     * @param $domaine
     * @param $accepte
     */
    public function __construct($id, $titre, $description, $domaine, $accepte)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->domaine = $domaine;
        $this->accepte = $accepte;
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



}