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
    <h1>Affichage des médecins</h1>
    <div class="creer">
        Ajouter un nouveau médecin : <strong><a href="/PHP/creationMedecin.php">Ajouter</a></strong>
    </div>
    <?php
    // Connexion à la base de données
    require 'connexionBD.php';
    
    // Vérifier s'il y a un message dans la variable de session
    if(isset($_SESSION['message'])){
        echo '<p>' . $_SESSION['message'] . '</p>';
        // Supprimer le message de la variable de session pour éviter qu'il ne soit affiché à chaque chargement de la page
        unset($_SESSION['message']);
    }

    $reponse = $bdd->query("SELECT * FROM medecin");
    $donnees = $reponse->fetchAll();
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Civilité</th><th>Action</th></tr>';

    foreach ($donnees as $donnee) {
        // Affiche les résultats
        
        echo '<tr>';
        echo '<td>' . $donnee['Id_Medecin'] . '</td>';
        echo '<td>' . $donnee['Nom'] . '</td>';
        echo '<td>' . $donnee['Prenom'] . '</td>';
        echo '<td>' . $donnee['Civilite'] . '</td>';
        echo '<td><a href="modifierMedecin.php?Id_Medecin=' . $donnee['Id_Medecin'] . '&nom=' . $donnee['Nom'] . '&prenom=' . $donnee['Prenom'] 
        . '&civilite=' . $donnee['Civilite'] . '">Modifier</a> | 
        <a href="supprimerMedecin.php?Id_Medecin=' . $donnee['Id_Medecin'] . '&nom=' . $donnee['Nom'] . '&prenom=' . $donnee['Prenom'] 
        . '&civilite=' . $donnee['Civilite'] . '">Supprimer</a></td>';
        echo '</tr>';
        
    }
    ?>
</body>