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

    public function connexion($bdd){
        $sql='SELECT * FROM entreprise WHERE email=:email AND mot_de_passe=:mot_de_passe AND valide=1';
        $request = $bdd->prepare($sql);
        $execute = $request->execute(array(
            'email'=>$this->email,
            'mot_de_passe'=>$this->mot_de_passe
        ));
        if ($execute){
            $result=$request->fetch();
            if(is_array($result)) return $result;
            else return false;
        }
        else return false;
    }

    public function inscription($bdd){
        $sql ='SELECT * FROM entreprise WHERE email = :email ';
        $request = $bdd->prepare($sql);
        $execute = $request->execute(array('email'=> $this->email));
        if($execute) {
            $result = $request->fetch();
            if (is_array($result)) return false;
        }
        else {
            $sql='INSERT INTO entreprise (nom, prenom ,nom_entreprise, 
                        rue_entreprise, ville_entreprise, cp_entreprise, email, mot_de_passe, role_societe) 
            VALUES (:nom, :prenom, :nom_entreprise, :rue_entreprise, :ville_entreprise, :cp_entreprise, :email, :mot_de_passe, :role_societe)';
            $request = $bdd->prepare($sql);
            $execute=$request->execute(array(
                'nom'=> $this->nom,
                'prenom'=> $this->prenom,
                'nom_entreprise'=> $this->nom_entreprise,
                'rue_entreprise'=> $this->rue_entreprise,
                'ville_entreprise' => $this->ville_entreprise,
                'cp_entreprise' => $this->cp_entreprise,
                'email'=> $this->email,
                'mot_de_passe'=> $this->mot_de_passe,
                'role_societe' => $this->role_societe
            ));
            if($execute)return true;
            else return false;
        }
    }

    public function modification ($bdd){
        $sql = 'UPDATE entreprise SET nom =:nom, prenom=:prenom, nom_entreprise=:nom_entreprise,
                      rue_entreprise=:rue_entreprise, ville_entreprise=:ville_entreprise, cp_entreprise=:cp_entreprise,
                      email=:email, role_societe=:role_societe WHERE id_entreprise =:id_entreprise';
        $request = $bdd->prepare($sql);
        $execute=$request->execute(array(
            'id_entreprise'=>$this->id,
            'nom'=> $this->nom,
            'prenom'=> $this->prenom,
            'nom_entreprise'=> $this->nom_entreprise,
            'rue_entreprise'=> $this->rue_entreprise,
            'ville_entreprise' => $this->ville_entreprise,
            'cp_entreprise' => $this->cp_entreprise,
            'email'=> $this->email,
            'role_societe' => $this->role_societe
        ));
        if($execute) return true;
        else return false;
    }
}