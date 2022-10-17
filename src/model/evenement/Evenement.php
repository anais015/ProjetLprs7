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
    private $ref_entreprise;
    private $ref_etudiant;
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

    public function assignSalle(Bdd $bdd, $id_salle){
        $req = $bdd->GetBdd()->prepare('UPDATE evenement SET ref_salle = :id_salle, valide = 1 WHERE id_evenement=:id');
        $req->execute(array(
            "id"=>$this->getId(),
            "id_salle"=>$id_salle
        ));
    }

    public function deleteEvent(Bdd $bdd){
        $req = $bdd->getBdd()->prepare('DELETE FROM evenement WHERE id_evenement=:id');
        $req->execute(array(
            "id"=>$this->getId()
        ));
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
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

    public function getRef_entreprise() {
        return $this->ref_entreprise;
    }

    public function setRef_entreprise($ref_entreprise): void {
        $this->ref_entreprise = $ref_entreprise;
    }

    public function getRef_etudiant() {
        return $this->ref_etudiant;
    }

    public function setRef_etudiant($ref_etudiant): void {
        $this->ref_etudiant = $ref_etudiant;
    }

    public function getRefAdmin() {
        return $this->refAdmin;
    }

    public function setRefAdmin($refAdmin): void {
        $this->refAdmin = $refAdmin;
    }

    public function modifierEvenement ($bdd){
        $sql='UPDATE evenement SET nom=:nom, description=:description, date=:date, heure=:heure, duree=:duree
              WHERE id_evenement=:id';
        $request=$bdd->prepare($sql);
        $execute=$request->execute(array(
            'nom'=> $this->nom,
            'description'=> $this->description,
            'date'=> $this->date,
            'heure'=> $this->heure,
            'duree'=> $this->duree,
            'id'=>$this->id
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

    public function entrepriseCreerEvenement($bdd){
        $sql ='SELECT * FROM evenement WHERE date=:date AND heure=:heure AND ref_entreprise=:ref_entreprise';
        $req = $bdd->prepare($sql);
        $req->execute(array(
            'date'=> $this->date,
            'heure'=> $this->heure,
            'ref_entreprise'=>$this->ref_entreprise));
        $res = $req->fetch();
        if (is_array($res)) return false;

        else{
            $sql='INSERT INTO evenement (nom, description, date, heure, duree, ref_entreprise) VALUES (:nom, :description, :date, :heure, :duree, :ref_entreprise)';
            $request = $bdd->prepare($sql);
            $execute=$request->execute(array(
                'nom'=> $this->nom,
                'description'=> $this->description,
                'date'=> $this->date,
                'heure'=> $this->heure,
                'duree'=> $this->duree,
                'ref_entreprise'=>$this->ref_entreprise
            ));
            if($execute) return true;
            else return false;
        }
    }

    public function etudiantOrganiseEvenement ($bdd){
        $sql ='SELECT * FROM evenement WHERE date=:date AND heure=:heure AND ref_etudiant=:ref_etudiant';
        $request = $bdd->prepare($sql);
        $request->execute(array(
            'date'=> $this->date,
            'heure'=> $this->heure,
            'ref_etudiant'=>$this->ref_etudiant));
        $result = $request->fetch();
        if (is_array($result)) return false;

        else {
            $sql='INSERT INTO evenement (nom, description, date, heure, duree, ref_etudiant) VALUES (:nom, :description, :date, :heure, :duree, :ref_etudiant)';
            $request = $bdd->prepare($sql);
            $execute=$request->execute(array(
                'nom'=> $this->nom,
                'description'=> $this->description,
                'date'=> $this->date,
                'heure'=> $this->heure,
                'duree'=> $this->duree,
                'ref_etudiant'=>$this->ref_etudiant
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
            'ref_etudiant'=> $this->ref_etudiant));
        if($execute) {
            $result = $request->fetch();
            if (is_array($result)) return false;
        }
        else {
            $sql='INSERT INTO participe (ref_evenement, ref_etudiant) VALUES (:ref_evenement, :ref_etudiant)';
            $request = $bdd->prepare($sql);
            $execute=$request->execute(array(
                'ref_evenement'=> $this->id,
                'ref_etudiant'=> $this->ref_etudiant
            ));
            if($execute) return true;
            else return false;
        }
    }
    public function selectParId($bdd){
        $sql='SELECT * FROM evenement WHERE id_evenement=:id';
        $request=$bdd->prepare($sql);
        $request->execute(array('id'=>$this->id));
        $result=$request->fetch();
        if(is_array($result)) return $result;
        else return false;
    }

    public function listEventOrganise($bdd){
        $sql='SELECT e.id_evenement, e.nom , e.date, e.heure, e.duree, e.valide, s.nom FROM evenement AS e
    LEFT JOIN salle AS s
              ON e.ref_salle = s.id_salle 
              WHERE e.date>NOW() AND e.ref_etudiant=:ref_etudiant
              ORDER BY e.date';
        $request= $bdd->prepare($sql);
        $request->execute(array('ref_etudiant'=> $this->ref_etudiant));
        $result = $request->fetchAll();
        if(is_array($result)) return $result;
        else return false;
    }

    public function historique($bdd){
        $sql='SELECT * FROM evenement WHERE date<NOW() AND valide=1 AND ref_etudiant=:ref_etudiant ORDER BY date DESC';
        $request= $bdd->prepare($sql);
        $request->execute(array('ref_etudiant'=> $this->ref_etudiant));
        $result = $request->fetchAll();
        if(is_array($result)) return $result;
        else return false;
    }

}