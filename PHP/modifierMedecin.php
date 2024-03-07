 <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Modification médecin</title>
	<link rel="shortcut icon" href="/Donnees/patientele_icon.ico" />
    <link rel="stylesheet" href="/CSS/base.css">
    <link rel="stylesheet" href="/CSS/modifier.css">
</head>
<body>
	<?php include 'header.php';
		require 'connexionBD.php';

		try {
			if ($_SERVER["REQUEST_METHOD"] == "GET") {
				$nom = $_GET['nom'];
				$prenom = $_GET['prenom'];
				$civilite = $_GET['civilite'];

				$sql = "SELECT * FROM medecin WHERE Nom = :Nom AND Prenom = :Prenom AND Civilite = :Civilite";
				$stmt = $bdd->prepare($sql);
				$stmt->bindParam(':Nom', $nom, PDO::PARAM_STR);
				$stmt->bindParam(':Prenom', $prenom, PDO::PARAM_STR);
				$stmt->bindParam(':Civilite', $civilite, PDO::PARAM_STR);
				$stmt->execute();
				$medecin = $stmt->fetch(PDO::FETCH_ASSOC);
				$id = $medecin['Id_Medecin'];

				?>
				<h1>Modification des informations de <?php echo $prenom ." ". $nom; ?></h1>
				<div class="form">
					<form action="modifierMedecin.php?Id_Medecin=<?php echo $id; ?>" method="post">
						<label for="Nom">Nom :</label>
						<input type="text" id="nom" name="Nom" value="<?php echo $medecin['Nom']; ?>" required><br>

						<label for="Prenom">Prénom :</label>
						<input type="text" id="prenom" name="Prenom" value="<?php echo $medecin['Prenom']; ?>" required><br>

						<label for="Civilite">Civilité :</label>
						<input type="text" id="civilite" name="Civilite" value="<?php echo $medecin['Civilite']; ?>" required><br>

						<input type="submit" value="Enregistrer les modifications">
					</form>
				</div>
				
				<?php
			} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
				$id = $_GET['Id_Medecin'];
				$nom = $_POST['Nom'];
				$prenom = $_POST['Prenom'];
				$civilite = $_POST['Civilite'];

				$sql = "UPDATE medecin SET Nom = :Nom, Prenom = :Prenom, Civilite = :Civilite WHERE Id_Medecin = :Id_Medecin";
				$stmt = $bdd->prepare($sql);
				$stmt->bindParam(':Nom', $nom, PDO::PARAM_STR);
				$stmt->bindParam(':Prenom', $prenom, PDO::PARAM_STR);
				$stmt->bindParam(':Civilite', $civilite, PDO::PARAM_STR);
				$stmt->bindParam(':Id_Medecin', $id, PDO::PARAM_INT);
				$stmt->execute();

				echo 'Médecin modifié avec succès';
			} else {
				echo "Méthode non autorisée";
			}
		} catch (PDOException $e) {
			echo "Erreur : " . $e->getMessage();
		}
	?>
	<button onclick="window.location.href='/PHP/affichageMedecin.php'">Retour</button>
</body>