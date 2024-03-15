<?php
    // Connexion à la base de données
    require '../connexionBD.php';

    // Récupération des fonctions
    include 'fonctionsMedecin.php';

    $http_method = $_SERVER['REQUEST_METHOD'];

    switch ($http_method) {
        case 'GET':
            $id = null;
            if(!isset($_GET['id_medecin']))
            {
                $matchingdata = getMedecins($linkpdo, $id);
                echo $matchingdata;
            } else {
                $id=htmlspecialchars($_GET['id_medecin']);
                $matchingdata = getMedecins($linkpdo, $id);
                echo $matchingdata;
            }
            break;
        case 'POST':
            $postedData = file_get_contents('php://input');
            $data = json_decode($postedData, true);
            $matchingdata = createMedecin($linkpdo, $data['nom'], $data['prenom'], $data['civilite']);
            echo $matchingdata;
            break;
        case 'PATCH':
        case 'PUT':
            $id = htmlspecialchars($_GET['id_medecin']);
            $modifiedData = file_get_contents('php://input');
            $data = json_decode($modifiedData,true);
            $matchingdata = updateMedecin($linkpdo, $id, $data);
            echo $matchingdata;
            break;
        case 'DELETE':
            $id_medecin = htmlspecialchars($_GET['id_medecin']);
            $matchingdata = deleteMedecin($linkpdo, $id_medecin);
            echo $matchingdata;
            break;
    }
?>