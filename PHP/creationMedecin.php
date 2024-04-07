<?php
include 'header.php';
require 'connexionBD.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Création d'un médecin</title>
    <link rel="shortcut icon" href="../Donnees/patientele_icon.ico" />
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/creation.css">
</head>

<?php
    if (isset($_POST['submit'])) {

        $data = array('nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'civilite' => $_POST['civilite']);

        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n",
                'content' => json_encode($data)
            )
        );

        // Création du contexte de flux
        $context = stream_context_create($options);

        // URL de l'API pour les médecins
        $baseUrl = 'https://api-patientele-cabmed.alwaysdata.net/cabmed/medecins/';

        // Exécution de la requête avec file_get_contents
        $result = file_get_contents($baseUrl, false, $context);

        // Gérer la réponse de l'API
        if ($result !== false) {
            // Conversion de la réponse en tableau associatif PHP
            $response = json_decode($result, true);

            if (isset($response["status_code"]) && $response["status_code"] == 201) {
                header('Location: affichageMedecin.php');
                exit();
            } else {
                echo "Erreur lors de la création du médecin";
            }
        } else {
            echo 'Erreur Fetch';
        }
    }
    ?>

<body>
    <h1>Création d'un médecin</h1>

    <form action="creationMedecin.php" method="post">
        <p>
            <label for="civilite">Civilité :</label>
            <select name="civilite" id="civilite" required>
                <option value="M">M</option>
                <option value="Mme">Mme</option>
                <option value="Mlle">Mlle</option>
            </select>
        </p>
        <p>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
        </p>
        <p>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required>
        </p>
        <p>
            <input type="submit" name='submit' value="Créer le médecin">
        </p>
    </form>
    <button onclick="window.location.href='affichageMedecin.php'">Retour</button>
</body>

</html>