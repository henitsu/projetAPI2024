<?php
    // Connexion à la base de données
    require '../fonctionsStats.php';

    $http_method = $_SERVER['REQUEST_METHOD'];
    $data = array();
    if($http_method == 'GET'){
        echo getNbHeuresConsultations($linkpdo);
    } else {
        deliverResponse(405, "Méthode non autorisée", NULL);
    }
?>