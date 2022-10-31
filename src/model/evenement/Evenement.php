<?php

class Evenement
{
    private $id;
    private $nom;
    private $description;
    private $debut;
    private $fin;
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

    public function getDebut()
    {
        return $this->debut;
    }

    public function setDebut($debut): void
    {
        if(is_string($debut)) $debutDateTime=date("Y-m-d H:i:s", strtotime($debut));
        $this->debut = $debutDateTime;
    }

    public function getFin()
    {
        return $this->fin;
    }

    public function setFin($fin): void
    {
        $finDateTime=null;
        if(is_string($fin)) $finDateTime=date("Y-m-d H:i:s", strtotime($fin));
        $this->fin = $finDateTime;
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
        $sql='UPDATE evenement SET nom_event=:nom, description=:description, debut=:debut, fin=:fin
              WHERE id_evenement=:id';
        $request=$bdd->prepare($sql);
        $execute=$request->execute(array(
            'nom'=> $this->nom,
            'description'=> $this->description,
            'debut'=> $this->debut,
            'fin'=> $this->fin,
            'id'=>$this->id
        ));
        if ($execute) return true;
        else return false;
    }

    public function supprimerEvenement ($bdd){
        $sql='DELETE FROM evenement WHERE id_evenement=:id';
        $request=$bdd->prepare($sql);
        $execute=$request->execute(array('id'=>$this->id));
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
            $sql='INSERT INTO evenement (nom_event, description, date, heure, duree, ref_entreprise) VALUES (:nom, :description, :date, :heure, :duree, :ref_entreprise)';
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
            $sql='INSERT INTO evenement (nom_event, description, debut, fin, ref_etudiant) VALUES (:nom, :description, :debut, :fin, :ref_etudiant)';
            $request = $bdd->prepare($sql);
            $execute=$request->execute(array(
                'nom'=> $this->nom,
                'description'=> $this->description,
                'debut'=> $this->debut,
                'fin'=> $this->fin,
                'ref_etudiant'=>$this->ref_etudiant
            ));
            if($execute) return true;
            else return false;
    }

    public function etudiantParticipeEvenement($bdd){
//        $sql ='SELECT date, heure, ADDTIME(heure,duree) FROM evenement WHERE'
        $sql ='SELECT * FROM participe AS p
        INNER JOIN evenement AS e
        ON p.ref_etudiant=e.ref_etudiant
        WHERE e.date=:date, e.heure p.ref_evenement=: ref_evenement AND p.ref_etudiant=:ref_etudiant';
        $request = $bdd->prepare($sql);
        $execute = $request->execute(array(
            'ref_evenement'=> $this->id,
            'ref_etudiant'=> $this->ref_etudiant));
        if($execute) {
            $result = $request->fetch();
            if (is_array($result)) return false;
        }
        else {
            $sql='INSERT INTO participe (ref_evenement, ref_etudiant) VALUES (:id, :ref_etudiant)';
            $request = $bdd->prepare($sql);
            $execute=$request->execute(array(
                'id'=> $this->id,
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
        if(is_array($result)) {
            $this->setId($result['id_evenement']);
            $this->setNom($result['nom_event']);
            $this->setDescription($result['description']);
            $this->setDebut($result['debut']);
            $this->setFin($result['fin']);
            $this->setRef_etudiant($result['ref_etudiant']);
            $this->setRef_entreprise($result['ref_entreprise']);
            $this->setRefSalle($result['ref_salle']);
            $this->setRefAdmin($result['ref_administrateur']);
            $this->setValide($result['valide']);
            return $this;
        }

        else return false;
    }

    public function listEventOrganise($bdd){
        $sql='SELECT e.id_evenement, e.nom_event, e.debut, e.fin, e.valide, s.nom FROM evenement AS e
    LEFT JOIN salle AS s
              ON e.ref_salle = s.id_salle 
              WHERE e.debut>NOW() AND e.ref_etudiant=:ref_etudiant
              ORDER BY e.debut';
        $request= $bdd->prepare($sql);
        $request->execute(array('ref_etudiant'=> $this->ref_etudiant));
        $result = $request->fetchAll();
        if(is_array($result)) return $result;
        else return false;
    }

    public function listRechercheEvent($bdd){
        $sql='SELECT e.id_evenement, e.nom_event, e.description, e.debut, e.fin, s.nom FROM evenement AS e
    LEFT JOIN salle AS s
              ON e.ref_salle = s.id_salle 
              WHERE valide=1 AND e.date>NOW() AND (`ref_etudiant` IS NULL OR `ref_etudiant`<>:ref_etudiant)
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