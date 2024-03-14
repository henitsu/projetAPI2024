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
        require './cabmed/connexionBD.php';
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
                    <?php echo getNbFemmesMoins25Ans($linkpdo)[0]['NbFemmes']; ?>
                </td>
                <td>
                    <?php echo getNbHommesMoins25Ans($linkpdo)[0]['NbHommes']; ?>
                </td>
            </tr>
            <tr>
                <td style='background-color: #D2DEEA'>
                    Entre 25 ans et 50 ans
                </td>
                <td>
                    <?php echo getNbFemmesMilieu($linkpdo)[0]['NbFemmes']; ?>
                </td>
                <td>
                    <?php echo getNbHommesMilieu($linkpdo)[0]['NbHommes']; ?>
                </td>
            </tr>
            <tr>
                <td style='background-color: #D2DEEA'>
                    Plus de 50 ans
                </td>
                <td>
                    <?php echo getNbFemmesPlus50Ans($linkpdo)[0]['NbFemmes']; ?>
                </td>
                <td>
                    <?php echo getNbHommesPlus50Ans($linkpdo)[0]['NbHommes']; ?>
                </td>
            </tr>
        </table></div><br><br>

        <?php
            $NbHeuresConsultation = getNbHeuresConsultations($linkpdo)[0];
            foreach($NbHeuresConsultation as $NbHeures){
                echo "<div class='stats'>Le médecin " . $NbHeures[1] . " a réalisé " . round($NbHeures[0],2) . " heures de consultation <br> </div>";
            }
        ?>
</body>