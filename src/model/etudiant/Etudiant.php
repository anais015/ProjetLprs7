<?php

class Etudiant extends Utilisateur
{
    private $domaine_etude;
    private $valide;
    private Evenement $evenement;
    private Connexion $connexion;

    public function __construct(array $donnees){
        parent::__construct($donnees);
    }

    public function getDomaineEtude() {
        return $this->domaine_etude;
    }

    public function setDomaine_etude($domaine_etude): void {
        $this->domaine_etude = $domaine_etude;
    }

    public function getValide() {
        return $this->valide;
    }

    public function setValide($valide): void {
        $this->valide = $valide;
    }

    public function getEvenement(): Evenement {
        return $this->evenement;
    }

    public function setEvenement(Evenement $evenement): void {
        $this->evenement = $evenement;
    }

    public function inscription($bdd){
        $sql ='SELECT * FROM etudiant WHERE email = :email ';
        $request = $bdd->prepare($sql);
        $request->execute(array('email'=> $this->email));
        $result = $request->fetch();

        if(is_array($result)) {
            return false;
        }
        else {
            $sql='INSERT INTO etudiant (nom, prenom, email, mot_de_passe, domaine_etude) VALUES (:nom, :prenom, :email, :mot_de_passe, :domaine_etude)';
            $request = $bdd->prepare($sql);
            $execute=$request->execute(array(
                'nom'=> $this->nom,
                'prenom'=> $this->prenom,
                'email'=> $this->email,
                'mot_de_passe'=> $this->mot_de_passe,
                'domaine_etude'=> $this->domaine_etude
            ));
            if($execute)return true;
            else return false;
        }
    }

    public function connexion($bdd, $passwordSaisi){
//        $sql='SELECT * FROM etudiant WHERE email=:email AND mot_de_passe=:mot_de_passe AND valide=1';
        $sql='SELECT * FROM etudiant WHERE email=:email AND valide=1';
        $request = $bdd->prepare($sql);
        $execute = $request->execute(array(
            'email'=>$this->email
//            'mot_de_passe'=>$this->mot_de_passe
        ));
        if ($execute){
            $result=$request->fetch();
            if(is_array($result)) {
                $this->setId($result['id_etudiant']);
                var_dump($this->id);
                if (password_verify($passwordSaisi, $result['mot_de_passe'])) {
                    $this->connexion=new Connexion(array('refetudiant'=>$this->id));
                    var_dump($this->connexion);
                    $ajoutConnexion = $this->connexion->ajoutConnexionEtudiant($bdd);
                    var_dump($ajoutConnexion);
                    return $result;
                } else {
                    echo "prb password";
                    return false;
                }
            }
            else {
                echo "pas fetch";
                return false;
            }
        }
        else {
            echo "pas execute";
                return false;
            }
    }

    public function modification ($bdd){
        $sql = 'UPDATE etudiant SET nom =:nom, prenom=:prenom, email=:email, domaine_etude=:domaine_etude WHERE  id_etudiant =:id_etudiant';
        $request = $bdd->prepare($sql);
        $execute=$request->execute(array(
            'id_etudiant'=>$this->id,
            'nom'=> $this->nom,
            'prenom'=> $this->prenom,
            'email'=> $this->email,
            'domaine_etude'=> $this->domaine_etude
        ));
        if($execute) return true;
        else return false;
    }

    private function verificationPassword ($bdd)
    {
        $sql = 'SELECT mot_de_passe FROM etudiant WHERE email = :email ';
        $request = $bdd->prepare($sql);
        $execute = $request->execute(array('email' => $this->email));
        if ($execute) {
            $result = $request->fetch();
            if (is_array($result)) return true;
        } else return false;
    }

    public function modificationPassword ($bdd){
        if ($this->verificationPassword($bdd)){
            $sql = 'UPDATE etudiant SET mot_de_passe =:mot_de_passe WHERE  id_etudiant =:id_etudiant';
            $request = $bdd->prepare($sql);
            $execute=$request->execute(array('mot_de_passe'=>$this->mot_de_passe));
            if ($execute) return true;
            else return false;
        }
        else return false;
    }
}