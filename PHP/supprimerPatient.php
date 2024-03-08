<!DOCTYPE html>
<html>
    <head>
        <title>Suppression d'un usager</title>
		<link rel="shortcut icon" href="../Donnees/patientele_icon.ico" />
		<link rel="stylesheet" href="../CSS/base.css">
        <meta charset='utf-8'>
    </head>
    <body>
		<?php
			require 'connexionBD.php';
			include 'header.php';

			echo '<h1>Supprimer un usager</h1>';
			
			try {
				// Stockage de l'identifiant de l'usager
				$id_usager = $_GET['id'];
				$nom = $_GET['nom'];
				$prenom = $_GET['prenom'];

				// Utilisation de la clause WHERE avec une requête préparée
				// Suppression usager
				$suppressionUsager = "DELETE FROM usager WHERE id_usager = :id_usager";
				
				// Suppression Consultation
				$suppressionConsultation = "DELETE FROM consultation WHERE id_usager = :id_usager";
				
				// Préparation des requêtes
				$stmtConsultation = $bdd->prepare($suppressionConsultation);
				$stmtUsager = $bdd->prepare($suppressionUsager);
				
				// Liaison des paramètres requête suppression Consultation
				$stmtConsultation->bindParam(':id_usager', $id_usager, PDO::PARAM_STR);

				// idem pour l'usager
				$stmtUsager->bindParam(':id_usager', $id_usager, PDO::PARAM_STR);

				// Exécution des requêtes
				$stmtConsultation->execute();
				$stmtUsager->execute();
				
				// Stocker le message dans la variable de session
				$_SESSION['message'] = "Le patient a été supprimé avec succès";;

				// Redirection vers la page d'affichage des médecins
				header('Location: affichagePatient.php');
				exit();
				
			} catch(PDOException $e) {
				echo "Erreur : " . $e->getMessage();
			}
		?>
		
    </body>
</html>