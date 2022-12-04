<?php

class Offre
{
    private ?int $id;
    private ?string $titre;
    private ?string $description;
    private ?string $domaine;
    private ?bool $accepte;
    private ?int $refType;
    private $ref_entreprise;
    private ?int $ref_etudiant;

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

    public function affichage($bdd){
        $sql='SELECT * FROM offre';
        $req = $bdd->prepare($sql);
        $execute = $req->execute(array(
        ));
        return $req->fetchall();
    }

    public function entrepriseCreerOffre(PDO $bdd){
        $sql='INSERT INTO offre (titre, description, domaine, ref_type, ref_entreprise) 
        VALUES (:titre, :description, :domaine, :refType, :ref_entreprise)';
        $req = $bdd->prepare($sql);
        $execute=$req->execute(array(
            'titre' => $this->titre,
            'description' => $this->description,
            'refType'=>$this->refType,
            'domaine' =>$this->domaine,
            'ref_entreprise'=>$this->ref_entreprise
        ));
    }

    public function entrepriseModifierOffre(PDO $bdd){
        $sql='UPDATE offre SET titre=:titre, description=:description,  domaine=:domaine, ref_type=:refType
        WHERE id_offre=:id';
        $req = $bdd->prepare($sql);
        $execute=$req->execute(array(
            'titre' => $this->titre,
            'description' => $this->description,
            'refType'=>$this->refType,
            'domaine' =>$this->domaine,
            'id'=>$this->id
        ));
    }

    public function entrepriseSupprimerOffre(PDO $bdd){
        $sql='DELETE FROM offre WHERE id_offre=:id';
        $request=$bdd->prepare($sql);
        $execute=$request->execute(array('id'=>$this->id));
        if($execute) return true;
        else return false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDomaine()
    {
        return $this->domaine;
    }

    public function setDomaine($domaine)
    {
        $this->domaine = $domaine;
    }

    public function getAccepte()
    {
        return $this->accepte;
    }

    public function setAccepte($accepte)
    {
        $this->accepte = $accepte;
    }

    public function getRefType()
    {
        return $this->refType;
    }

    public function setRefType($refType): void
    {
        $this->refType = $refType;
    }

    public function getRef_entreprise(): ?int
    {
        return $this->ref_entreprise;
    }

    public function setRef_entreprise($ref_entreprise): void
    {
        $this->ref_entreprise = $ref_entreprise;
    }

    public function getRef_etudiant(): ?int
    {
        return $this->ref_etudiant;
    }

    public function setRef_etudiant(?int $ref_etudiant): void
    {
        $this->ref_etudiant = $ref_etudiant;
    }

    public function listeOffreEtudiant (PDO $bdd){
        $sql='SELECT * FROM type AS t 
              JOIN offre AS o 
              ON t.id_type = o.ref_type 
              JOIN entreprise AS e 
              ON o.ref_entreprise = e.id_entreprise 
              WHERE o.accepte = 1;';
        $request=$bdd->query($sql);
        $result=$request->fetchAll(PDO::FETCH_ASSOC);
        if (is_array($result)) return $result;
        else return false;
    }

    public function etudiantPostule (PDO $bdd){
        $sql='INSERT INTO postule (ref_offre, ref_etudiant) VALUES (:id, :ref_etudiant)';
        $request=$bdd->prepare($sql);
        $execute= $request->execute(array(
            'id'=>$this->id,
            'ref_etudiant'=>$this->ref_etudiant
        ));
        if ($execute) return true;
        else return false;
    }
    public function exist (PDO $bdd,int $id){
        $sql='SELECT * FROM offre WHERE id_offre=:id';
        $request=$bdd->prepare($sql);
        $execute= $request->execute(array('id'=>$id));
        if (is_array($request->fetch())) return true;
        return false;
    }

    public function detailOffre (PDO $bdd){
        $sql='
            SELECT t.nom_type, o.description, o.titre, o.domaine,  e.nom_entreprise, e.rue_entreprise, e.ville_entreprise, e.cp_entreprise
            FROM type AS t 
            JOIN offre AS o 
            ON t.id_type = o.ref_type 
            JOIN entreprise AS e 
            ON o.ref_entreprise = e.id_entreprise 
            WHERE o.id_offre =:id';
        $request=$bdd->prepare($sql);
        $execute= $request->execute(array(
            'id'=>$this->id
        ));
        if ($execute) return $request->fetch(PDO::FETCH_ASSOC);
        return false;
    }

}