<?php
    require '/xampp/htdocs/API/projetAPI2024/cabmed/connexionBD.php';
    require '/xampp/htdocs/API/projetAPI2024/cabmed/deliverResponse.php';

    // fonctions de récupération des statistiques
    function getNbFemmesMoins25Ans($linkpdo){
        $sql = "SELECT COUNT(*) AS NbFemmesMoins25ans FROM usager WHERE DATEDIFF(DATE(NOW()), date_nais) < 9125 AND sexe = 'F'";
        $stmt = $linkpdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getNbFemmesMilieu($linkpdo){
        $sql = "SELECT COUNT(*) AS NbFemmesMilieu FROM usager WHERE sexe = 'F' AND DATEDIFF(DATE(NOW()), date_nais) BETWEEN 9125 AND 14600";
        $stmt = $linkpdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getNbFemmesPlus50Ans($linkpdo){
        $sql = "SELECT COUNT(*) AS NbFemmesPlus50ans FROM usager WHERE DATEDIFF(DATE(NOW()), date_nais) > 14600 AND sexe = 'F'";
        $stmt = $linkpdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getNbHommesMoins25Ans($linkpdo){
        $sql = "SELECT COUNT(*) AS NbHommesMoins25ans FROM usager WHERE DATEDIFF(DATE(NOW()), date_nais) < 9125 AND sexe = 'H'";
        $stmt = $linkpdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }  

    function getNbHommesMilieu($linkpdo){
        $sql = "SELECT COUNT(*) AS NbHommesMilieu FROM usager WHERE sexe = 'H' AND DATEDIFF(DATE(NOW()), date_nais) BETWEEN 9125 AND 14600";
        $stmt = $linkpdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getNbHommesPlus50Ans($linkpdo){
        $sql = "SELECT COUNT(*) AS NbHommesPlus50ans FROM usager WHERE DATEDIFF(DATE(NOW()), date_nais) > 14600 AND sexe = 'H'";
        $stmt = $linkpdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getNbHeuresConsultations($linkpdo){
        $sql = "SELECT SUM(duree_consult)/60 as NbHeures, medecin.nom as NomMedecin FROM consultation, medecin WHERE medecin.id_medecin = consultation.id_medecin GROUP BY medecin.id_medecin";
        $stmt = $linkpdo->query($sql);
        deliverResponse(200, "OK", $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    // récupération des statistiques des usagers
    function getStatsUsagers($linkpdo){
        $data = array();
        $data['NbFemmesMoins25Ans'] = getNbFemmesMoins25Ans($linkpdo);
        $data['NbFemmesMilieu'] = getNbFemmesMilieu($linkpdo);
        $data['NbFemmesPlus50Ans'] = getNbFemmesPlus50Ans($linkpdo);
        $data['NbHommesMoins25Ans'] = getNbHommesMoins25Ans($linkpdo);
        $data['NbHommesMilieu'] = getNbHommesMilieu($linkpdo);
        $data['NbHommesPlus50Ans'] = getNbHommesPlus50Ans($linkpdo);
        deliverResponse(200, "OK", $data);
    }
?>
