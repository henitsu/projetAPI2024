<?php
    // Inclusion de la classe Medecin et de la BD
    require 'medecin.php';
    require './cabmed/connexionBD.php';
    require './cabmed/deliverResponse.php';

    // FONCTIONS de gestion des médecins
    // POST
    function createMedecin($linkpdo, $nom, $prenom, $civilite){
        // Ajout du patient dans la BD
        try{
            $sql = "INSERT INTO medecin (civilite, nom, prenom) VALUES (:civilite, :nom, :prenom)";
            $stmt = $linkpdo->prepare($sql);
            $stmt->bindParam(':civilite', $civilite, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->execute();
            $linkpdo->beginTransaction();
            $res = $stmt->execute();
            if(!$res){
                die('Erreur exécution requête : '.$stmt->errorInfo()[2]);
                deliverResponse(500, "Erreur lors de l'ajout de la phrase", null);
            }
            $id = $linkpdo->lastInsertId();
            $linkpdo->commit();
            
            deliverResponse(200, "Médecin rajouté", $id);
        } catch(Exception $e){
            echo 'Erreur : '.$e->getMessage();
        }  
    }

    // GET
    function getMedecins($linkpdo, $id=null){
        if($id!=null){
            $sql = "SELECT * FROM medecin WHERE id = :id";
            $stmt = $linkpdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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

    // PUT, PATCH
    function updateMedecin($linkpdo, $id, $data){
        try {
            // Récupération des données du médecin
            $keys = array_keys($data);
            $sqlValues = array_map(function($keys) {
                return $keys . " = :" . $keys;
            }, $keys);
            $sql = "UPDATE medecin SET  " . implode(", ", $sqlValues) . " WHERE id = :id";
            $stmt = $linkpdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            foreach($data as $key => $value){
                $stmt->bindParam(':'.$key, $value, PDO::PARAM_STR);
            }
            $stmt->execute();
            if($stmt->rowCount() == 0){
                deliverResponse(404, "Médecin inexistant", null);
            }
            deliverResponse(200, "Médecin modifié", null);
        } catch(Exception $e){
            echo 'Erreur : '.$e->getMessage();
        }
    }

    // DELETE
    function deleteMedecin($linkpdo, $id){
        try {
            $sql = "DELETE FROM medecin WHERE id = :id";
            $stmt = $linkpdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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