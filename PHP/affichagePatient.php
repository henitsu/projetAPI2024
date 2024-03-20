<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Gestion d'un cabinet médical</title>
    <link rel="shortcut icon" href="../Donnees/patientele_icon.ico" />
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/affichage.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Affichage des patients</h1>
    <div class="creer">
        Ajouter un nouveau patient : <strong><a href="creationPatient.php">Ajouter</a></strong>
    </div>
    <?php
    // Connexion à l'API pour récupérer les données des patients
    $url = 'http://localhost/API/projetAPI2024/cabmed/usagers/index.php';
    $response = file_get_contents($url);
    $patients = json_decode($response, true);

    if ($patients !== null && !empty($patients)) {
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Civilité</th><th>Adresse</th><th>Ville</th><th>Code postal</th>
        <th>Sexe</th><th>Date naissance</th><th>Lieu naissance</th><th>Numéro sécurité sociale</th><th>Action</th></tr>';

        foreach ($patients as $patient) {
            echo '<tr>';
            echo '<td>' . $patient['id_usager'] . '</td>';
            echo '<td>' . $patient['nom'] . '</td>';
            echo '<td>' . $patient['prenom'] . '</td>';
            echo '<td>' . $patient['civilite'] . '</td>';
            echo '<td>' . $patient['adresse'] . '</td>';
            echo '<td>' . $patient['ville'] . '</td>';
            echo '<td>' . $patient['code_postal'] . '</td>';
            echo '<td>' . $patient['sexe'] . '</td>';
            echo '<td>' . date('d/m/Y', strtotime($patient['date_nais'])) . '</td>';
            echo '<td>' . $patient['lieu_nais'] . '</td>';
            echo '<td>' . $patient['num_secu'] . '</td>';
            echo '<td><a href="modifierPatient.php?id_usager=' . $patient['id_usager'] . '&nom=' . $patient['nom'] . '&prenom=' . $patient['prenom'] 
            . '&adresse=' . $patient['adresse'] . '&ville='. $patient['ville'] . '&code_postal=' . $patient['code_postal'] . '&sexe=' . $patient["sexe"]
            . '&date_nais=' . $patient['date_nais'] . '&lieu_nais=' . $patient['lieu_nais'] 
            . '&num_secu=' . $patient['num_secu'] . '">Modifier</a> | 
            <a href="javascript:void(0);" onclick="confirmDelete(' . $patient['id'] . ', ' . $baseUrl .', "patient")">Supprimer</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "<p>Aucun patient trouvé.</p>";
    }
    ?>
    <script src="../JS/suppression.js"></script>
</body>
</html>
