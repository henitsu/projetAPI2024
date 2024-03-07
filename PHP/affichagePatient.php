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
    <h1>Affichage des patients</h1>
    <div class="creer">
        Ajouter un nouveau patient : <strong><a href="/PHP/creationPatient.php">Ajouter</a></strong>
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

    $reponse = $bdd->query("SELECT * FROM usager");
    $donnees = $reponse->fetchAll();
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Date naissance</th><th>Lieu naissance</th><th>Numéro sécurité sociale</th><th>Action</th></tr>';

    foreach ($donnees as $donnee) {
        // Affiche les résultats
        
        echo '<tr>';
        echo '<td>' . $donnee['idusager'] . '</td>';
        echo '<td>' . $donnee['Nom'] . '</td>';
        echo '<td>' . $donnee['Prenom'] . '</td>';
        echo '<td>' . $donnee['Adresse'] . '</td>';
        echo '<td>' . date('d/m/Y', strtotime($donnee['DateNaissance'])) . '</td>';
        echo '<td>' . $donnee['LieuNaissance'] . '</td>';
        echo '<td>' . $donnee['NumSecu'] . '</td>';
        echo '<td><a href="modifierPatient.php?id=' . $donnee['idusager'] . '&nom=' . $donnee['Nom'] . '&prenom=' . $donnee['Prenom'] 
        . '&adresse=' . $donnee['Adresse'] . '&dateNaissance=' . $donnee['DateNaissance'] . '&lieuNaissance=' . $donnee['LieuNaissance'] 
        . '&numSecu=' . $donnee['NumSecu'] . '">Modifier</a> | 
        <a href="supprimerPatient.php?id=' . $donnee['idusager'] . '&nom=' . $donnee['Nom'] . '&prenom=' . $donnee['Prenom'] 
        . '&adresse=' . $donnee['Adresse'] . '&dateNaissance=' . $donnee['DateNaissance'] . '&lieuNaissance=' . $donnee['LieuNaissance'] 
        . '&numSecu=' . $donnee['NumSecu'] . '">Supprimer</a></td>';
        echo '</tr>';
    }
    
    echo '</table>';
    ?>
</body>