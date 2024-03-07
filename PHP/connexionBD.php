<?php
    // Connexion à la base de données
    // $servname = "localhost";
    $servname = "mysql-patientele.alwaysdata.net";
    $dbname = "patientele_db";
    $user = "344078_etu";
    $pass = "iutinfo";
     
    try {
        $bdd = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die('Erreur de connexion à la base de données :: ' . $e->getMessage());
    }
?>