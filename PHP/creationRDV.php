<?php
    // Inclusion de la classe Patient et de la BD
    include 'header.php';
    require 'rdv.php';
    require 'connexionBD.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        // Création d'un nouveau consultation
        $consultation = new rdv($_POST["heure"], $_POST['date'], $_POST['duree'], $_POST['id_medecin'], $_POST['id_usager']);
        $heure = $consultation->getHeure();
        $date = $consultation->getDate();
        $duree = $consultation->getDuree();
        $id_medecin = $consultation->getId_medecin();
        $id_usager = $consultation->getId_usager();

        // Ajout du consultation dans la BD
        try{

            $sql_trigger_consultation = "
                CREATE OR REPLACE TRIGGER consultation_avant_insert BEFORE INSERT ON consultation
                FOR EACH ROW
                BEGIN
                    IF (SELECT COUNT(*) FROM consultation WHERE id_medecin = NEW.id_medecin and id_usager = :NEW.id_usager AND date = NEW.date AND heure = NEW.heure) > 0 THEN
                        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Il y a déjà une consultation à cette date et heure';
                    END IF;
                    IF (SELECT COUNT(*) FROM consultation WHERE id_medecin = NEW.id_medecin AND date + INTERVAL duree MINUTE < NEW.date + NEW.duree 
                    AND NEW.date + INTERVAL New.duree MINUTE > date AND id_usager != NEW.id_usager) > 0 THEN
                        SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = 'Ce médecin sera encore en consultation à cette date et heure.';
                    END IF;                    
                END;";
            
            $bdd->exec($sql_trigger_consultation);

            $sql = "INSERT INTO consultation (id_medecin, id_usager, date, heure, duree)
            VALUES(:id_medecin, :id_usager, :date, :heure :duree)";

            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':id_medecin', $id_medecin, PDO::PARAM_INT);
            $stmt->bindParam(':id_usager', $id_usager, PDO::PARAM_INT);
            $stmt->bindParam(':heure', $heure, PDO::PARAM_STR);
            $stmt->bindParam(':date', $dateHeure, PDO::PARAM_STR);
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
                <label for="date">Date :</label>
                <input type="datetime-local" name="date" id="date">
            </p>
            <p>
                <label for="heure">Heure :</label>
                <input type="datetime-local" name="heure" id="heure">
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