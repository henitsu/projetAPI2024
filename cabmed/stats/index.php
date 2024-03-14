<?php
    // Connexion à la base de données
    require 'fonctionsStats.php';

    $http_method = $_SERVER['REQUEST_METHOD'];
    // fonction de retour des données
    function returnData($linkpdo, $http_method){
        if($http_method == 'GET'){
            $data = array();
            $data['NbFemmesMoins25Ans'] = getNbFemmesMoins25Ans($linkpdo);
            $data['NbFemmesMilieu'] = getNbFemmesMilieu($linkpdo);
            $data['NbFemmesPlus50Ans'] = getNbFemmesPlus50Ans($linkpdo);
            $data['NbHommesMoins25Ans'] = getNbHommesMoins25Ans($linkpdo);
            $data['NbHommesMilieu'] = getNbHommesMilieu($linkpdo);
            $data['NbHommesPlus50Ans'] = getNbHommesPlus50Ans($linkpdo);
            $data['NbHeuresConsultations'] = getNbHeuresConsultations($linkpdo);
            return $data;
        } else {
            return "Méthode non autorisée";
        }
    }

    $data = returnData($linkpdo, $http_method);
?>