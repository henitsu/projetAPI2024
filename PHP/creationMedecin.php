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
        <form action="/cabmed/medecins/creationMedecin.php" method="post">
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
                <input type="submit" value="Créer le médecin">
            </p>
        </form>
        <button onclick="window.location.href='affichageMedecin.php'">Retour</button>
    </body>
    
</html>