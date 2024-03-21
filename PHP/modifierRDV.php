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
    require '../cabmed/connexionBD.php';

    // Vérifier si l'ID du rdv est passé en paramètre
    if(isset($_GET['id_consult'])) {
        // Récupérer l'ID du rdv depuis les paramètres d'URL
        $id_consult = $_GET["id_consult"];

        // Construire l'URL de la requête GET vers index.php avec l'ID du rdv
        $url = 'http://localhost/API/projetAPI2024/cabmed/consultations/index.php?id=' . $id_consult;

        // Effectuer la requête GET
        $result = file_get_contents($url);

        // Vérifier si la requête a réussi
        if($result !== false) {
            // Convertir la réponse JSON en tableau associatif
            $rdv = json_decode($result, true);

            // Vérifier si des données de rdv ont été récupérées
            if(isset($rdv['data'][0])) {
                // Récupérer les informations du rdv depuis le tableau associatif
                $date_consult = $rdv['data'][0]['date_consult'];
                $heure_consult = $rdv['data'][0]['heure_consult'];
                $duree_consult = $rdv['data'][0]['duree_consult'];
                $id_usager = $rdv['data'][0]['id_usager'];
                $id_medecin = $rdv['data'][0]['id_medecin'];
            } else {
                // Aucune donnée de rdv trouvée pour l'ID spécifié
                echo "Aucune information trouvée pour le RDV avec l'ID : " . $id_consult;
            }
        } else {
            // Erreur lors de la récupération des données de la consultation
            echo "Erreur lors de la récupération des informations de la consultation.";
        }
    } else {
        // L'ID de la consultation n'est pas spécifié dans les paramètres d'URL
        echo "ID de la consultation non spécifié.";
    }
    
    ?>

	<h1>Modification d'une consultation du docteur <?php echo $nom_medecin; ?></h1>

	<div class="form">
		<form action="modifierRDV.php" method="post">
			<label for="nom_rdv">Nom médecin :</label>
			<input type="text" id="nom_rdv" name="nom_rdv" value="<?php echo $id_medecin; ?>" readonly="readonly"><br>
			<br><br>

			<label for="nom_usager">Nom usager :</label>
			<input type="text" id="nom_usager" name="nom_usager" value="<?php echo $id_usager; ?>" readonly="readonly"><br>
			<br><br>
			
			<label for="date_consult">Date :</label>
			<input type="date" id="date_consult" name="date_consult" value="<?php echo $date_consult; ?>" readonly="readonly"><br>
			<br><br>

			<label for="date_consult">Heure :</label>
			<input type="time" id="heure_consult" name="heure_consult" value="<?php echo $heure_consult; ?>" readonly="readonly"><br>
			<br><br>

			<label for="duree_consult">Durée :</label>
			<input type="text" id="duree_consult" name="duree_consult" value="<?php echo $duree_consult; ?>" required><br>

			<input type="submit" name="submit" value="Enregistrer les modifications">
		</form>
	</div>

	<?php 
        if (isset($_POST['submit'])){
            $data = array('id_consult' => $_POST['id_consult'], 'id_usager' => $_POST['id_usager'], 'nom_rdv' => $_POST['nom_rdv'], 'nom_usager' => $_POST['nom_usager'], 
			'date_consult' => $_POST['date_consult'], 'heure_consult' => $_POST['heure_consult'], 'duree_consult' => $_POST['duree_consult']);

            $options = array(
                'http' => array(
                    'method' => 'PATCH',
                    'header' => "Content-Type: application/json\r\n",
                    'content' => json_encode($data)
                )
            );

            $context = stream_context_create($options);

            // URL de l'API pour les rdvs
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