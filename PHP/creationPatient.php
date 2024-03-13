<?php
    include 'header.php';
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
                <input type="submit" value="Créer le patient">
            </p>
        </form>
    <button onclick="window.location.href='affichagePatient.php'">Retour</button>
    </body>
</html>