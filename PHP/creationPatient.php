<?php
    // Inclusion de la classe Patient et de la BD
    include 'header.php';
    require 'patient.php';
    require 'connexionBD.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        // Création d'un nouveau patient
        $patient = new Patient($_POST['civilite'], $_POST['nom'], $_POST['prenom'],
            $_POST['adresse'], $_POST['dateNaissance'], $_POST['lieuNaissance'],
            $_POST['numSecu'], $_POST['idMedecin']);
        $civilite = $patient->getCivilite();
        $nom = $patient->getNom();
        $prenom = $patient->getPrenom();
        $adresse = $patient->getAdresse();
        $dateNaissance = date('Y-m-d', strtotime($patient->getDateNaissance()));
        $lieuNaissance = $patient->getLieuNaissance();
        $numSecu = $patient->getNumSecu();
        $idMedecin = $patient->getIdMedecin();

        // Ajout du patient dans la BD
        try{
            $sql = "INSERT INTO usager
                (Civilite, Nom, Prenom, Adresse, DateNaissance, LieuNaissance, NumSecu, Id_Medecin)
                VALUES(:Civilite, :Nom, :Prenom, :Adresse, :DateNaissance, :LieuNaissance, :NumSecu, :Id_Medecin)";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':Civilite', $civilite, PDO::PARAM_STR);
            $stmt->bindParam(':Nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':Prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':Adresse', $adresse, PDO::PARAM_STR);
            $stmt->bindParam(':DateNaissance', $dateNaissance, PDO::PARAM_STR);
            $stmt->bindParam(':LieuNaissance', $lieuNaissance, PDO::PARAM_STR);
            $stmt->bindParam(':NumSecu', $numSecu, PDO::PARAM_STR);
            $stmt->bindParam(':Id_Medecin', $idMedecin, PDO::PARAM_INT);
            $stmt->execute();
            
            // Stocker le message dans la variable de session
            $_SESSION['message'] = 'Le patient a bien été créé !';

            // Redirection vers la page d'affichage des médecins
            header('Location: /PHP/affichagePatient.php');
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
        <link rel="shortcut icon" href="/Donnees/patientele_icon.ico" />
        <link rel="stylesheet" href="/CSS/base.css">
        <link rel="stylesheet" href="/CSS/creation.css">
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
                <label for="adresse">Adresse :</label>
                <input type="text" name="adresse" id="adresse" required>
            </p>
            <p>
                <label for="dateNaissance">Date de naissance :</label>
                <input type="date" name="dateNaissance" id="dateNaissance" required>
            </p>
            <p>
                <label for="lieuNaissance">Lieu de naissance :</label>
                <input type="text" name="lieuNaissance" id="lieuNaissance" required>
            </p>
            <p>
                <label for="numSecu">Numéro de sécurité sociale :</label>
                <input type="text" name="numSecu" id="numSecu" required>
            </p>
            <p>
                <label for="idMedecin">Médecin référant :</label>
                <select name="idMedecin" id="idMedecin">
                    <?php
                        // Récupération des médecins
                        $sql = "SELECT * FROM medecin";
                        $stmt = $bdd->prepare($sql);
                        $stmt->execute();
                        $medecins = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Affichage des médecins
                        foreach($medecins as $medecin){
                            echo '<option value="'.$medecin['Id_Medecin'].'">'.$medecin['Nom'].' '.$medecin['Prenom'].'</option>';
                        }
                    ?>
            </p>
            <p>
                <input type="submit" value="Créer le patient">
            </p>
        </form>
    <button onclick="window.location.href='/PHP/affichagePatient.php'">Retour</button>
    </body>
</html>