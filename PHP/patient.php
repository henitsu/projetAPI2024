<?php
    // Création de la classe Patient
    class Patient{
        private $nom;
        private $prenom;
        private $civilite;
        private $dateNaissance;
        private $adresse;
        private $lieuNaissance;
        private $numSecu;
        private $idMedecin;

        // Constructeur
        public function __construct($civilite, $nom, $prenom, $adresse, $dateNaissance, $lieuNaissance, $numSecu, $idMedecin){
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->civilite = $civilite;
            $this->dateNaissance = $dateNaissance;
            $this->adresse = $adresse;
            $this->lieuNaissance = $lieuNaissance;
            $this->numSecu = $numSecu;
            $this->idMedecin = $idMedecin;
        }

        // Getters
        public function getNom(){
            return $this->nom;
        }

        public function getPrenom(){
            return $this->prenom;
        }

        public function getCivilite(){
            return $this->civilite;
        }

        public function getDateNaissance(){
            return $this->dateNaissance;
        }

        public function getAdresse(){
            return $this->adresse;
        }

        public function getLieuNaissance(){
            return $this->lieuNaissance;
        }

        public function getNumSecu(){
            return $this->numSecu;
        }

        public function getIdMedecin(){
            return $this->idMedecin;
        }

        // Setters
        public function setNom($nom){
            $this->nom = $nom;
        }

        public function setPrenom($prenom){
            $this->prenom = $prenom;
        }

        public function setCivilite($civilite){
            $this->civilite = $civilite;
        }

        public function setDateNaissance($dateNaissance){
            $this->dateNaissance = $dateNaissance;
        }

        public function setAdresse($adresse){
            $this->adresse = $adresse;
        }

        public function setLieuNaissance($lieuNaissance){
            $this->lieuNaissance = $lieuNaissance;
        }

        public function setNumSecu($numSecu){
            $this->numSecu = $numSecu;
        }

        public function setIdMedecin($idMedecin){
            $this->idMedecin = $idMedecin;
        }
    }

?>