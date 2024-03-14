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
        $sql = "SELECT COUNT(*) NbFemmes from  usager 
        WHERE sexe = 'F' DATEDIFF(DATE(NOW()), date_nais) BETWEEN 9125 AND 14600";
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

    function getNbHommesMilieu($linkpdo){
        $sql = "SELECT COUNT(*) NbHommes from  usager 
        WHERE sexe = 'H' DATEDIFF(DATE(NOW()), date_nais) BETWEEN 9125 AND 14600";
        $stmt = $linkpdo->query($sql);
        deliverResponse(200, "OK", $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    function getNbHommesPlus50Ans($linkpdo){
        $sql = "SELECT COUNT(*) NbHommes from  usager WHERE DATEDIFF(DATE(NOW()), date_nais) > 14600
        AND sexe = 'H'";
        $stmt = $linkpdo->query($sql);
        deliverResponse(200, "OK", $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    function getNbHeuresConsultations($linkpdo){
        $sql = "SELECT SUM(duree_consult)/60, medecin.nom FROM consultation, medecin 
        WHERE medecin.id_medecin = consultation.id_medecin GROUP BY medecin.id_medecin";
        $stmt = $linkpdo->query($sql);
        deliverResponse(200, "OK", $stmt->fetchAll(PDO::FETCH_ASSOC));
    }
?>