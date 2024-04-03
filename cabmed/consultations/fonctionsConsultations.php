<?php
    require '../connexionBD.php';
    require '../deliverResponse.php';
    
    function getConsultations($linkpdo, $id = null){
        if ($id != null){
            $sth = $linkpdo->prepare('SELECT consultation.id_consult, consultation.id_medecin, consultation.id_usager, consultation.date_consult, consultation.heure_consult, consultation.duree_consult, usager.nom nom_usager, medecin.nom nom_medecin FROM consultation, usager, medecin WHERE consultation.id_consult = :id_consult');
            if($sth==false){
                die('Erreur Préparation Requête : ');
            }
            $sth->bindParam(':id_consult', $id, PDO::PARAM_INT);
        }
        else{
            $sth = $linkpdo->prepare('SELECT consultation.id_consult, consultation.id_medecin, consultation.id_usager, consultation.date_consult, consultation.heure_consult, consultation.duree_consult, usager.nom nom_usager, medecin.nom nom_medecin FROM consultation, usager, medecin WHERE consultation.id_usager = usager.id_usager AND consultation.id_medecin = medecin.id_medecin ORDER BY consultation.date_consult, consultation.heure_consult');
            if($sth==false){
                die('Erreur Préparation Requête : ');
            }
        }
        $resExec=$sth->execute();
        if(!$resExec){
            deliverResponse(500, "Erreur serveur", NULL);
            die('Erreur exécution requête : ');
        }
        if ($sth->rowCount() == 0) {
            deliverResponse(404, "Aucune consultation trouvée", NULL);
        } else {
            // Récupération des données (fetch)
            deliverResponse(200, "OK (récupération consultation(s))", $sth->fetchAll(PDO::FETCH_ASSOC));
        }
    }


    function createConsultation($linkpdo, $id_medecin, $id_patient, $date_consult, $heure_consult, $duree_consult){

        $sth = $linkpdo->prepare('INSERT INTO `consultation` (`date_consult`, `heure_consult`, `duree_consult`, `id_medecin`,
        `id_usager`) VALUES (:date_consult, :heure_consult, :duree_consult, :id_medecin, :id_usager)');
        if($sth==false){
            die('Erreur Préparation Requête : ');
        }

        $sth->bindParam(':date_consult', $date_consult, PDO::PARAM_STR);
        $sth->bindParam(':heure_consult', $heure_consult, PDO::PARAM_STR);
        $sth->bindParam(':duree_consult', $duree_consult, PDO::PARAM_STR);
        $sth->bindParam(':id_medecin', $id_medecin, PDO::PARAM_INT);
        $sth->bindParam(':id_usager', $id_patient, PDO::PARAM_INT);

        $linkpdo->beginTransaction(); // Démarrage de la transaction

        $resExec=$sth->execute();
        if(!$resExec){
            deliverResponse(500, "Erreur serveur", NULL);
            die('Erreur Exécution Requête : ');
        }

        $newId=$linkpdo->lastInsertId(); // Récupération de l'id de la nouvelle consultation

        $linkpdo->commit(); // Fin de la transaction et application des données

        deliverResponse(201, "Consultation créée ", $newId);

    }  
    
        
    function updateConsultation($linkpdo, $id_consult, $data) {

        try {
            // Récupération des clés dans $data
            $keys = array_keys($data);

            $sqlValues = array_map(function($keys) {
                return $keys . " = :" . $keys;
            }, $keys);

            // Mise à jour de la phrase
            $sql = "UPDATE consultation SET  " . implode(", ", $sqlValues) .
                " WHERE id_consult = :id_consult";
            $stmt = $linkpdo->prepare($sql);
            foreach($data as $key => $value){
                $stmt->bindValue(':'.$key, $value, PDO::PARAM_STR);
            }

            $stmt->bindParam(':id_consult', $id_consult, PDO::PARAM_INT);
            $stmt->execute();

            // Vérification de la modification
            $modif = "SELECT * FROM consultation WHERE id_consult = :id_consult";
            $stmtM = $linkpdo->prepare($modif);
            $stmtM->bindParam(':id_consult', $id_consult, PDO::PARAM_INT);
            $stmtM->execute();
            $rowCount = $stmt->rowCount();
            if ($rowCount === 0) {
                deliverResponse(200, "Aucune modification nécessaire", 0);
            } else {
                deliverResponse(200, "Consultation modifiée", $stmtM->fetch());
            }
        } catch (PDOException $e) {
            deliverResponse(500, "Erreur lors de la modification de la consultation");
            die('Erreur préparation/execution requête : ' . $e-> getMessage());
        }
    }


    function deleteConsultation($linkpdo, $id){

        $sth = $linkpdo->prepare('DELETE FROM `consultation` WHERE `id_consult` = :id_consult');
        if($sth==false){
            die('Erreur préparation requête : ');
        }
        $sth->bindParam(':id_consult', $id, PDO::PARAM_INT);
        
        $resExec=$sth->execute();
        if(!$resExec){
            deliverResponse(500, "Erreur serveur", NULL);
            die('Erreur exécution requête : ');
        }
        
        deliverResponse(200, "Consultation supprimée", $id);
    }       
    
?>