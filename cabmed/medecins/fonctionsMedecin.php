<?php
    // Inclusion de la classe Medecin et de la BD
    require 'medecin.php';
    require '../connexionBD.php';
    require '../deliverResponse.php';

    // FONCTIONS de gestion des médecins
    // POST
    function createMedecin($linkpdo, $nom, $prenom, $civilite){
        // Ajout du médecin dans la BD
        try{
            $sql = "INSERT INTO medecin (civilite, nom, prenom) VALUES (:civilite, :nom, :prenom)";
            $stmt = $linkpdo->prepare($sql);
            $stmt->bindParam(':civilite', $civilite, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $linkpdo->beginTransaction();
            $res = $stmt->execute();
            if(!$res){
                deliverResponse(500, "Erreur lors de l'ajout du médecin", null);
                die('Erreur exécution requête : '.$stmt->errorInfo()[2]);
            }
            $id = $linkpdo->lastInsertId();
            $linkpdo->commit();
            
            deliverResponse(200, "Médecin rajouté", $id);
        } catch(Exception $e){
            echo 'Erreur : '.$e->getMessage();
        }  
    }

    // GET
    function getMedecins($linkpdo, $id_medecin=null){
        if($id_medecin!=null){
            $sql = "SELECT * FROM medecin WHERE id_medecin = :id_medecin";
            $stmt = $linkpdo->prepare($sql);
            $stmt->bindParam(':id_medecin', $id_medecin, PDO::PARAM_INT);
            $stmt->execute();
            if($stmt->rowCount() == 0){
                deliverResponse(404, "Médecin inexistant", null);
            }
        } else {
            $sql = "SELECT * FROM medecin";
            $stmt = $linkpdo->query($sql);
        }
        deliverResponse(200, "OK", $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    // PATCH
    function updateMedecin($linkpdo, $id_medecin, $data){
        
        try {
            // Récupération des données du médecin

            // Récupération des clés dans $data
            $keys = array_keys($data);

            $sqlValues = array_map(function($keys) {
                return $keys . " = :" . $keys;
            }, $keys);

            $sql = "UPDATE medecin SET  " . implode(", ", $sqlValues) .
                " WHERE id_medecin = :id_medecin;";

            // Préparation de la requête
            $sth = $linkpdo->prepare($sql);
            if($sth==false){
                die('Erreur préparation requête : ');
            }
            $stmt = $linkpdo->prepare($sql);
            foreach($data as $key => $value){
                $stmt->bindParam(':'.$key, $value, PDO::PARAM_STR);
            }

            $stmt->bindParam(':id_medecin', $id_medecin, PDO::PARAM_INT);
            $stmt->execute();

            // Vérification de la modification
            $modif = "SELECT * FROM medecin WHERE id_medecin = :id_medecin";
            $stmtM = $linkpdo->prepare($modif);
            $stmtM->bindParam(':id_medecin', $id_medecin, PDO::PARAM_INT);
            $stmtM->execute();
            $rowCount = $stmt->rowCount();
            if ($rowCount === 0) {
                deliverResponse(200, "Aucune modification nécessaire", 0);
            } else {
                deliverResponse(200, "Médecin modifié", $stmtM->fetch());
            }
        
        } catch(Exception $e){
            echo 'Erreur : '.$e->getMessage();
        }
    }

    // DELETE
    function deleteMedecin($linkpdo, $id_medecin){
        try {
            $sql = "DELETE FROM medecin WHERE id_medecin = :id_medecin";
            $stmt = $linkpdo->prepare($sql);
            $stmt->bindParam(':id_medecin', $id_medecin, PDO::PARAM_INT);
            $stmt->execute();
            if($stmt->rowCount() == 0){
                deliverResponse(404, "Médecin inexistant", null);
            }
            deliverResponse(200, "Médecin supprimé", null);
        } catch(Exception $e){
            echo 'Erreur : '.$e->getMessage();
        }
    }
    
?>