<?php
    // Inclusion de la classe Medecin et de la BD
    include 'header.php';
    require 'medecin.php';
    require 'connexionBD.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Création d'un nouveau medecin
        $medecin = new Medecin($_POST['civilite'], $_POST['nom'], $_POST['prenom']);
        $civilite = $medecin->getCivilite();
        $nom = $medecin->getNom();
        $prenom = $medecin->getPrenom();

        // Ajout du patient dans la BD
        try{
            $sql = "INSERT INTO medecin (Civilite, Nom, Prenom) VALUES (:Civilite, :Nom, :Prenom)";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':Civilite', $civilite, PDO::PARAM_STR);
            $stmt->bindParam(':Nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':Prenom', $prenom, PDO::PARAM_STR);
            $stmt->execute();

            // Stocker le message dans la variable de session
            $_SESSION['message'] = 'Le médecin a bien été créé !';

            // Redirection vers la page d'affichage des médecins
            header('Location: /PHP/affichageMedecin.php');
            exit();

        } catch(Exception $e){
            echo 'Erreur : '.$e->getMessage();
        }  
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Création d'un médecin</title>
        <link rel="shortcut icon" href="/Donnees/patientele_icon.ico" />
        <link rel="stylesheet" href="/CSS/base.css">
        <link rel="stylesheet" href="/CSS/creation.css">
    </head>
    <body>
        <h1>Création d'un médecin</h1>
        <form action="creationMedecin.php" method="post">
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
        <button onclick="window.location.href='/PHP/affichageMedecin.php'">Retour</button>
    </body>
    
</html>