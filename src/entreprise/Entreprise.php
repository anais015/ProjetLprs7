<?php
require_once '../Utilisateur.php';

class Entreprise extends Utilisateur
{
    private $nom_entreprise;
    private $rue_entreprise;
    private $ville_entreprise;
    private $cp_entreprise;
    private $role_societe;
    private $valide;

    public function __construct($id,$nom,$prenom,$email,$password,$nom_entreprise,$cp_entreprise,$role_societe,$rue_entreprise,$ville_entreprise,$valide){

        parent::__construct($id,$nom,$prenom,$email,$password);

        $this->setId($id);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setEmail($email);
        $this->setPassword($password);

        $this->setNomEntreprise($nom_entreprise);
        $this->setRueEntreprise($rue_entreprise);
        $this->setCpEntreprise($cp_entreprise);
        $this->setRoleSociete($role_societe);
        $this->setValide($valide);
        $this->setVilleEntreprise($ville_entreprise);

    }

    /**
     * @return mixed
     */
    public function getNomEntreprise()
    {
        return $this->nom_entreprise;
    }

    /**
     * @param mixed $nom_entreprise
     */
    public function setNomEntreprise($nom_entreprise)
    {
        $this->nom_entreprise = $nom_entreprise;
    }

    /**
     * @return mixed
     */
    public function getRueEntreprise()
    {
        return $this->rue_entreprise;
    }

    /**
     * @param mixed $rue_entreprise
     */
    public function setRueEntreprise($rue_entreprise)
    {
        $this->rue_entreprise = $rue_entreprise;
    }

    /**
     * @return mixed
     */
    public function getVilleEntreprise()
    {
        return $this->ville_entreprise;
    }

    /**
     * @param mixed $ville_entreprise
     */
    public function setVilleEntreprise($ville_entreprise)
    {
        $this->ville_entreprise = $ville_entreprise;
    }

    /**
     * @return mixed
     */
    public function getCpEntreprise()
    {
        return $this->cp_entreprise;
    }

    /**
     * @param mixed $cp_entreprise
     */
    public function setCpEntreprise($cp_entreprise)
    {
        $this->cp_entreprise = $cp_entreprise;
    }

    /**
     * @return mixed
     */
    public function getRoleSociete()
    {
        return $this->role_societe;
    }

    /**
     * @param mixed $role_societe
     */
    public function setRoleSociete($role_societe)
    {
        $this->role_societe = $role_societe;
    }

    /**
     * @return mixed
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * @param mixed $valide
     */
    public function setValide($valide)
    {
        $this->valide = $valide;
    }


}