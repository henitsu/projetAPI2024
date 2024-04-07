<?php
include 'header.php';
require 'connexionBD.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Création d'un patient</title>
    <link rel="shortcut icon" href="../Donnees/patientele_icon.ico" />
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/creation.css">
</head>

<?php
    if (isset($_POST['submit'])) {

        $data = array(
            'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'civilite' => $_POST['civilite'],
            'sexe' => $_POST['sexe'], 'adresse' => $_POST['adresse'], 'ville' => $_POST['ville'], 'code_postal' => $_POST['code_postal'],
            'date_nais' => $_POST['date_nais'], 'lieu_nais' => $_POST['lieu_nais'], 'num_secu' => $_POST['num_secu'], 'id_medecin' => $_POST['id_medecin']
        );

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
        $baseUrl = 'https://api-patientele-cabmed.alwaysdata.net/cabmed/usagers/';

        // Exécution de la requête avec file_get_contents
        $result = file_get_contents($baseUrl, false, $context);

        // Gérer la réponse de l'API
        if ($result !== false) {
            // Conversion de la réponse en tableau associatif PHP
            $response = json_decode($result, true);

            if (isset($response["status_code"]) && $response["status_code"] == 200) {
                header('Location: affichagePatient.php');
                exit();
            } else {
                echo "Erreur lors de la création du patient";
            }
        } else {
            echo 'Erreur fetch';
        }
    }
    ?>

<body>
    <h1>Création d'un patient</h1>
    <form action="creationPatient.php" method="post">
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
            <label for="prenom">Sexe :</label>
            <input type="text" name="sexe" id="sexe" required>
        </p>
        <p>
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse" required>
        </p>
        <p>
            <label for="prenom">Ville :</label>
            <input type="text" name="ville" id="ville" required>
        </p>
        <p>
            <label for="prenom">Code postal :</label>
            <input type="text" name="code_postal" id="code_postal" required>
        </p>
        <p>
            <label for="date_nais">Date de naissance :</label>
            <input type="date" name="date_nais" id="date_nais" required>
        </p>
        <p>
            <label for="lieu_nais">Lieu de naissance :</label>
            <input type="text" name="lieu_nais" id="lieu_nais" required>
        </p>
        <p>
            <label for="num_secu">Numéro de sécurité sociale :</label>
            <input type="text" name="num_secu" id="num_secu" required>
        </p>
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
                foreach ($medecins as $medecin) {
                    echo '<option value="' . $medecin['id_medecin'] . '">' . $medecin['nom'] . ' ' . $medecin['prenom'] . '</option>';
                }
                ?>
            </select>
        </p>
        <p>
            <input type="submit" value="Créer le patient">
        </p>
    </form>
    <button onclick="window.location.href='affichagePatient.php'">Retour</button>

</body>

</html>