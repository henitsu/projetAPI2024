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
    <h1>Statistiques</h1>
    <?php

        require './cabmed/connexionBD.php';        
        echo 
        "
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
                    ". $nbFemmesMoins25Ans[0]['NbFemmes'] . "
                </td>
                <td>
                    ". $nbHommesMoins25Ans[0]['NbHommes'] . "
                </td>
            </tr>
            <tr>
                <td style='background-color: #D2DEEA'>
                    Entre 25 ans et 50 ans
                </td>
                <td>
                    ". $nbFemmesMilieu[0]['NbFemmes'] . "
                </td>
                <td>
                    ". $nbHommesMilieu[0]['NbHommes'] . "
                </td>
            </tr>
            <tr>
                <td style='background-color: #D2DEEA'>
                    Plus de 50 ans
                </td>
                <td>
                    ". $nbFemmesPlus50Ans[0]['NbFemmes'] . "
                </td>
                <td>
                    ". $nbHommesPlus50Ans[0]['NbHommes'] . "
                </td>
            </tr>
        </table></div><br><br>";

        $reponseNbHeuresParMedecin = $bdd->query("SELECT SUM(duree_consult)/60, medecin.nom FROM consultation, medecin WHERE medecin.id_medecin = consultation.id_medecin GROUP BY medecin.id_medecin");
        $NbHeuresConsultation = $reponseNbHeuresParMedecin->fetchAll();
        foreach($NbHeuresConsultation as $NbHeures){
            echo "<div class='stats'>Le médecin " . $NbHeures[1] . " a réalisé " . round($NbHeures[0],2) . " heures de consultation <br> </div>";
        }

    ?>
</body>