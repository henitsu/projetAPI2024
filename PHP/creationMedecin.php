<?php
    include 'header.php';
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

        <?php           
            if (isset($_POST['submit'])){

                $url = 'http://localhost/API/projetAPI2024/cabmed/medecins/index.php';
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
                $baseUrl = 'http://localhost/API/projetAPI2024/cabmed/medecins/';
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
                    echo 'Erreur Fetch';
                }
            }
        ?>
    </body>
    
</html>