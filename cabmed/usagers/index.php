<?php

    include '../connexionBD.php';
    include './fonctionsUsager.php';

    // Récupération de l'URI
    $uri = $_SERVER['REQUEST_URI'];

    // Récupération de la méthode HTTP utilisée
    $http_method = $_SERVER['REQUEST_METHOD'];

    switch ($http_method){
        case "GET" :
            // Lecture 
            if(basename($uri) == "usagers") {
                echo getPatients($linkpdo, null);
            }
            else {
                $id = basename($uri);
                echo getPatients($linkpdo, $id);
            }
            break;
        
        case "POST" :
            // Création patient
            // Récupération des données dans le corps
            $postedData = file_get_contents('php://input');
            $data = json_decode($postedData, true); // Reçoit du json et renvoie une adaptation exploitable en php. 
            // Le paramètre true impose un tableau en retour et non un objet.
            
            echo createPatient($linkpdo, $data['nom'], $data['prenom'], $data['sexe'], $data['adresse'], 
                $data['code_postal'], $data['ville'], $data['date_nais'], $data['lieu_nais'], 
                $data['num_secu'], $data['civilite'], $data['id_medecin']);  
            break;
        
        case "PATCH":
            $id = basename($uri);
            // mise à jour partielle

            // Récupération des données dans le corps
            $modifiedData = file_get_contents('php://input');
            $data = json_decode($modifiedData, true);
            echo updatePatient($linkpdo, $id, $data);

            break;
        
        case "DELETE":
            // suppression patient
            $id = basename($uri);
            if (!isset($id)){
                deliverResponse(400, "Requête mal formée", NULL);
            }

            echo deletePatient($linkpdo, $id);
                     
            break;
        
        default:
            deliverResponse(405, "Méthode non autorisée", NULL);
    }

?>