 <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Modification patient</title>
	<link rel="shortcut icon" href="../Donnees/patientele_icon.ico" />
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/modifier.css">
</head>
<body>
	<?php include 'header.php';

		require 'connexionBD.php';

		try {
			if ($_SERVER["REQUEST_METHOD"] == "GET") {
				$nom = $_GET['nom'];
				$prenom = $_GET['prenom'];
				$adresse = $_GET['adresse'];
				$ville = $_GET['ville'];
				$code_postal = $_GET['code_postal'];
				$date_nais = $_GET['date_nais'];
				$lieu_nais = $_GET['lieu_nais'];
				$num_secu = $_GET['num_secu'];

				$sql = "SELECT * FROM usager
					WHERE nom = :nom
					AND prenom = :prenom
					AND adresse = :adresse
					AND ville = :ville
					AND code_postal = :code_postal
					AND date_nais = :date_nais
					AND lieu_nais = :lieu_nais
					AND num_secu = :num_secu
					AND sexe = :sexe";
				$stmt = $bdd->prepare($sql);
				$stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
				$stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
				$stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
				$stmt->bindParam(':ville', $ville, PDO::PARAM_STR);
				$stmt->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
				$stmt->bindParam(':date_nais', $date_nais, PDO::PARAM_STR);
				$stmt->bindParam(':lieu_nais', $lieu_nais, PDO::PARAM_STR);
				$stmt->bindParam(':num_secu', $num_secu, PDO::PARAM_STR);
				$stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
				$stmt->execute();
				$usager = $stmt->fetch(PDO::FETCH_ASSOC);
				$id = $usager['id_usager'];

				?>
				<h1>Modification des informations de <?php echo $prenom ." ". $nom; ?></h1>
				<div class="form">
					<form action="modifierPatient.php?id_usager=<?php echo $id; ?>" method="post">
						<label for="Nom">Nom :</label>
						<input type="text" id="nom" name="Nom" value="<?php echo $usager['nom']; ?>" required><br>

						<label for="Prenom">Prénom :</label>
						<input type="text" id="prenom" name="Prenom" value="<?php echo $usager['prenom']; ?>" required><br>

						<label for="Adresse">Adresse :</label>
						<input type="text" id="adresse" name="Adresse" value="<?php echo $usager['adresse']; ?>" required><br>
						
						<label for="ville">Ville :</label>
						<input type="text" id="ville" name="ville" value="<?php echo $usager['ville']; ?>" required><br>
						
						<label for="code_postal">Code postal :</label>
						<input type="text" id="code_postal" name="code_postal" value="<?php echo $usager['code_postal']; ?>" required><br>

						<label for="date_nais">Date naissance :</label>
						<input type="date" id="date_nais" name="date_nais" value="<?php echo $usager['date_nais']; ?>" required><br>

						<label for="lieu_nais">Lieu naissance :</label>
						<input type="text" id="lieu_nais" name="lieu_nais" value="<?php echo $usager['lieu_nais']; ?>" required><br>

						<label for="num_secu">Numéro de sécurité sociale :</label>
						<input type="text" id="num_secu" name="num_secu" value="<?php echo $usager['num_secu']; ?>" required><br>
						
						<label for="sexe">Sexe :</label>
						<input type="text" id="sexe" name="sexe" value="<?php echo $usager['sexe']; ?>" required><br>

						<input type="submit" value="Modifier l'usager">
					</form>
				</div>
				
				<?php
			} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
				$id = $_GET['id_usager'];
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
				$adresse = $_POST['adresse'];
				$ville = $_POST['ville'];
				$code_postal = $_POST['code_postal'];
				$sexe = $_POST['sexe'];
				$date_nais = $_POST['date_nais'];
				$lieu_nais = $_POST['lieu_nais'];
				$num_secu = $_POST['num_secu'];

				$sql = "UPDATE usager SET nom = :nom, prenom = :prenom, adresse = :adresse, ville = :ville, code_postal = :code_postal, sexe = :sexe, date_nais = :date_nais, lieu_nais = :lieu_nais, num_secu = :num_secu WHERE id_usager = :id_usager";
				$stmt = $bdd->prepare($sql);
				$stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
				$stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
				$stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
				$stmt->bindParam(':ville', $ville, PDO::PARAM_STR);
				$stmt->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
				$stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
				$stmt->bindParam(':date_nais', $date_nais, PDO::PARAM_STR);
				$stmt->bindParam(':lieu_nais', $lieu_nais, PDO::PARAM_STR);
				$stmt->bindParam(':num_secu', $num_secu, PDO::PARAM_STR);
				$stmt->bindParam(':id_usager', $id, PDO::PARAM_INT);
				$stmt->execute();

				echo 'Usager modifié avec succès';
			} else {
				echo "Méthode non autorisée";
			}
		} catch (PDOException $e) {
			echo "Erreur : " . $e->getMessage();
		}
	?>
	<button onclick="window.location.href='affichagePatient.php'">Retour</button>
</body>