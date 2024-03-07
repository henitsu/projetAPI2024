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
        echo '<td>' . $donnee['id_medecin'] . '</td>';
        echo '<td>' . $donnee['nom'] . '</td>';
        echo '<td>' . $donnee['prenom'] . '</td>';
        echo '<td>' . $donnee['civilite'] . '</td>';
        echo '<td><a href="modifierMedecin.php?id_medecin=' . $donnee['id_medecin'] . '&nom=' . $donnee['nom'] . '&prenom=' . $donnee['prenom'] 
        . '&civilite=' . $donnee['civilite'] . '">Modifier</a> | 
        <a href="supprimerMedecin.php?id_medecin=' . $donnee['id_medecin'] . '&nom=' . $donnee['nom'] . '&prenom=' . $donnee['prenom'] 
        . '&civilite=' . $donnee['civilite'] . '">Supprimer</a></td>';
        echo '</tr>';
        
    }
    ?>
</body>