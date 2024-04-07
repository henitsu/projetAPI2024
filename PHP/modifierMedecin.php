<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Modification médecin</title>
    <link rel="shortcut icon" href="../Donnees/patientele_icon.ico" />
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/modifier.css">
</head>

<body>

    <?php
    include 'header.php';
    require 'connexionBD.php';

    // Vérifier si l'ID du médecin est passé en paramètre
    if (isset($_GET['id_medecin'])) {
        // Récupérer l'ID du médecin depuis les paramètres d'URL
        $id_medecin = $_GET["id_medecin"];

        // Construire l'URL de la requête GET vers index.php avec l'ID du médecin
        $url = 'https://api-patientele-cabmed.alwaysdata.net/cabmed/medecins/' . $id_medecin;

        // Effectuer la requête GET
        $result = file_get_contents($url);

        // Vérifier si la requête a réussi
        if ($result !== false) {
            // Convertir la réponse JSON en tableau associatif
            $medecin = json_decode($result, true);

            // Vérifier si des données de médecin ont été récupérées
            if (isset($medecin['data'][0])) {
                // Récupérer les informations du médecin depuis le tableau associatif
                $nom = $medecin['data'][0]['nom'];
                $prenom = $medecin['data'][0]['prenom'];
                $civilite = $medecin['data'][0]['civilite'];
            } else {
                // Aucune donnée de médecin trouvée pour l'ID spécifié
                echo "Aucune information trouvée pour le médecin avec l'ID : " . $id_medecin;
            }
        } else {
            // Erreur lors de la récupération des données du médecin
            echo "Erreur lors de la récupération des informations du médecin.";
        }
    } else {
        // L'ID du médecin n'est pas spécifié dans les paramètres d'URL
        echo "ID du médecin non spécifié.";
    }

    if (isset($_POST['submit'])) {
        $data = array('id_medecin' => $_POST['id_medecin'], 'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'civilite' => $_POST['civilite']);

        $options = array(
            'http' => array(
                'method' => 'PATCH',
                'header' => "Content-Type: application/json\r\n",
                'content' => json_encode($data)
            )
        );

        $context = stream_context_create($options);

        // URL de l'API pour les médecins
        $baseUrl = 'https://api-patientele-cabmed.alwaysdata.net/cabmed/medecins/' . $id_medecin;

        // Exécution de la requête avec file_get_contents
        $result = file_get_contents($baseUrl, false, $context);

        // Gérer la réponse de l'API
        if ($result !== false) {
            // Conversion de la réponse en tableau associatif PHP
            $response = json_decode($result, true);
            echo $response['status_message'];
            $nom = $response['data']['nom'];
            $prenom = $response['data']['prenom'];
            $civilite = $response['data']['civilite'];
        } else {
            echo 'Erreur fetch';
        }
    }
    ?>
    <h1>Modification des informations de <?php echo $prenom . " " . $nom; ?></h1>
    <div class="form">
        <form action="modifierMedecin.php?id_medecin=<?php echo $id_medecin; ?>" method="post">
            <input type="hidden" name="id_medecin" value="<?php echo $_GET['id_medecin']; ?>">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>" required><br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>" required><br>

            <label for="civilite">Civilité :</label>
            <input type="text" id="civilite" name="civilite" value="<?php echo $civilite; ?>" required><br>

            <input type="submit" name="submit" value="Enregistrer les modifications">
        </form>
    </div>
    <button onclick="window.location.href='affichageMedecin.php'">Retour</button>

</body>

</html>