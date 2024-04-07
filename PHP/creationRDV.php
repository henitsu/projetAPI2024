<?php
// Inclusion de la BD
include 'header.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Création d'une consultation</title>
    <link rel="shortcut icon" href="../Donnees/patientele_icon.ico" />
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/creation.css">
</head>

<?php
    if (isset($_POST['submit'])) {

        $data = array(
            'id_medecin' => $_POST['id_medecin'], 'id_usager' => $_POST['id_usager'],
            'date_consult' => $_POST['date_consult'], 'heure_consult' => $_POST['heure_consult'], 'duree_consult' => $_POST['duree_consult']
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
        $baseUrl = 'https://api-patientele-cabmed.alwaysdata.net/cabmed/consultations/';

        // Exécution de la requête avec file_get_contents
        $result = file_get_contents($baseUrl, false, $context);

        // Gérer la réponse de l'API
        if ($result !== false) {
            // Conversion de la réponse en tableau associatif PHP
            $response = json_decode($result, true);

            if (isset($response["status_code"]) && $response["status_code"] == 201) {
                header('Location: affichageRDV.php');
                exit();
            } else {
                echo "Erreur lors de la création de la consultation";
            }
        } else {
            echo 'Erreur fetch';
        }
    }
    ?>

<body>
    <h1>Création d'une consultation</h1>
    <form method="POST" action="creationRDV.php">
        <p>
            <label for="id_usager">Patient:</label>
            <select name="id_usager" id="id_usager">
                <?php
                // Récupération des patients
                $sql = "SELECT * FROM usager";
                $stmt = $linkpdo->prepare($sql);
                $stmt->execute();
                $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Affichage des médecins
                foreach ($patients as $patient) {
                    echo '<option value="' . $patient['id_usager'] . '">' . $patient['nom'] . ' ' . $patient['prenom'] . '</option>';
                }
                ?>
            </select>
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
            <label for="date_consult">Date :</label>
            <input type="date" name="date_consult" id="date_consult">
        </p>
        <p>
            <label for="heure_consult">Heure :</label>
            <input type="time" name="heure_consult" id="heure_consult">
        </p>
        <p>
            <label for="duree_consult">Durée:</label>
            <input type="number" name="duree_consult" id="duree_consult" value="30">
        </p>
        <p>
            <input type="submit" name="submit" value="Créer le rendez-vous">
        </p>
    </form>
    <button onclick="window.location.href='affichageRDV.php'">Retour</button>
</body>

</html>