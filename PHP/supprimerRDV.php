<!DOCTYPE html>
<html>
    <head>
        <title>Suppression d'un RDV</title>
		<link rel="shortcut icon" href="/Donnees/patientele_icon.ico" />
		<link rel="stylesheet" href="/CSS/base.css">
        <meta charset='utf-8'>
    </head>
    <body>
        <h1>Supprimer un RDV</h1>
		<?php
		
			include 'header.php'; 
			// Connexion à la base de données
			require 'connexionBD.php';
			
			try {
				// Stockage de l'identifiant de l'usager
				$idusager = $_GET['idusager'];	
                $Id_Medecin = $_GET['Id_Medecin'];
                $dateHeureRDV = $_GET['dateHeure'];		
				
				// Utilisation de la clause WHERE avec une requête préparée
				// Suppression RDV
				$suppressionRDV = "DELETE FROM rdv WHERE idusager = :idusager AND Id_Medecin = :Id_Medecin AND
                dateHeureRDV = :DateHeureRDV";
				
				// Préparation des requêtes
				$stmt = $bdd->prepare($suppressionRDV);
				
				// Liaison des paramètres requête suppression RDV
				$stmt->bindParam(':idusager', $idusager, PDO::PARAM_STR);
                $stmt->bindParam(':Id_Medecin', $Id_Medecin, PDO::PARAM_STR);
                $stmt->bindParam(':DateHeureRDV', $dateHeureRDV, PDO::PARAM_STR);

				// Exécution des requêtes
				$stmt->execute();

				// Stocker le message dans la variable de session
				$_SESSION['message'] = "Le RDV a été supprimé avec succès";
				
				// Redirection vers la page d'affichage des médecins
				header('Location: /PHP/affichageRDV.php');
				exit();

			} catch(PDOException $e) {
				echo "Erreur : " . $e->getMessage();
			}
		?>
		
    </body>
</html>