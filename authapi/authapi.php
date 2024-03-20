<?php
    require 'connexionBD_authapi.php';
    include 'jwt_utils.php';

    // Récupération du login et mot de passe
    $http_method = $_SERVER['REQUEST_METHOD'];
    if(!empty($http_method) && $http_method==='POST'){
        $login = $_POST['login'];

        // Vérification du login dans la BD
        $sql_login = "SELECT * FROM user_auth_v1 WHERE login = :login";
        $res = $linkpdo->prepare($sql_login);
        $res->bindParam(':login', $login, PDO::PARAM_STR);
        $res->execute();
        $db_password = $res->fetch()['mdp'];
        if(!$res){
            header('HTTP/1.0 401 Unauthorized');
            echo 'Identifiant incorrect';
            exit;
        } else {
            if(password_verify($_POST['mdp'], $db_password)){
                $pass = $db_password;
                // Récupération de ses coordonnées dans la BD
                $sql = "SELECT * FROM user_auth_v1 WHERE login = :login AND mdp = :mdp";
                $stmt = $linkpdo->prepare($sql);
                $stmt->bindParam(':login', $login, PDO::PARAM_STR);
                $stmt->bindParam(':mdp', $pass, PDO::PARAM_STR);
                $stmt->execute();
                if($stmt->rowCount()==1){
                    // Envoi de token
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
                    // Récupération du headers
                    $jwt_headers = ['alg' => 'HS256', 'typ' => 'JWT'];
    
                    // Récupération du payload
                    $jwt_payload = ['user_id' => $user['id'],
                        'login' => $user['login'],
                        'exp' => time()*3000];
    
                    // Le secret ??
                    $jwt_secret = "Un truc random hehe";
    
                    // Création du token
                    $jwt_token = generate_jwt($jwt_headers, $jwt_payload, $jwt_secret);
    
                    // Envoi du jeton en réponse
                    header('Content-Type: application/json');
                    echo json_encode(['token' => $jwt_token]);
                    exit;
                } else {
                    // Utilisateur non reconnu
                    header('HTTP/1.0 401 Unauthorized');
                    echo 'Login et/ou mot de passe incorrects';
                    exit;
                }
            } else {
                header('HTTP/1.0 401 Unauthorized');
                echo 'Mot de passe incorrect';
            }
        }
    } else {
        // Méthode non autorisée
        header('HTTP/1.0 405 Method Not Allowed');
        echo 'Method not allowed';
        exit;
    }
?>