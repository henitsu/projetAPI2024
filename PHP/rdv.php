<?php
    // Création de la classe RDV
    class RDV{
        private $dateHeure;
        private $idMedecin;
        private $idPatient;
        private $duree;

        // Constructeur
        public function __construct($idPatient, $idMedecin, $dateHeure, $duree){
            $this->dateHeure = $dateHeure;
            $this->idMedecin = $idMedecin;
            $this->idPatient = $idPatient;
            $this->duree = $duree;
        }

        // Getters
        public function getDateHeure(){
            return $this->dateHeure;
        }

        public function getIdMedecin(){
            return $this->idMedecin;
        }

        public function getIdPatient(){
            return $this->idPatient;
        }

        public function getDuree(){
            return $this->duree;
        }

        // Setters
        public function setDateHeure($dateHeure){
            $this->dateHeure = $dateHeure;
        }

        public function setIdMedecin($idMedecin){
            $this->idMedecin = $idMedecin;
        }

        public function setIdPatient($idPatient){
            $this->idPatient = $idPatient;
        }

        public function setDuree($duree){
            $this->duree = $duree;
        }
    }
?>