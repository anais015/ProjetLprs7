<?php

class Etudiant extends Utilisateur
{
    private $domaine_etude;
    private $valide;
    private Evenement $evenement;
    private Connexion $connexion;
    private Rdv $rdv;

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

        if(is_array($result)) return false;
        else {
            if (!$this->isValideWithoutId()) return false;
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
        $sql='SELECT * FROM etudiant WHERE email=:email AND valide=1';
        $request = $bdd->prepare($sql);
        $execute = $request->execute(array(
            'email'=>$this->email
        ));
        if ($execute){
            $result=$request->fetch();
            if(is_array($result)) {
                $this->setId($result['id_etudiant']);
                if (password_verify($passwordSaisi, $result['mot_de_passe'])) {
                    $this->connexion=new Connexion(array('refetudiant'=>$this->id));
                    $this->connexion->ajoutConnexionEtudiant($bdd);
                    return $result;
                } else return false;
            } else return false;
        } else return false;
    }

    public function selectParId($bdd){
        $sql='SELECT * FROM etudiant WHERE id_etudiant=:id';
        $request = $bdd->prepare($sql);
        $execute = $request->execute(array(
            'id'=>$this->id
        ));
        if ($execute){
            $result=$request->fetch();
            if(is_array($result)) return $result;
            else return false;
        } else return false;
    }

    public function modifierInfo ($bdd){
        $sql = 'UPDATE etudiant SET nom =:nom, prenom=:prenom, domaine_etude=:domaine_etude WHERE id_etudiant =:id_etudiant';
        $request = $bdd->prepare($sql);
        $execute=$request->execute(array(
            'nom'=> $this->nom,
            'prenom'=> $this->prenom,
            'domaine_etude'=> $this->domaine_etude,
            'id_etudiant'=>$this->id
        ));
        if($execute) return true;
        else return false;
    }

    public function modifierEmail ($bdd, $passwordSaisi){
        $sql ='SELECT * FROM etudiant WHERE email = :email ';
        $request = $bdd->prepare($sql);
        $request->execute(array('email'=> $this->email));
        $result = $request->fetch();
        if(is_array($result)) return false;
        else {
            $sql ='SELECT * FROM etudiant WHERE id_etudiant = :id ';
            $request=$bdd->prepare($sql);
            $request->execute(array('id'=> $this->id));
            $result=$request->fetch();
            if(is_array($result)){
                if (password_verify($passwordSaisi, $result['mot_de_passe'])){
                    //echo "password dung";
                    $sql = 'UPDATE etudiant SET email =:email WHERE id_etudiant =:id';
                    $request = $bdd->prepare($sql);
                    $execute=$request->execute(array(
                        'email'=> $this->email,
                        'id'=>$this->id
                    ));
                    if($execute) return true;
                    else return false;
                } else return false;
            }
        }
    }

    public function modifierPw ($bdd, $passwordSaisi){
        $sql ='SELECT * FROM etudiant WHERE id_etudiant = :id ';
        $request=$bdd->prepare($sql);
        $request->execute(array('id'=> $this->id));
        $result=$request->fetch();
        if(is_array($result)) {
            if (password_verify($passwordSaisi, $result['mot_de_passe'])) {
                $sql = 'UPDATE etudiant SET mot_de_passe =:mot_de_passe WHERE id_etudiant =:id';
                $request = $bdd->prepare($sql);
                $execute = $request->execute(array(
                    'mot_de_passe' => $this->mot_de_passe,
                    'id' => $this->id
                ));
                if ($execute) return true;
                else return false;
            } else return false;
        } else return false;
    }

    public function getPendingAccount(Bdd $bdd){
        $req = $bdd->getBdd()->query('SELECT * FROM etudiant WHERE valide=0');
        return $req->fetchAll();
    }

    public function listeCandidature(PDO $bdd){
        $sql='SELECT e.nom_entreprise, e.rue_entreprise, e.ville_entreprise, e.cp_entreprise, 
              o.titre, o.description, o.domaine, t.nom_type, r.id_rdv, p.ref_etudiant, p.date
              FROM entreprise AS e
              JOIN offre AS o
              ON e.id_entreprise = o.ref_entreprise
              JOIN type AS t
              ON o.ref_type = t.id_type
              JOIN postule AS p
              ON o.id_offre = p.ref_offre
              LEFT JOIN rdv AS r
              ON p.ref_offre = r.ref_offre
              WHERE p.ref_etudiant=:id';
        $request = $bdd->prepare($sql);
        $execute=$request->execute(array(
            'id'=>$this->id
        ));
        if ($execute){
            $result = $request->fetchAll(PDO::FETCH_ASSOC);
            if(is_array($result)) return $result;
            else return false;
        }
        else return false;
    }

    public function checkPostule (PDO $bdd, $offre_id){
        $sql = 'SELECT * FROM postule WHERE ref_offre=:ref_offre AND ref_etudiant=:ref_etudiant ';
        $request= $bdd->prepare($sql);
        $execute= $request->execute(array(
            'ref_offre'=>$offre_id,
            'ref_etudiant'=>$this->id
        ));
        if ($execute) {
            $result=$request->fetch(PDO::FETCH_ASSOC);
            if(is_array($result)) return $result;
            else return false;
        }
        else return false;
    }
}