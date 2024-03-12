<?php
    // Création de la classe Medecin
    class Medecin{
        private $nom;
        private $prenom;
        private $civilite;

        // Constructeur
        public function __construct($civilite, $nom, $prenom){
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->civilite = $civilite;
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
    }

?>