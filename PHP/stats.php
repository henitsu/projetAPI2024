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

        require 'connexionBD.php';

        $reponseNbFemmesMoins25Ans = $bdd->query("SELECT COUNT(*) NbFemmes FROM usager WHERE DATEDIFF(DATE_FORMAT(DATE(NOW()), '%Y-%m-%d'), date_nais) < 9125 AND sexe='F'");
        $nbFemmesMoins25Ans = $reponseNbFemmesMoins25Ans->fetchAll(); 

        $reponseFemmesMilieu = $bdd->query("SELECT COUNT(*) NbFemmes FROM usager WHERE sexe='F' AND DATEDIFF(DATE_FORMAT(DATE(NOW()), '%Y-%m-%d'), date_nais) BETWEEN 9125 AND 14600");
        $nbFemmesMilieu = $reponseFemmesMilieu->fetchAll();

        $reponseFemmesPlus50 = $bdd->query("SELECT COUNT(*) NbFemmes FROM usager WHERE sexe='F' AND DATEDIFF(DATE_FORMAT(DATE(NOW()), '%Y-%m-%d'), date_nais) > 14600");
        $nbFemmesPlus50Ans = $reponseFemmesPlus50->fetchAll();


        $reponseNbHommesMoins25Ans = $bdd->query("SELECT COUNT(*) NbHommes FROM usager WHERE sexe='H' AND DATEDIFF(DATE_FORMAT(DATE(NOW()), '%Y-%m-%d'), date_nais) < 9125");
        $nbHommesMoins25Ans = $reponseNbHommesMoins25Ans->fetchAll();    

        $reponseHommesMilieu = $bdd->query("SELECT COUNT(*) NbHommes FROM usager WHERE sexe='H' AND DATEDIFF(DATE_FORMAT(DATE(NOW()), '%Y-%m-%d'), date_nais) BETWEEN 9125 AND 14600");
        $nbHommesMilieu = $reponseHommesMilieu->fetchAll();

        $reponseHommesPlus50 = $bdd->query("SELECT COUNT(*) NbHommes FROM usager WHERE sexe='H' AND DATEDIFF(DATE_FORMAT(DATE(NOW()), '%Y-%m-%d'), date_nais) > 14600");
        $nbHommesPlus50Ans = $reponseHommesPlus50->fetchAll();
        
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