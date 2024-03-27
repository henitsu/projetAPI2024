<?php
    // Envoi de la réponse au Client
    function deliverResponse($status_code, $status_message, $data=null){
        $methods = 'GET, POST, PATCH, DELETE, OPTIONS';
        // Paramétrage de l'entête HTTP
        $headers = 'Content-Type, Authorization';
        http_response_code($status_code); // Utilise un message standardisé en fonction du code HTTP
        // header("HTTP/1.1 $status_code $status_message"); // Permet de personnaliser le message associé au code HTTP
        header("Content-Type:application/json; charset=utf-8"); // Indique au client le format de la réponse
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: $headers");

        /// GESTION DES CORS DANS .htaccess
        $response['status_code'] = $status_code;
        $response['status_message'] = $status_message;
        $response['data'] = $data;

        // Mapping de la réponse au format JSON
        $json_response = json_encode($response);
        if($json_response === false){
            die('json encode ERROR : '.json_last_error_msg());
        }
        // Affichage de la réponse retournée au client
        echo $json_response;
    }
?>