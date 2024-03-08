<?php
    // Inclusion de la classe Patient et de la BD
    include 'header.php';
    require 'rdv.php';
    require 'connexionBD.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        // Création d'un nouveau consultation
        $consultation = new rdv($_POST["heure_consult"], $_POST['date_consult_consult'], $_POST['duree'], $_POST['id_medecin'], $_POST['id_usager']);
        $heure_consult_consult = $consultation->getHeure();
        $date_consult = $consultation->getDate();
        $duree = $consultation->getDuree();
        $id_medecin = $consultation->getId_medecin();
        $id_usager = $consultation->getId_usager();

        // Ajout du consultation dans la BD
        try{

            $sql_trigger_consultation = "
                CREATE OR REPLACE TRIGGER consultation_avant_insert BEFORE INSERT ON consultation
                FOR EACH ROW
                BEGIN
                    IF (SELECT COUNT(*) FROM consultation WHERE id_medecin = NEW.id_medecin and id_usager = :NEW.id_usager AND date_consult = NEW.date_consult AND heure_consult = NEW.heure_consult) > 0 THEN
                        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Il y a déjà une consultation à cette date et heure';
                    END IF;
                    IF (SELECT COUNT(*) FROM consultation WHERE id_medecin = NEW.id_medecin AND date_consult + INTERVAL duree MINUTE < NEW.date_consult + NEW.duree 
                    AND NEW.date_consult + INTERVAL New.duree MINUTE > date_consult AND id_usager != NEW.id_usager) > 0 THEN
                        SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = 'Ce médecin sera encore en consultation à cette date et heure.';
                    END IF;                    
                END;";
            
            $bdd->exec($sql_trigger_consultation);

            $sql = "INSERT INTO consultation (id_medecin, id_usager, date_consult, heure_consult, duree)
            VALUES(:id_medecin, :id_usager, :date_consult, :heure_consult :duree)";

            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':id_medecin', $id_medecin, PDO::PARAM_INT);
            $stmt->bindParam(':id_usager', $id_usager, PDO::PARAM_INT);
            $stmt->bindParam(':heure_consult', $heure_consult, PDO::PARAM_STR);
            $stmt->bindParam(':date_consult', $date_consult, PDO::PARAM_STR);
            $stmt->bindParam(':duree', $duree, PDO::PARAM_INT);
            $stmt->execute();

            // Stocker le message dans la variable de session
            $_SESSION['message'] = 'Le rendez-vous a bien été créé !';

            // Redirection vers la page d'affichage des médecins
            header('Location: affichageRDV.php');
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
    <link rel="shortcut icon" href="../Donnees/patientele_icon.ico" />
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/creation.css">
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
                            echo '<option value="'.$patient['id_usager'].'">'.$patient['nom'].' '.$patient['prenom'].'</option>';
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
                            echo '<option value="'.$medecin['id_medecin'].'">'.$medecin['nom'].' '.$medecin['prenom'].'</option>';
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="date_consult">Date :</label>
                <input type="date_consulttime-local" name="date_consult" id="date_consult">
            </p>
            <p>
                <label for="heure_consult">Heure :</label>
                <input type="date_consulttime-local" name="heure_consult" id="heure_consult">
            </p>
            <p>
                <label for="duree">Durée:</label>
                <input type="number" name="duree" id="duree" value="30">
            </p>
            <p>
                <input type="submit" value="Créer le rendez-vous">
            </p> 
        </form>
        <button onclick="window.location.href='affichageRDV.php'">Retour</button>
    </body>
</html>