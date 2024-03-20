<?php
    // Inclusion de la classe Medecin et de la BD
    require 'medecin.php';
    require '../connexionBD.php';
    require '../deliverResponse.php';

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

            $nom = $data["nom"];
            $prenom = $data["prenom"];
            $civilite = $data["civilite"];

            $sql = "UPDATE medecin SET nom = :nom, prenom = :prenom, civilite = :civilite WHERE id_medecin = :id_medecin";

            $stmt = $linkpdo->prepare($sql);
            $stmt->bindParam(':id_medecin', $id_medecin, PDO::PARAM_INT);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':civilite', $civilite, PDO::PARAM_STR);
            
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