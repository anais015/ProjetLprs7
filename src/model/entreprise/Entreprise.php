<?php

class Entreprise extends Utilisateur
{
    private $nom_entreprise;
    private $rue_entreprise;
    private $ville_entreprise;
    private $cp_entreprise;
    private $role_societe;
    private $valide;
    private Evenement $evenement;
    private Rdv $rdv;
    private Connexion $conn;

    public function __construct(array $donnees){
        parent::__construct($donnees);
    }

    public function getPendingAccount(Bdd $bdd){
        $req = $bdd->getBdd()->query('SELECT * FROM entreprise WHERE valide=0');
        return $req->fetchAll();
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

    public function connexion($bdd, $MDPSaisi){

        $sql='SELECT * FROM entreprise WHERE email=:email AND valide=1';
        $req = $bdd->prepare($sql);
        $req->execute(array(
            'email'=>$this->email
        ));

        $res = $req->fetch();

        if(is_array($res)) {

            $this->setId($res['id_entreprise']);

            if (password_verify($MDPSaisi, $res['mot_de_passe'])) {
                echo "password verified";
                $this->conn = new Connexion(array('refentreprise'=>$this->id));
                $this->conn->ajoutConnexionEntreprise($bdd);
                return $res;
            } else return $res;
        } else return $res;
    }

    public function inscription($bdd){
        $sql ='SELECT * FROM entreprise WHERE email = :email ';
        $req = $bdd->prepare($sql);
        $req->execute(array('email'=> $this->email));
        $res = $req->fetch();

        if (is_array($res)) {
            //return false;
            return "L'email est déjà utilisé !";
        }
        else {
            $sql = 'INSERT INTO entreprise (nom, prenom ,nom_entreprise, 
                        rue_entreprise, ville_entreprise, cp_entreprise, email, mot_de_passe, role_societe) 
            VALUES (:nom, :prenom, :nom_entreprise, :rue_entreprise, :ville_entreprise, :cp_entreprise, :email, :mot_de_passe, :role_societe)';
            $req = $bdd->prepare($sql);
            $execute = $req->execute(array(
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'nom_entreprise' => $this->nom_entreprise,
                'rue_entreprise' => $this->rue_entreprise,
                'ville_entreprise' => $this->ville_entreprise,
                'cp_entreprise' => $this->cp_entreprise,
                'email' => $this->email,
                'mot_de_passe' => $this->mot_de_passe,
                'role_societe' => $this->role_societe
            ));
            if ($execute) return true;
            else return false;
        }
    }

    public function modification ($bdd){
        $sql = 'UPDATE entreprise SET nom =:nom, prenom=:prenom, nom_entreprise=:nom_entreprise,
                      rue_entreprise=:rue_entreprise, ville_entreprise=:ville_entreprise, cp_entreprise=:cp_entreprise,
                      email=:email, role_societe=:role_societe WHERE id_entreprise =:id_entreprise';
        $req = $bdd->prepare($sql);
        $execute=$req->execute(array(
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

    public function validerCompte(BDD $bdd,Mail $mail){
        $req = $bdd->getBdd()->prepare('UPDATE entreprise SET valide=1 WHERE id_entreprise=:id');
        $req->execute(array(
            "id"=>$this->getId()
        ));
        $mail->sendMail($_POST['email'],"Votre compte à été validé","Votre compte entreprise à bien été validé et vous pouvez à présent vous connecter");

    }

    public function deleteAccount(BDD $bdd){
        $req=$bdd->getBdd()->prepare('DELETE FROM entreprise WHERE id_entreprise=:id');
        $req->execute(array(
            "id"=>$this->getId()
        ));
    }

    /**
     * @throws Exception
     */
    public function newCode(PDO $bdd, Mail $mail){
        $code = random_int(1000,9999);
        $req=$bdd->prepare('UPDATE administrateur SET code = :code WHERE email = :email');
        $req->execute(array(
            "code"=>$code,
            "email"=>$this->getEmail()
        ));
        $mail->sendMail($this->getEmail(),"Code Mot de passe oublié","Votre code pour modifer votre mot de passe est : ".$code);
    }

    public function ListeOffresPostule($bdd){
        $sql='SELECT * FROM offre Where ref_entreprise=:ref_entreprise and id_offre in (select ref_offre FROM postule)';
        $request= $bdd->prepare($sql);
        $request->execute(array(
            'ref_entreprise'=> $this->ref_entreprise
        ));
        $result = $request->fetchAll();
        if(is_array($result)) return $result;
        else return false;
    }
}

?>