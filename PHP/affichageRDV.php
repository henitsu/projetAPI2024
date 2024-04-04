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
    <h1>Affichage des consultations</h1>
    <div class="creer">
        Ajouter une nouvelle consultation : <strong><a href="creationRDV.php">Ajouter</a></strong>
    </div>
    <?php

    // URL de l'API pour les consultations
    $baseUrl = 'https://api-cabmed.alwaysdata.net/cabmed/consultations/';
    $resource = 'index.php';

    $result = file_get_contents($baseUrl . $resource);

    $response = json_decode($result, true);

    if ($response !== null && isset($response['data'])) {
        // Récupération des données des médecins
        $medecins = $response['data'];

        // Affichage des données
        if (isset($response)) {
            echo '<table border="1">';
            echo '<tr><th>Nom médecin</th><th>Nom patient</th><th>Date</th><th>Heure</th><th>Durée (en minutes)</th><th>Action</th></tr>';

            foreach ($response['data'] as $donnee) {
                // Affiche les résultats
                echo '<tr>';
                echo '<td>' . $donnee['nom_medecin'] . '</td>';
                echo '<td>' . $donnee['nom_usager'] . '</td>';
                echo '<td>' . date('d/m/Y', strtotime($donnee['date_consult'])) . '</td>';
                echo '<td>' . date('H:i', strtotime($donnee['heure_consult'])) . '</td>';
                echo '<td>' . $donnee['duree_consult'] . '</td>';
                echo '<td><a href="modifierRDV.php?id_usager=' . $donnee['id_usager'] . '&id_medecin=' . $donnee['id_medecin'] . '&date_consult=' . $donnee['date_consult'] . '&heure_consult=' . $donnee['heure_consult']
                    . '&duree_consult=' . $donnee['duree_consult'] . '">Modifier</a> | 
                    <a href="javascript:void(0);" onclick="confirmDelete(\'' . $donnee['id_consult'] . '\', \'' . $baseUrl . '\', \'rendez-vous\')">Supprimer</a>';
                echo '</tr>';
            }
        } else {
            echo "Aucune donnée de consultation disponible.";
        }
    }

    ?>
    <script src="../JS/suppression.js"></script>
</body>