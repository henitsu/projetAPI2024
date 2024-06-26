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
    <?php
    include 'header.php';

    $baseUrl = 'https://api-patientele-cabmed.alwaysdata.net/cabmed/stats/';
    $resourceUsagers = '/usagers/index.php';
    // Récupérer les données JSON à partir de l'API
    // Décoder les données JSON
    $jsonData = json_decode(file_get_contents($baseUrl . $resourceUsagers), true);
    $data = $jsonData['data'];

    // Données des médecins
    $resourceMedecins = '/medecins/index.php';
    // Récupérer les données JSON à partir de l'API
    // Décoder les données JSON
    $jsonData = json_decode(file_get_contents($baseUrl . $resourceMedecins), true);
    $dataMedecins = $jsonData['data'];
    ?>
    <h1>Statistiques</h1>
    <div class='stats'>
        <table>
            <tr>
                <td class='creer'>
                    Tranche d'âge
                </td>
                <td class='creer'>
                    Nombre de femmes
                </td>
                <td class='creer'>
                    Nombre d'hommes
                </td>
            </tr>
            <tr>
                <td style='background-color: #D2DEEA'>
                    Moins de 25 ans
                </td>
                <td>
                    <?php
                    echo $data['NbFemmesMoins25Ans'][0]['NbFemmesMoins25ans'];
                    ?>
                </td>
                <td>
                    <?php
                    echo $data['NbHommesMoins25Ans'][0]['NbHommesMoins25ans'];
                    ?>
                </td>
            </tr>
            <tr>
                <td style='background-color: #D2DEEA'>
                    Entre 25 ans et 50 ans
                </td>
                <td>
                    <?php
                    echo $data['NbFemmesMilieu'][0]['NbFemmesMilieu'];
                    ?>
                </td>
                <td>
                    <?php
                    echo $data['NbHommesMilieu'][0]['NbHommesMilieu'];
                    ?>
                </td>
            </tr>
            <tr>
                <td style='background-color: #D2DEEA'>
                    Plus de 50 ans
                </td>
                <td>
                    <?php
                    echo $data['NbFemmesPlus50Ans'][0]['NbFemmesPlus50ans'];
                    ?>
                </td>
                <td>
                    <?php
                    echo $data['NbHommesPlus50Ans'][0]['NbHommesPlus50ans'];
                    ?>
                </td>
            </tr>
        </table>
    </div><br><br>

    <?php
    foreach ($dataMedecins as $medecin) {
        echo "<div class='stats'>Le médecin " . $medecin['NomMedecin'] . " a réalisé " . round($medecin['NbHeures'], 2) . " heures de consultation. <br> </div>";
    }
    ?>
</body>