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

				$sql = "SELECT * FROM medecin WHERE nom = :nom AND prenom = :prenom AND civilite = :civilite";
				$stmt = $bdd->prepare($sql);
				$stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
				$stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
				$stmt->bindParam(':civilite', $civilite, PDO::PARAM_STR);
				$stmt->execute();
				$medecin = $stmt->fetch(PDO::FETCH_ASSOC);
				$id = $medecin['id_medecin'];

				?>
				<h1>Modification des informations de <?php echo $prenom ." ". $nom; ?></h1>
				<div class="form">
					<form action="modifierMedecin.php?id_medecin=<?php echo $id; ?>" method="post">
						<label for="nom">Nom :</label>
						<input type="text" id="nom" name="nom" value="<?php echo $medecin['nom']; ?>" required><br>

						<label for="prenom">Prénom :</label>
						<input type="text" id="prenom" name="prenom" value="<?php echo $medecin['prenom']; ?>" required><br>

						<label for="civilite">Civilité :</label>
						<input type="text" id="civilite" name="civilite" value="<?php echo $medecin['civilite']; ?>" required><br>

						<input type="submit" value="Enregistrer les modifications">
					</form>
				</div>
				
				<?php
			} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
				$id = $_GET['id_medecin'];
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
				$civilite = $_POST['civilite'];

				$sql = "UPDATE medecin SET nom = :nom, prenom = :prenom, civilite = :civilite WHERE id_medecin = :id_medecin";
				$stmt = $bdd->prepare($sql);
				$stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
				$stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
				$stmt->bindParam(':civilite', $civilite, PDO::PARAM_STR);
				$stmt->bindParam(':id_medecin', $id, PDO::PARAM_INT);
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