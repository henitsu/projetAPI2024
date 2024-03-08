<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Modification consultation</title>
	<link rel="shortcut icon" href="../Donnees/patientele_icon.ico" />
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/modifier.css">
</head>
<body>
	<?php include 'header.php';
		require 'connexionBD.php';

		try {
			if ($_SERVER["REQUEST_METHOD"] == "GET") {
				$nom_usager = $_GET['nom_usager'];
				$nom_medecin = $_GET['nom_medecin'];
				$duree = $_GET['duree'];
                $date_consult = $_GET["date_consult"];
				$heure_consult = $_GET["heure_consult"];

				$sql = "SELECT consultation.id_usager, consultation.id_medecin, consultation.date_consult, consultation.heure_consult, consultation.duree 
                FROM consultation, usager, medecin WHERE usager.Nom = :nom_usager AND medecin.Nom = :nom_medecin AND 
                consultation.date_consult = :date_consult AND consultation.heure_consult = :heure_consult AND consultation.duree = :duree ORDER BY consultation.date_consult, consultation.heure_consult";
				$stmt = $bdd->prepare($sql);
				$stmt->bindParam(':nom_usager', $nom_usager, PDO::PARAM_STR);
				$stmt->bindParam(':nom_medecin', $nom_medecin, PDO::PARAM_STR);
				$stmt->bindParam(':duree', $duree, PDO::PARAM_STR);
                $stmt->bindParam(':date_consult', $date_consult, PDO::PARAM_STR);
				$stmt->bindParam(':heure_consult', $heure_consult, PDO::PARAM_STR);
				$stmt->execute();
				$consultation = $stmt->fetch(PDO::FETCH_ASSOC);

				$id_usager = $consultation['id_usager'];
				$id_medecin = $consultation['id_medecin'];
				?>
				<h1>Modification d'une consultation du docteur <?php echo $nom_medecin; ?></h1>

				<div class="form">
					<form action="modifierRDV.php?id_usager=<?php echo $id_usager;?>&id_medecin=<?php echo $id_medecin ?>" method="post">
						<label for="nom_medecin">Nom médecin :</label>
						<input type="text" id="nom_medecin" name="nom_medecin" value="<?php echo $nom_medecin; ?>" readonly="readonly"><br>
						<br><br>

						<label for="nom_usager">Nom usager :</label>
						<input type="text" id="nom_usager" name="nom_usager" value="<?php echo $nom_usager; ?>" readonly="readonly"><br>
						<br><br>
						
						<label for="date_consult">Date :</label>
						<input type="date-time-local" id="date_consult" name="date_consult" value="<?php echo $consultation['date_consult']; ?>" readonly="readonly"><br>
                        <br><br>

						<label for="date_consult">Heure :</label>
						<input type="date-time-local" id="heure_consult" name="heure_consult" value="<?php echo $consultation['heure_consult']; ?>" readonly="readonly"><br>
                        <br><br>

                        <label for="duree">Durée :</label>
						<input type="text" id="duree" name="duree" value="<?php echo $consultation['duree']; ?>" required><br>

						<input type="submit" value="Enregistrer les modifications">
					</form>
				</div>
				
			<?php
			} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
				$duree = $_POST['duree'];
                $date_consult = $_POST["date_consult"];
				$heure_consult = $_POST["heure_consult"];
				$id_usager = $_GET['id_usager'];
				$id_medecin = $_GET['id_medecin'];
				$nom_medecin = $_POST['nom_medecin'];

				$req_id_medecin = "SELECT id_medecin FROM medecin WHERE nom = :nom_medecin";
				$etat = $bdd->prepare($req_id_medecin);
				$etat->bindParam(':nom_medecin', $nom_medecin, PDO::PARAM_STR);
				$etat->execute();
				$ids = $etat->fetch(PDO::FETCH_ASSOC);
				$id = $ids['id_medecin'];

                $sql = "UPDATE consultation SET duree = :duree WHERE id_usager = :id_usager and id_medecin = :id_medecin and date_consult = :date_consult AND heure_consult = :heure_consult";
                
				$stmt = $bdd->prepare($sql);
				$stmt->bindParam(':id_usager', $id_usager, PDO::PARAM_STR);
				$stmt->bindParam(':id_medecin', $id, PDO::PARAM_STR);
				$stmt->bindParam(':duree', $duree, PDO::PARAM_STR);
                $stmt->bindParam(':date_consult', $date_consult, PDO::PARAM_STR);
				$stmt->bindParam(':heure_consult', $heure_consult, PDO::PARAM_STR);
				$stmt->execute();
				$consultation = $stmt->fetch(PDO::FETCH_ASSOC);
				
				echo 'Consultation modifiée avec succès';
			} else {
				echo "Méthode non autorisée";
			}
		} catch (PDOException $e) {
			echo "Erreur : " . $e->getMessage();
		}
	?>
	<button onclick="window.location.href='affichageRDV.php'">Retour</button>
</body>