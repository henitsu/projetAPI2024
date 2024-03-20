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
	<?php include 'header.php';?>

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
			<input type="date" id="date_consult" name="date_consult" value="<?php echo $consultation['date_consult']; ?>" readonly="readonly"><br>
			<br><br>

			<label for="date_consult">Heure :</label>
			<input type="time" id="heure_consult" name="heure_consult" value="<?php echo $consultation['heure_consult']; ?>" readonly="readonly"><br>
			<br><br>

			<label for="duree_consult">Durée :</label>
			<input type="text" id="duree_consult" name="duree_consult" value="<?php echo $consultation['duree_consult']; ?>" required><br>

			<input type="submit" name="submit" value="Enregistrer les modifications">
		</form>
	</div>

	<?php 
        if (isset($_POST['submit'])){
            $data = array('id_medecin' => $_POST['id_medecin'], 'id_usager' => $_POST['id_usager'], 'nom_medecin' => $_POST['nom_medecin'], 'nom_usager' => $_POST['nom_usager'], 
			'date_consult' => $_POST['date_consult'], 'heure_consult' => $_POST['heure_consult'], 'duree_consult' => $_POST['duree_consult']);

            $options = array(
                'http' => array(
                    'method' => 'PATCH',
                    'header' => "Content-Type: application/json\r\n",
                    'content' => json_encode($data)
                )
            );

            $context = stream_context_create($options);

            // URL de l'API pour les médecins
            $baseUrl = 'http://localhost/API/projetAPI2024/cabmed/consultations/';
            $resource = 'index.php';

            // Exécution de la requête avec file_get_contents
            $result = file_get_contents($baseUrl . $resource, false, $context);

            // Gérer la réponse de l'API
            if ($result !== false) {
                // Conversion de la réponse en tableau associatif PHP
                $response = json_decode($result, true);
                // Affichage de la réponse
                print_r($response);
            } else {
                echo 'Erreur fetch';
            }
        }
    ?>

	<button onclick="window.location.href='affichageRDV.php'">Retour</button>

</body>