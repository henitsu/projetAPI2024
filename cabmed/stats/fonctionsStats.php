<?php

    include '../connexionBD.php';
    include '../deliverResponse.php';

    // fonctions de récupération des statistiques
    function getNbFemmesMoins25Ans($linkpdo){
        $sql = "SELECT COUNT(*) NbFemmes from  usager WHERE DATEDIFF(DATE(NOW()), date_nais) < 9125
        AND sexe = 'F'";
        $stmt = $linkpdo->query($sql);
        deliverResponse(200, "OK", $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    function getNbFemmesMilieu($linkpdo){
        $sql = "SELECT COUNT(*) NbFemmes from  usager WHERE sexe = 'F' DATEDIFF(DATE(NOW()), date_nais) BETWEEN 9125 AND 14600";
        $stmt = $linkpdo->query($sql);
        deliverResponse(200, "OK", $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    function getNbFemmesPlus50Ans($linkpdo){
        $sql = "SELECT COUNT(*) NbFemmes from  usager WHERE DATEDIFF(DATE(NOW()), date_nais) > 14600
        AND sexe = 'F'";
        $stmt = $linkpdo->query($sql);
        deliverResponse(200, "OK", $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    function getNbHommesMoins25Ans($linkpdo){
        $sql = "SELECT COUNT(*) NbHommes from  usager WHERE DATEDIFF(DATE(NOW()), date_nais) < 9125
        AND sexe = 'H'";
        $stmt = $linkpdo->query($sql);
        deliverResponse(200, "OK", $stmt->fetchAll(PDO::FETCH_ASSOC));
    }  

    function getHommesMilieu($linkpdo){
        $sql = "SELECT COUNT(*) NbHommes from  usager WHERE sexe = 'H' DATEDIFF(DATE(NOW()), date_nais) BETWEEN 9125 AND 14600";
        $stmt = $linkpdo->query($sql);
        deliverResponse(200, "OK", $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    function getHommesPlus50Ans($linkpdo){
        $sql = "SELECT COUNT(*) NbHommes from  usager WHERE DATEDIFF(DATE(NOW()), date_nais) > 14600
        AND sexe = 'H'";
        $stmt = $linkpdo->query($sql);
        deliverResponse(200, "OK", $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    function nBHeuresMedecin($linkpdo){
        $sql = "SELECT SUM(nbr_heures) as nbHeures FROM medecin";
        $stmt = $linkpdo->query($sql);
        deliverResponse(200, "OK", $stmt->fetchAll(PDO::FETCH_ASSOC));
    }
?>