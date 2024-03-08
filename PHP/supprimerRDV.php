<!DOCTYPE html>
<html>
    <head>
        <title>Suppression d'un RDV</title>
		<link rel="shortcut icon" href="../Donnees/patientele_icon.ico" />
		<link rel="stylesheet" href="../CSS/base.css">
        <meta charset='utf-8'>
    </head>
    <body>
        <h1>Supprimer un RDV</h1>
		<?php
		
			include 'header.php'; 
			// Connexion à la base de données
			require 'connexionBD.php';
			
			try {
				// Stockage de l'identifiant de la consultation
				$id_consultation = $_GET['id_consultation'];	
                $date_consult = $_GET['date_consult'];
                $heure_consult = $_GET['heure_consult'];	
				$duree = $_GET['duree'];	
				
				// Utilisation de la clause WHERE avec une requête préparée
				// Suppression RDV
				$suppressionRDV = "DELETE FROM consultation WHERE id_consultation = :id_consultation AND date_consult = :date_consult AND
                heure_consult = :heure_consult AND duree = :duree";
				
				// Préparation des requêtes
				$stmt = $bdd->prepare($suppressionRDV);
				
				// Liaison des paramètres requête suppression RDV
				$stmt->bindParam(':id_consultation', $id_consultation, PDO::PARAM_STR);
                $stmt->bindParam(':date_consult', $date_consult, PDO::PARAM_STR);
                $stmt->bindParam(':heure_consult', $heure_consult, PDO::PARAM_STR);
				$stmt->bindParam(':duree', $duree, PDO::PARAM_STR);

				// Exécution des requêtes
				$stmt->execute();

				// Stocker le message dans la variable de session
				$_SESSION['message'] = "Le RDV a été supprimé avec succès";
				
				// Redirection vers la page d'affichage des médecins
				header('Location: affichageRDV.php');
				exit();

			} catch(PDOException $e) {
				echo "Erreur : " . $e->getMessage();
			}
		?>
		
    </body>
</html>