<?php
    // Connexion à la base de données
    $servname = "mysql-patientele.alwaysdata.net";
    $dbname = "patientele_db_auth";
    $user = "344078_etu";
    $pass = "iutinfo";
     
    try {
        $linkpdo = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
        $linkpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die('Erreur de connexion à la base de données :: ' . $e->getMessage());
    }
?>