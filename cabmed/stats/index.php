<?php
    // Connexion à la base de données
    require '../connexionBD.php';
    require 'fonctionsStats.php';

    $http_method = $_SERVER['REQUEST_METHOD'];

    if($http_method=="GET"){
        // Récupération des statistiques
        $numero = htmlspecialchars($_GET['numero']);
        switch($numero){
            case 1:
                echo json_encode(getNbFemmesMoins25Ans($linkpdo));
                break;
            case 2:
                echo json_encode(getNbHommesMoins25Ans($linkpdo));
                break;
            case 3:
                echo json_encode(getNbFemmesMilieu($linkpdo));
                break;
            case 4:
                echo json_encode(getNbHommesMilieu($linkpdo));
                break;
            case 5:
                echo json_encode(getNbFemmesPlus50Ans($linkpdo));
                break;
            case 6:
                echo json_encode(getNbHommesPlus50Ans($linkpdo));
                break;
            case 7:
                echo json_encode(getNbHeuresConsultations($linkpdo));
                break;
        }
    }

?>