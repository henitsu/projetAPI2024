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
	<?php include 'header.php';?>
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
	<button onclick="window.location.href='affichagePatient.php'">Retour</button>
</body>