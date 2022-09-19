<?php

class Rdv
{
    private $id;
    private $date;
    private $heure;
    private $lieu;
    private $accepte;
    private $refOffre;
    private $refEntreprise;
    private $refEtudiant;

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

    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date): void {
        $this->date = $date;
    }

    public function getHeure() {
        return $this->heure;
    }

    public function setHeure($heure): void {
        $this->heure = $heure;
    }

    public function getLieu() {
        return $this->lieu;
    }

    public function setLieu($lieu): void {
        $this->lieu = $lieu;
    }

    public function getAccepte() {
        return $this->accepte;
    }

    public function setAccepte($accepte): void {
        $this->accepte = $accepte;
    }

    public function getRefOffre() {
        return $this->refOffre;
    }

    public function setRefOffre($refOffre): void {
        $this->refOffre = $refOffre;
    }

    public function getRefEntreprise() {
        return $this->refEntreprise;
    }

    public function setRefEntreprise($refEntreprise): void {
        $this->refEntreprise = $refEntreprise;
    }

    public function getRefEtudiant() {
        return $this->refEtudiant;
    }

    public function setRefEtudiant($refEtudiant): void {
        $this->refEtudiant = $refEtudiant;
    }

}