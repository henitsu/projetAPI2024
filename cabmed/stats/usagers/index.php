<?php
    // Connexion à la base de données
    require '../fonctionsStats.php';

    $http_method = $_SERVER['REQUEST_METHOD'];
    $data = array();
    if($http_method == 'GET'){
        $matchingdata = getStatsUsagers($linkpdo);
        echo $matchingdata;
    } else {
        deliverResponse(400, "Bad request", NULL);
    }
?>