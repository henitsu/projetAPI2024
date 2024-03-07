<!DOCTYPE html>
<html>
    <head>
        <title>Suppression d'un médecin</title>
		<link rel="shortcut icon" href="/Donnees/patientele_icon.ico" />
		<link rel="stylesheet" href="/CSS/base.css">
        <meta charset='utf-8'>
    </head>
    <body>
        <h1>Supprimer un médecin
        </h1>
		<?php
			// Connexion à la base de données
			require 'connexionBD.php';
			include 'header.php';
			
			try {
				// Stockage de l'identifiant du médecin
				$id = $_GET['Id_Medecin'];	
				$nom = $_GET['nom'];
				$prenom = $_GET['prenom'];		
				
				// Si le médecin n'est pas référent d'un usager, on peut le supprimer
				try {
					// Suppression medecin
					$suppressionMedecin = "DELETE FROM medecin WHERE Id_Medecin = :Id_Medecin";
					
					// Suppression RDV
					$suppressionRDV = "DELETE FROM rdv WHERE Id_Medecin = :Id_Medecin";

					$stmtRDV = $bdd->prepare($suppressionRDV);
					$stmtMedecin = $bdd->prepare($suppressionMedecin);
					
					$stmtMedecin->bindParam(':Id_Medecin', $id, PDO::PARAM_STR);
					$stmtRDV->bindParam(':Id_Medecin', $id, PDO::PARAM_STR);

					$stmtMedecin->execute();
					$stmtRDV->execute();

					// Stocker le message dans la variable de session
					$_SESSION['message'] = "Le médecin a été supprimé avec succès !";;
					
					// Redirection vers la page d'affichage des médecins
					header('Location: /PHP/affichageMedecin.php');
					exit();
				}
				// Sinon, le médecin est référent d'un usager, donc on ne peut pas le supprimer => affichage message erreur
				catch(PDOException) {
					$_SESSION['message'] = "Le médecin est un référent auprès d'autres patients, il ne peut pas être supprimé.";
					// Redirection vers la page d'affichage des médecins
					header('Location: /PHP/affichageMedecin.php');
					exit();
				}
				
			} catch(PDOException $e) {
				echo "Erreur : " . $e->getMessage();
			}
		?>
		
    </body>
</html>