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
    <h1>Affichage des médecins</h1>
    <div class="creer">
        Ajouter un nouveau médecin : <strong><a href="creationMedecin.php">Ajouter</a></strong>
    </div>
    <div id="medecinsList">
        <?php
        // URL de l'API pour les médecins
        $baseUrl = 'https://api-patientele-cabmed.alwaysdata.net/cabmed/medecins/';

        $result = file_get_contents($baseUrl);

        $response = json_decode($result, true);

        if ($response !== null && isset($response['data'])) {
            // Récupération des données des médecins
            $medecins = $response['data'];

            // Affichage des données
            if (isset($response)) {
                echo '<table border="1">';
                echo '<tr><th>Civilité</th><th>Nom</th><th>Prénom</th><th>Action</th></tr>';
                foreach ($response['data'] as $medecin) {
                    echo '<tr>';
                    echo '<td>' . $medecin['civilite'] . '</td>';
                    echo '<td>' . $medecin['nom'] . '</td>';
                    echo '<td>' . $medecin['prenom'] . '</td>';
                    echo '<td>';
                    echo '<a href="modifierMedecin.php?id_medecin=' . $medecin['id_medecin'] . '">Modifier</a> | ';
                    echo '<a href="javascript:void(0);" onclick="confirmDelete(\'' . $medecin['id_medecin'] . '\', \'' . $baseUrl . 'medecin\', \'medecin\')">Supprimer</a>';

                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo "Aucune donnée de médecin disponible.";
            }
        } else {
            echo 'Erreur Fetch';
        }
        ?>

        <script src="../JS/suppression.js"></script>

    </div>
</body>

</html>