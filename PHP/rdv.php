<?php
    // Création de la classe RDV
    class rdv{
        private $date;
        private $heure;
        private $duree;
        private $id_medecin;
        private $id_usager;

        // Constructeur
        public function __construct($date, $heure, $duree, $id_medecin, $id_usager){
            $this->date = $date;
            $this->heure = $heure;
            $this->duree = $duree;
            $this->id_medecin = $id_medecin;
            $this->id_usager = $id_usager;
        }

        // Getters
        public function getDate(){
            return $this->date;
        }

        public function getHeure(){
            return $this->heure;
        }

        public function getDuree(){
            return $this->duree;
        }

        public function getId_medecin(){
            return $this->id_medecin;
        }

        public function getId_usager(){
            return $this->id_usager;
        }

        // Setters
        public function setDate($date){
            $this->date = $date;
        }

        public function setHeure($heure){
            $this->heure = $heure;
        }

        public function setDuree($duree){
            $this->duree = $duree;
        }

        public function setIdMedecin($id_medecin){
            $this->id_medecin = $id_medecin;
        }

        public function setId_usager($id_usager){
            $this->id_usager = $id_usager;
        }
    }
?>