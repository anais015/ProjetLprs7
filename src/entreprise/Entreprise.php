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

    public function __construct(array $donnees){

        parent::__construct($donnees);

    }

    /**
     * @return mixed
     */
    public function getNom_entreprise()
    {
        return $this->nom_entreprise;
    }

    /**
     * @param mixed $nom_entreprise
     */
    public function setNom_entreprise($nom_entreprise)
    {
        $this->nom_entreprise = $nom_entreprise;
    }

    /**
     * @return mixed
     */
    public function getRue_entreprise()
    {
        return $this->rue_entreprise;
    }

    /**
     * @param mixed $rue_entreprise
     */
    public function setRue_entreprise($rue_entreprise)
    {
        $this->rue_entreprise = $rue_entreprise;
    }

    /**
     * @return mixed
     */
    public function getVille_entreprise()
    {
        return $this->ville_entreprise;
    }

    /**
     * @param mixed $ville_entreprise
     */
    public function setVille_entreprise($ville_entreprise)
    {
        $this->ville_entreprise = $ville_entreprise;
    }

    /**
     * @return mixed
     */
    public function getCp_entreprise()
    {
        return $this->cp_entreprise;
    }

    /**
     * @param mixed $cp_entreprise
     */
    public function setCp_entreprise($cp_entreprise)
    {
        $this->cp_entreprise = $cp_entreprise;
    }

    /**
     * @return mixed
     */
    public function getRole_societe()
    {
        return $this->role_societe;
    }

    /**
     * @param mixed $role_societe
     */
    public function setRole_societe($role_societe)
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