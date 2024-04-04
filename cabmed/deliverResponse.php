<?php
    // Envoi de la réponse au Client
    function deliverResponse($status_code, $status_message, $data=null){
        // Paramétrage de l'entête HTTP
        http_response_code($status_code);
        header("Content-Type: application/json; charset=utf-8");
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