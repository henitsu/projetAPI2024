<?php
    // Inclusion de la classe Patient et de la BD
    include 'header.php';
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
                <label for="id_usager">Patient:</label>
                <select name="id_usager" id="id_usager">
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
                <label for="id_medecin">Médecin :</label>
                <select name="id_medecin" id="id_medecin">
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
                <input type="date" name="date_consult" id="date_consult">
            </p>
            <p>
                <label for="heure_consult">Heure :</label>
                <input type="time" name="heure_consult" id="heure_consult">
            </p>
            <p>
                <label for="duree_consult">Durée:</label>
                <input type="number" name="duree_consult" id="duree_consult" value="30">
            </p>
            <p>
                <input type="submit" value="Créer le rendez-vous">
            </p> 
        </form>
        <button onclick="window.location.href='affichageRDV.php'">Retour</button>
    </body>
</html>