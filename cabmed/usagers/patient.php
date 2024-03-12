<?php
    // Création de la classe Patient
    class Patient{
        private $nom;
        private $prenom;
        private $civilite;
        private $date_nais;
        private $adresse;
        private $ville;
        private $code_postal;
        private $sexe;
        private $lieu_nais;
        private $num_secu;

        // Constructeur
        public function __construct($civilite, $nom, $prenom, $adresse, $ville, $code_postal, $date_nais, $lieu_nais, $num_secu, $sexe){
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->civilite = $civilite;
            $this->date_nais = $date_nais;
            $this->adresse = $adresse;
            $this->ville = $ville;
            $this->code_postal = $code_postal;
            $this->lieu_nais = $lieu_nais;
            $this->num_secu = $num_secu;
            $this->sexe = $sexe;
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
            return $this->date_nais;
        }

        public function getAdresse(){
            return $this->adresse;
        }

        public function getLieuNaissance(){
            return $this->lieu_nais;
        }

        public function getNumSecu(){
            return $this->num_secu;
        }

        public function getSexe(){
            return $this->sexe;
        }

        public function getCodePostal(){
            return $this->code_postal;
        }

        public function getVille(){
            return $this->ville;
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
            $this->date_nais = $dateNaissance;
        }

        public function setAdresse($adresse){
            $this->adresse = $adresse;
        }

        public function setLieuNaissance($lieu_nais){
            $this->lieu_nais = $lieu_nais;
        }

        public function setNum_secu($num_secu){
            $this->num_secu = $num_secu;
        }
        
        public function setSexe($sexe){
            $this->sexe = $sexe;
        }
        
        public function setCodePostal($code_postal){
            $this->codePostal = $code_postal;
        }
        
        public function setVille($ville){
            $this->ville = $ville;
        }

    }

?>