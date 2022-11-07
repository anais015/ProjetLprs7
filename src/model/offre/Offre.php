<?php

class Offre
{
    private ?int $id;
    private ?string $titre;
    private ?string $description;
    private ?string $domaine;
    private ?bool $accepte;
    private ?int $refType;
    private ?int $ref_entreprise;
    private ?int $ref_etudiant;

    /**
     * @param $id
     * @param $titre
     * @param $description
     * @param $domaine
     * @param $accepte
     */

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

    public function entrepriseCreerOffre($bdd){
        $sql='INSERT INTO offre (titre, description, domaine, refType, ref_entreprise) 
        VALUES :titre, :description, :domaine, :ref_type, :ref_entreprise';
        $req = $bdd->prepare($sql);
        $execute=$req->execute(array(
            'titre' => $this->titre,
            'description' => $this->description,
            'domaine' =>$this->domaine,
            'refType' => $this->refType,
            'ref_entreprise'=> $this->ref_entreprise
        ));
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDomaine()
    {
        return $this->domaine;
    }

    /**
     * @param mixed $domaine
     */
    public function setDomaine($domaine)
    {
        $this->domaine = $domaine;
    }

    /**
     * @return mixed
     */
    public function getAccepte()
    {
        return $this->accepte;
    }

    /**
     * @param mixed $accepte
     */
    public function setAccepte($accepte)
    {
        $this->accepte = $accepte;
    }

    /**
     * @return mixed
     */
    public function getRefType()
    {
        return $this->refType;
    }

    /**
     * @param mixed $refType
     */
    public function setRefType($refType): void
    {
        $this->refType = $refType;
    }

    /**
     * @return mixed
     */
    public function getRefEntreprise(): ?int
    {
        return $this->ref_entreprise;
    }

    /**
     * @param mixed $ref_entreprise
     */
    public function setRefEntreprise($ref_entreprise): void
    {
        $this->ref_entreprise = $ref_entreprise;
    }



    /**
     * @return int|null
     */
    public function getRef_etudiant(): ?int
    {
        return $this->ref_etudiant;
    }

    /**
     * @param int|null $ref_etudiant
     */
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

}