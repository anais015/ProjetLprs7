<?php

class Evenement
{
    private $id;
    private $nom;
    private $description;
    private $date;
    private $heure;
    private $duree;
    private $valide;
    private $refSalle;
    private $refEntreprise;
    private $refEtudiant;
    private $refAdmin;

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

    public function getPendingEvent(Bdd $bdd){
        $req = $bdd->getBdd()->query('SELECT * FROM evenement WHERE valide=0');
        return $req->fetchAll();
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom): void {
        $this->nom = $nom;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description): void {
        $this->description = $description;
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

    public function getDuree() {
        return $this->duree;
    }

    public function setDuree($duree): void {
        $this->duree = $duree;
    }

    public function getValide() {
        return $this->valide;
    }

    public function setValide($valide): void {
        $this->valide = $valide;
    }

    public function getRefSalle() {
        return $this->refSalle;
    }

    public function setRefSalle($refSalle): void {
        $this->refSalle = $refSalle;
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

    public function getRefAdmin() {
        return $this->refAdmin;
    }

    public function setRefAdmin($refAdmin): void {
        $this->refAdmin = $refAdmin;
    }

    public function modifierEvenement ($bdd){
        $sql='UPDATE evenement SET nom=:nom, description=:description, date=:date, heure=:heure, duree=:duree
              WHERE id_evenement=:id_evenement';
        $request=$bdd->prepare($sql);
        $execute=$request->execute(array(
            'nom'=> $this->nom,
            'description'=> $this->description,
            'date'=> $this->date,
            'heure'=> $this->heure,
            'duree'=> $this->duree,
            'id_evenement'=>$this->id
        ));
        if ($execute) return true;
        else return false;
    }

    public function supprimerEvenement ($bdd){
        $sql='DELETE FROM evenement WHERE id_evenement=:id_evenement';
        $request=$bdd->prepare($sql);
        $execute=$request->execute(array('id_evenement'=>$this->id));
        if($execute) return true;
        else return false;
    }

    public function etudiantOrganiseEvenement ($bdd){
        $sql ='SELECT * FROM evenement WHERE date=:date AND heure=:heure AND ref_etudiant=:ref_etudiant';
        $request = $bdd->prepare($sql);
        $execute = $request->execute(array(
            'date'=> $this->date,
            'heure'=> $this->heure,
            'ref_etudiant'=>$this->refEtudiant));
        if($execute) {
            $result = $request->fetch();
            if (is_array($result)) return false;
        }
        else {
            $sql='INSERT INTO evenement (nom, description, date, heure, duree) VALUES (:nom, :description, :date, :heure, :duree)';
            $request = $bdd->prepare($sql);
            $execute=$request->execute(array(
                'nom'=> $this->nom,
                'description'=> $this->description,
                'date'=> $this->date,
                'heure'=> $this->heure,
                'duree'=> $this->duree,
                'ref_etudiant'=>$this->refEtudiant
            ));
            if($execute) return true;
            else return false;
        }
    }

    public function etudiantParticipeEvenement($bdd){
        $sql ='SELECT * FROM participe WHERE ref_evenement=: ref_evenement AND ref_etudiant=:ref_etudiant';
        $request = $bdd->prepare($sql);
        $execute = $request->execute(array(
            'ref_evenement'=> $this->id,
            'ref_etudiant'=> $this->refEtudiant));
        if($execute) {
            $result = $request->fetch();
            if (is_array($result)) return false;
        }
        else {
            $sql='INSERT INTO participe (ref_evenement, ref_etudiant) VALUES (:ref_evenement, :ref_etudiant)';
            $request = $bdd->prepare($sql);
            $execute=$request->execute(array(
                'ref_evenement'=> $this->id,
                'ref_etudiant'=> $this->refEtudiant
            ));
            if($execute) return true;
            else return false;
        }
    }

}