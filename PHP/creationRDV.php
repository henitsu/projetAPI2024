<?php
    // Inclusion de la classe Patient et de la BD
    include 'header.php';
    require 'rdv.php';
    require 'connexionBD.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        // Création d'un nouveau rdv
        $rdv = new rdv($_POST['patient'], $_POST['medecin'], $_POST['dateHeure'], $_POST['duree']);
        $idPatient = $rdv->getIdPatient();
        $idMedecin = $rdv->getIdMedecin();
        $dateHeure = $rdv->getDateHeure();
        $duree = $rdv->getDuree();

        // Ajout du rdv dans la BD
        try{

            $sql_trigger_rdv = "
                CREATE OR REPLACE TRIGGER rdv_avant_insert BEFORE INSERT ON rdv
                FOR EACH ROW
                BEGIN
                    IF (SELECT COUNT(*) FROM rdv WHERE Id_Medecin = NEW.Id_Medecin AND DateHeureRDV = NEW.DateHeureRDV AND Id_Medecin = NEW.Id_Medecin) > 0 THEN
                        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Ce médecin a déjà un rendez-vous à cette date et heure';
                    END IF;
                    IF (SELECT COUNT(*) FROM rdv WHERE Id_Medecin = NEW.Id_Medecin AND DateHeureRDV + INTERVAL DureeConsultationMinutes MINUTE < NEW.DateHeureRDV + NEW.DureeConsultationMinutes 
                    AND NEW.DateHeureRDV + INTERVAL New.DureeConsultationMinutes MINUTE > DateHeureRDV AND idusager != NEW.idusager) > 0 THEN
                        SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = 'Ce médecin sera encore en consultation à cette date et heure.';
                    END IF;                    
                END;";
            
            $bdd->exec($sql_trigger_rdv);

            $sql = "INSERT INTO rdv (idusager, Id_Medecin, DateHeureRDV, DureeConsultationMinutes)
            VALUES(:idusager, :Id_Medecin, :DateHeureRDV, :DureeConsultationMinutes)";

            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':idusager', $idPatient, PDO::PARAM_INT);
            $stmt->bindParam(':Id_Medecin', $idMedecin, PDO::PARAM_INT);
            $stmt->bindParam(':DateHeureRDV', $dateHeure, PDO::PARAM_STR);
            $stmt->bindParam(':DureeConsultationMinutes', $duree, PDO::PARAM_INT);
            $stmt->execute();

            // Stocker le message dans la variable de session
            $_SESSION['message'] = 'Le rendez-vous a bien été créé !';

            // Redirection vers la page d'affichage des médecins
            header('Location: /PHP/affichageRDV.php');
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
    <title>Création d'une consultation</title>
    <link rel="shortcut icon" href="/Donnees/patientele_icon.ico" />
    <link rel="stylesheet" href="/CSS/base.css">
    <link rel="stylesheet" href="/CSS/creation.css">
</head>
<body>
    <h1>Création d'une consultation</h1>
        <form method="POST" action="creationRDV.php">
            <p>
                <label for="patient">Patient:</label>
                <select name="patient" id="patient">
                    <?php
                        // Récupération des patients
                        $sql = "SELECT * FROM usager";
                        $stmt = $bdd->prepare($sql);
                        $stmt->execute();
                        $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Affichage des médecins
                        foreach($patients as $patient){
                            echo '<option value="'.$patient['idusager'].'">'.$patient['Nom'].' '.$patient['Prenom'].'</option>';
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="medecin">Médecin :</label>
                <select name="medecin" id="medecin">
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
                </select>
            </p>
            <p>
                <label for="dateHeure">Date et Heure:</label>
                <input type="datetime-local" name="dateHeure" id="dateHeure">
            </p>
            <p>
                <label for="duree">Durée:</label>
                <input type="number" name="duree" id="duree" value="30">
            </p>
            <p>
                <input type="submit" value="Créer le rendez-vous">
            </p> 
        </form>
        <button onclick="window.location.href='/PHP/affichageRDV.php'">Retour</button>
    </body>
</html>