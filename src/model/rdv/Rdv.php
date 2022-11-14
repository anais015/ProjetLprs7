<?php

class Rdv
{
    private ?int $id=null;
    private $horaire;
    private ?string $lieux='';
    private ?bool $accepte=false;
    private ?int$refOffre=null;
    private ?int$refEntreprise=null;
    private ?int$refEtudiant=null;

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
        $sql='SELECT * FROM rdv WHERE ref_entreprise=?, ref_etudiant=?';
        $req = $bdd->prepare($sql);
        $execute = $req->execute(array(
        ));
        return $req->fetchall();
    }

    public function creation($bdd){
        $sql='INSERT INTO rdv (date, heure, lieux) VALUES :date, :heure,:lieux';
        $req = $bdd->prepare($sql);
        $execute=$req->execute(array(
            'date' => $this->date,
            'heure' => $this->heure,
            'lieux' =>$this->lieux
        ));
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getHoraire()
    {
        return $this->horaire;
    }

    public function setHoraire($horaire): void
    {
        $this->horaire = $horaire;
    }


    public function getLieux() {
        return $this->lieux;
    }

    public function setLieux($lieux): void {
        $this->lieux = $lieux;
    }

    public function getAccepte() {
        return $this->accepte;
    }

    public function setAccepte($accepte): void {
        $this->accepte = $accepte;
    }

    public function getRefOffre() {
        return $this->refOffre;
    }

    public function setRefOffre($refOffre): void {
        $this->refOffre = $refOffre;
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

    public function listeRdv (PDO $bdd){
        $sql='SELECT e.nom_entreprise, o.titre, o.description, o.domaine,
              t.nom_type, r.id_rdv, r.horaire, r.lieux, r.accepte
              FROM entreprise AS e
              JOIN offre AS o
              ON e.id_entreprise = o.ref_entreprise
              JOIN type AS t
              ON o.ref_type = t.id_type
              LEFT JOIN rdv AS r
              ON o.id_offre = r.ref_offre
              WHERE r.ref_etudiant=:refEtudiant AND r.horaire >= NOW() AND r.accepte IS NOT FALSE
              ORDER BY r.horaire ';
        $request = $bdd->prepare($sql);
        $execute=$request->execute(array(
            'refEtudiant'=>$this->refEtudiant
        ));
        if ($execute){
            $result = $request->fetchAll(PDO::FETCH_ASSOC);
            if(is_array($result)) return $result;
            else return false;
        }
        else return false;
    }
    public function historiqueRdv (PDO $bdd){
        $sql='SELECT e.nom_entreprise, o.titre, o.description, o.domaine,
              t.nom_type, r.id_rdv, r.horaire, r.lieux, r.accepte
              FROM entreprise AS e
              JOIN offre AS o
              ON e.id_entreprise = o.ref_entreprise
              JOIN type AS t
              ON o.ref_type = t.id_type
              LEFT JOIN rdv AS r
              ON o.id_offre = r.ref_offre
              WHERE r.ref_etudiant=:refEtudiant AND r.horaire < NOW()';
        $request = $bdd->prepare($sql);
        $execute=$request->execute(array(
            'refEtudiant'=>$this->refEtudiant
        ));
        if ($execute){
            $result = $request->fetchAll(PDO::FETCH_ASSOC);
            if(is_array($result)) return $result;
            else return false;
        }
        else return false;
    }

    public function accepterRdv (PDO $bdd){
        $sql = 'UPDATE rdv SET accepte = 1 WHERE id_rdv =:id AND ref_etudiant=:refEtudiant';
        $request=$bdd->prepare($sql);
        $execute=$request->execute(array(
            'id'=>$this->id,
            'refEtudiant'=>$this->refEtudiant
        ));
        if ($execute) return true;
        else return false;
    }

    public function declinerRdv (PDO $bdd){
        $sql = 'UPDATE rdv SET accepte = 0 WHERE id_rdv =:id AND ref_etudiant=:refEtudiant';
        $request=$bdd->prepare($sql);
        $execute=$request->execute(array(
            'id'=>$this->id,
            'refEtudiant'=>$this->refEtudiant
        ));
        if ($execute) return true;
        else return false;
    }


}