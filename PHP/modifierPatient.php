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
	<?php 
	include 'header.php';
	require '../cabmed/connexionBD.php';

    // Vérifier si l'ID de l'usager est passé en paramètre
    if(isset($_GET['id_usager'])) {
        // Récupérer l'ID de l'usager depuis les paramètres d'URL
        $id_usager = $_GET["id_usager"];

        // Construire l'URL de la requête GET vers index.php avec l'ID du usager
        $url = 'http://localhost/API/projetAPI2024/cabmed/usagers/index.php?id=' . $id_usager;

        // Effectuer la requête GET
        $result = file_get_contents($url);

        // Vérifier si la requête a réussi
        if($result !== false) {
            // Convertir la réponse JSON en tableau associatif
            $usager = json_decode($result, true);

            // Vérifier si des données de usager ont été récupérées
            if(isset($usager['data'][0])) {
                // Récupérer les informations du usager depuis le tableau associatif
                $nom = $usager['data'][0]['nom'];
                $prenom = $usager['data'][0]['prenom'];
				$adresse = $usager['data'][0]['adresse'];
				$ville = $usager['data'][0]['ville'];
				$code_postal = $usager['data'][0]['code_postal'];
				$date_nais = $usager['data'][0]['date_nais'];
				$lieu_nais = $usager['data'][0]['lieu_nais'];
				$num_secu = $usager['data'][0]['num_secu'];
				$sexe = $usager['data'][0]['sexe'];
				$id_medecin = $usager['data'][0]['id_medecin'];
                $civilite = $usager['data'][0]['civilite'];
            } else {
                // Aucune donnée de usager trouvée pour l'ID spécifié
                echo "Aucune information trouvée pour le usager avec l'ID : " . $id_usager;
            }
        } else {
            // Erreur lors de la récupération des données du usager
            echo "Erreur lors de la récupération des informations du usager.";
        }
    } else {
        // L'ID du usager n'est pas spécifié dans les paramètres d'URL
        echo "ID du usager non spécifié.";
    }
    
?>
	<h1>Modification des informations de <?php echo $prenom ." ". $nom; ?></h1>
	<div class="form">
		<form action="modifierPatient.php" method="post">
			<label for="Nom">Nom :</label>
			<input type="text" id="nom" name="Nom" value="<?php echo $nom; ?>" required><br>

			<label for="Prenom">Prénom :</label>
			<input type="text" id="prenom" name="Prenom" value="<?php echo $prenom; ?>" required><br>

			<label for="Adresse">Adresse :</label>
			<input type="text" id="adresse" name="Adresse" value="<?php echo $adresse; ?>" required><br>
			
			<label for="ville">Ville :</label>
			<input type="text" id="ville" name="ville" value="<?php echo $ville; ?>" required><br>
			
			<label for="code_postal">Code postal :</label>
			<input type="text" id="code_postal" name="code_postal" value="<?php echo $code_postal; ?>" required><br>

			<label for="date_nais">Date naissance :</label>
			<input type="date" id="date_nais" name="date_nais" value="<?php echo $date_nais; ?>" required><br>

			<label for="lieu_nais">Lieu naissance :</label>
			<input type="text" id="lieu_nais" name="lieu_nais" value="<?php echo $lieu_nais; ?>" required><br>

			<label for="num_secu">Numéro de sécurité sociale :</label>
			<input type="text" id="num_secu" name="num_secu" value="<?php echo $num_secu; ?>" required><br>
			
			<label for="sexe">Sexe :</label>
			<input type="text" id="sexe" name="sexe" value="<?php echo $sexe; ?>" required><br>

			<p>
                <label for="id_medecin">Médecin :</label>
                <select name="id_medecin" id="id_medecin">
                    <?php
                        // Récupération des médecins
                        $sql = "SELECT * FROM medecin";
                        $stmt = $linkpdo->prepare($sql);
                        $stmt->execute();
                        $medecins = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Affichage des médecins
                        foreach($medecins as $medecin){
                            echo '<option value="'.$medecin['id_medecin'].'">'.$medecin['nom'].' '.$medecin['prenom'].'</option>';
                        }
                    ?>
                </select>
            </p>

			<input type="submit" name = "submit" value="Modifier l'usager">
		</form>
	</div>
	<button onclick="window.location.href='affichagePatient.php'">Retour</button>
	
	<?php 
        if (isset($_POST['submit'])){
            $data = array('id_medecin' => $_POST['id_medecin'],'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'civilite' => $_POST['civilite'], 
			'adresse' => $_POST['adresse'], 'ville' => $_POST['ville'], 'code_postal' => $_POST['code_postal'], 'date_nais' => $_POST['date_nais'],
			'lieu_nais' => $_POST['lieu_nais'], 'num_secu' => $_POST['num_secu'], 'sexe' => $_POST['sexe']);

            $options = array(
                'http' => array(
                    'method' => 'PATCH',
                    'header' => "Content-Type: application/json\r\n",
                    'content' => json_encode($data)
                )
            );

            $context = stream_context_create($options);

            // URL de l'API pour les médecins
            $baseUrl = 'http://localhost/API/projetAPI2024/cabmed/usagers/';
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
</body>