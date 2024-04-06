<?php 
    require '../connexionBD.php';
    require '../deliverResponse.php';

    function getPatients($linkpdo, $id = null){
        if ($id != null){
            $sth = $linkpdo->prepare('SELECT * FROM `usager` WHERE `id_usager` = :id_usager');
            if($sth==false){
                die('Erreur Préparation Requête : ');
            }
            $sth->bindParam(':id_usager', $id, PDO::PARAM_INT);
        }
        else{
            $sth = $linkpdo->prepare('SELECT * FROM `usager`');
            if($sth==false){
                die('Erreur Préparation Requête : ');
            }
        }
        $resExec=$sth->execute();
        if(!$resExec){
            deliverResponse(500, "Erreur serveur", NULL);
            die('Erreur Exécution Requête : ');
        }

        if ($sth->rowCount() == 0) {
            deliverResponse(404, "Aucun patient trouvé", NULL);
        } else {
            deliverResponse(200, "OK (récupération patient(s))", $sth->fetchAll(PDO::FETCH_ASSOC));
        }
    }


    function createPatient($linkpdo, $nom, $prenom, $sexe, $adresse, $code_postal, $ville, $date_nais, $lieu_nais, $num_secu, $civilite, $id_medecin){

        $sth = $linkpdo->prepare('INSERT INTO `usager` (`civilite`, `nom`, `prenom`, `sexe`,
        `adresse`, `code_postal`, `ville`, `date_nais`, `lieu_nais`, `num_secu`, `id_medecin`) VALUES (:civilite, :nom, :prenom, 
        :sexe, :adresse, :code_postal, :ville, :date_nais, :lieu_nais, :num_secu, :id_medecin)');
        if($sth==false){
            die('Erreur Préparation Requête : ');
        }
        $date = date('Y-m-d', strtotime(str_replace('/', '-', $date_nais)));
        $sth->bindParam(':civilite', $civilite, PDO::PARAM_STR); 
        $sth->bindParam(':nom', $nom, PDO::PARAM_STR);
        $sth->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $sth->bindParam(':sexe', $sexe, PDO::PARAM_STR);
        $sth->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $sth->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
        $sth->bindParam(':ville', $ville, PDO::PARAM_STR);
        $sth->bindParam(':date_nais', $date, PDO::PARAM_STR);
        $sth->bindParam(':lieu_nais', $lieu_nais, PDO::PARAM_STR);
        $sth->bindParam(':num_secu', $num_secu, PDO::PARAM_STR);
        $sth->bindParam(':id_medecin', $id_medecin, PDO::PARAM_STR);

        $linkpdo->beginTransaction(); // Démarrage de la transaction

        $resExec=$sth->execute();
        if(!$resExec){
            deliverResponse(500, "Erreur serveur", NULL);
            die('Erreur Exécution Requête : ');
        }

        $newId=$linkpdo->lastInsertId(); // Récupération de l'id du nouveau patient

        $linkpdo->commit(); // Fin de la transaction et application des données

        deliverResponse(201, "Patient créé", $newId);

    }  
    
        
    function updatePatient($linkpdo, $id_usager, $data) {
        try {
            // Récupération des clés dans $data
            $keys = array_keys($data);
    
            $sqlValues = array_map(function($keys) {
                return $keys . " = :" . $keys;
            }, $keys);
    
            // Mise à jour de l'usager
            $sql = "UPDATE usager SET  " . implode(", ", $sqlValues) .
                " WHERE id_usager = :id_usager;";
    
            // Préparation de la requête
            $stmt = $linkpdo->prepare($sql);
            if($stmt==false){
                die('Erreur préparation requête : ');
            }
            foreach($data as $key => $value){
                $stmt->bindValue(':'.$key, $value, PDO::PARAM_STR);
            }
    
            $stmt->bindParam(':id_usager', $id_usager, PDO::PARAM_INT);
            $stmt->execute();
    
            // Vérification de la modification
            $modif = "SELECT id_usager, civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin FROM usager WHERE id_usager = :id_usager";
            $stmtM = $linkpdo->prepare($modif);
            $stmtM->bindParam(':id_usager', $id_usager, PDO::PARAM_INT);
            $stmtM->execute();
            $rowCount = $stmtM->rowCount();
            if ($rowCount === 0) {
                deliverResponse(200, "Aucune modification nécessaire", 0);
            } else {
                deliverResponse(200, "Patient modifié", $stmtM->fetch());
            }
        } catch (PDOException $e) {
            deliverResponse(500, "Erreur lors de la modification du patient");
            die('Erreur préparation/execution requête : ' . $e-> getMessage());
        }
    }

    function deletePatient($linkpdo, $id){

        $sth = $linkpdo->prepare('DELETE FROM `usager` WHERE `id_usager` = :id_usager');
        if($sth==false){
            die('Erreur préparation requête : ');
        }
        $sth->bindParam(':id_usager', $id, PDO::PARAM_INT);
        
        $resExec=$sth->execute();
        if(!$resExec){
            deliverResponse(500, "Erreur serveur", NULL);
            die('Erreur exécution requête : ');
        }
        
        deliverResponse(200, "Patient supprimé", $id);
    }    
    
?>