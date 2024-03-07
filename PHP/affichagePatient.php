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
    echo '<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Civilité</th><th>adresse</th><th>Ville</th><th>Code postal</th>
    <th>Sexe</th><th>Date naissance</th><th>Lieu naissance</th><th>Numéro sécurité sociale</th><th>Action</th></tr>';

    foreach ($donnees as $donnee) {
        // Affiche les résultats
        
        echo '<tr>';
        echo '<td>' . $donnee['id_usager'] . '</td>';
        echo '<td>' . $donnee['nom'] . '</td>';
        echo '<td>' . $donnee['prenom'] . '</td>';
        echo '<td>' . $donnee['civilite'] . '</td>';
        echo '<td>' . $donnee['adresse'] . '</td>';
        echo '<td>' . $donnee['ville'] . '</td>';
        echo '<td>' . $donnee['code_postal'] . '</td>';
        echo '<td>' . date('d/m/Y', strtotime($donnee['date_nais'])) . '</td>';
        echo '<td>' . $donnee['sexe'] . '</td>';
        echo '<td>' . $donnee['lieu_nais'] . '</td>';
        echo '<td>' . $donnee['num_secu'] . '</td>';
        echo '<td><a href="modifierPatient.php?id=' . $donnee['id_usager'] . '&nom=' . $donnee['nom'] . '&prenom=' . $donnee['prenom'] 
        . '&adresse=' . $donnee['adresse'] . '&ville='. $donnee['ville'] . '&code_postal=' . $donnee['code_postal'] . '&sexe=' . $donnee["sexe"]
        . '&date_nais=' . $donnee['date_nais'] . '&lieu_nais=' . $donnee['lieu_nais'] 
        . '&num_secu=' . $donnee['num_secu'] . '">Modifier</a> | 
        <a href="supprimerPatient.php?id=' . $donnee['id_usager'] . '&nom=' . $donnee['nom'] . '&prenom='
        . '&num_secu=' . $donnee['num_secu'] . '">Supprimer</a></td>';
        echo '</tr>';
    }
    
    echo '</table>';
    ?>
</body>