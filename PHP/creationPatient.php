<?php
    // Inclusion de la classe Patient et de la BD
    include 'header.php';
    require 'patient.php';
    require 'connexionBD.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        // Création d'un nouveau patient
        $patient = new Patient($_POST['civilite'], $_POST['nom'], $_POST['prenom'],
            $_POST['adresse'], $_POST['ville'], $_POST['code_postal'], 
            $_POST['date_nais'], $_POST['lieu_nais'], $_POST['sexe'],
            $_POST['num_secu']);
        $civilite = $patient->getcivilite();
        $nom = $patient->getnom();
        $prenom = $patient->getprenom();
        $adresse = $patient->getAdresse();
        $code_postal = $patient->getCodePostal();
        $ville = $patient->getVille();
        $date_nais = date('Y-m-d', strtotime($patient->getDateNaissance()));
        $lieu_nais = $patient->getLieuNaissance();
        $num_secu = $patient->getNumSecu();
        $sexe = $patient->getSexe();

        // Ajout du patient dans la BD
        try{
            $sql = "INSERT INTO usager
                (civilite, nom, prenom, adresse, ville, code_postal, date_nais, lieu_nais, num_secu, sexe)
                VALUES(:civilite, :nom, :prenom, :adresse, :ville, :code_postal, :date_nais, :lieu_nais, :num_secu, :sexe)";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':civilite', $civilite, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $stmt->bindParam(':ville', $ville, PDO::PARAM_STR);
            $stmt->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
            $stmt->bindParam(':date_nais', $date_nais, PDO::PARAM_STR);
            $stmt->bindParam(':lieu_nais', $lieu_nais, PDO::PARAM_STR);
            $stmt->bindParam(':num_secu', $num_secu, PDO::PARAM_STR);
            $stmt->bindParam(':sexe', $sexe, PDO::PARAM_INT);
            $stmt->execute();
            
            // Stocker le message dans la variable de session
            $_SESSION['message'] = 'Le patient a bien été créé !';

            // Redirection vers la page d'affichage des médecins
            header('Location: affichagePatient.php');
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