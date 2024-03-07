<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Gestion d'un cabinet médical</title>
    <link rel="shortcut icon" href="/Donnees/patientele_icon.ico" />
    <link rel="stylesheet" href="/CSS/base.css">
    <link rel="stylesheet" href="/CSS/affichage.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Affichage des consultations</h1>
    <div class="creer">
        Ajouter une nouvelle consultation : <strong><a href="/PHP/creationconsultation.php">Ajouter</a></strong>
    </div>
    <?php

    require 'connexionBD.php';
    // Vérifier s'il y a un message dans la variable de session
    if(isset($_SESSION['message'])){
        echo '<p>' . $_SESSION['message'] . '</p>';
        // Supprimer le message de la variable de session pour éviter qu'il ne soit affiché à chaque chargement de la page
        unset($_SESSION['message']);
    }

    $reponseTri = $bdd->query("SELECT DISTINCT nom FROM medecin");
    $medecins = $reponseTri->fetchAll();
    echo '<form action="affichageconsultation.php" method="post">';
    echo '<label for="medecin">Trier par médecin : </label>';
    echo '<select name="medecin" id="medecin">';
    echo '<option value="tous">Tous</option>';
    foreach ($medecins as $medecin) {
        echo '<option value="' . $medecin['nom'] . '">' . $medecin['nom'] . '</option>';
    }
    echo '</select>';
    echo '<input type="submit" value="Trier">';
    echo '</form>';

    $donnees = array();
    if (isset($_POST['medecin'])) {
        if ($_POST['medecin'] != 'tous') {
            $reponse = $bdd->query(
                "SELECT DISTINCT usager.id_usager id_usager, medecin.id_medecin id_medecin, usager.nom nom_usager, medecin.nom nom_medecin, consultation.DateHeureconsultation, consultation.duree
                FROM consultation, usager, medecin
                WHERE consultation.id_usager = usager.id_usager AND medecin.id_medecin = consultation.id_medecin AND medecin.nom = '" . $_POST['medecin'] . "'
                ORDER BY 2, 3");
            $donnees = $reponse->fetchAll();
        }
        else {
            $reponse = $bdd->query(
                "SELECT DISTINCT usager.id_usager id_usager, medecin.id_medecin id_medecin, usager.nom nom_usager, medecin.nom nom_medecin, consultation.DateHeureconsultation, consultation.duree
                FROM consultation, usager, medecin
                WHERE consultation.id_usager = usager.id_usager AND medecin.id_medecin = consultation.id_medecin");
            $donnees = $reponse->fetchAll();
        }
    } 
    else {
        $reponse = $bdd->query(
            "SELECT DISTINCT usager.id_usager id_usager, medecin.id_medecin id_medecin, usager.nom nom_usager, medecin.nom nom_medecin, consultation.DateHeureconsultation, consultation.duree
            FROM consultation, usager, medecin
            WHERE consultation.id_usager = usager.id_usager AND medecin.id_medecin = consultation.id_medecin");
        $donnees = $reponse->fetchAll();
    }
    
    
    echo '<table border="1">';
    echo '<tr><th>Nom médecin</th><th>Nom patient</th><th>Date</th><th>Heure</th><th>Durée (en minutes)</th><th>Action</th></tr>';

    foreach ($donnees as $donnee) {
        // Affiche les résultats
        
        echo '<tr>';
        echo '<td>' . $donnee['nom_medecin'] . '</td>';
        echo '<td>' . $donnee['nom_usager'] . '</td>';
        echo '<td>' . date('d/m/Y', strtotime($donnee['date'])) . '</td>';
        echo '<td>' . date('H:i', strtotime($donnee['heure'])) . '</td>';
        echo '<td>' . $donnee['duree'] . '</td>';
        echo '<td><a href="modifierRDV.php?id_usager=' . $donnee['id_usager'] . '&id_medecin=' . $donnee['id_medecin'] . '&nom_usager=' . $donnee['nom_usager'] . '&nom_medecin=' . $donnee['nom_medecin'] . '&dateHeure=' . $donnee['DateHeureconsultation'] 
        . '&duree=' . $donnee['duree'] . '">Modifier</a> | 
        <a href="supprimerRDV.php?id_usager=' . $donnee['id_usager'] . '&id_medecin=' . $donnee['id_medecin'] . '&nom_usager=' . $donnee['nom_usager'] . '&nom_medecin=' . $donnee['nom_medecin'] . '&dateHeure=' . $donnee['DateHeureconsultation'] 
        . '&duree=' . $donnee['duree'] . '">Supprimer</a></td>';
        echo '</tr>';
        
    }
    ?>
</body>
