<?php

    include 'connexionDB.php';
    include 'fonctionsConsultation.php';

    $http_method = $_SERVER['REQUEST_METHOD'];

    switch ($http_method){
        case "GET" :
            // Lecture 
            if(!isset($_GET['id'])) {
                echo getConsultations($linkpdo, null);
            }
            else {
                $id = htmlspecialchars($_GET['id']);
                echo getConsultations($linkpdo, $id);
            }
            break;
        
        case "POST" :
            // Création consultation
            // Récupération des données dans le corps
            $postedData = file_get_contents('php://input');
            $data = json_decode($postedData, true); // Reçoit du json et renvoie une adaptation exploitable en php. 
            // Le paramètre true impose un tableau en retour et non un objet.
            
            echo createConsultation($linkpdo, $data['id_medecin'], $data['id_patient'], $data['date_consult'], $data['heure_consult'], $data['duree_consult']);
            break;
        
        case "PATCH":
            $id =  htmlspecialchars($_GET['id']);
            // mise à jour partielle

            // Récupération des données dans le corps
            $modifiedData = file_get_contents('php://input');
            $data = json_decode($modifiedData, true);
            echo updateConsultation($linkpdo, $id, $data);

            break;
        
        case "DELETE":
            // suppression consultation
            $id = htmlspecialchars($_GET['id']);
            if (!isset($id)){
                deliver_response(404, "Requête mal formée", NULL);
            }

            echo deleteConsultation($linkpdo, $id);
                     
            break;
        
        default:
            deliver_response(405, "Méthode non autorisée", NULL);
    }

?>