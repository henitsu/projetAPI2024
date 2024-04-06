<?php
    include 'header.php';

    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="shortcut icon" href="../Donnees/patientele_icon.ico" />
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/profil.css">
</head>
<body>
    <main>
        <h1>Profil</h1>
        <div class="profil">
            <div id="photo">
                <img src="https://i.pravatar.cc/85" alt="photo-profil">
            </div>
            <div class="box">
                <ul class="inner-box">
                    <li>
                        <h2>Nom</h2>
                        <p><?php echo $secretaire['Nom']; ?></p>
                    </li>
                    <li>
                        <h2>Prénom</h2>
                        <p><?php echo $secretaire['Prenom']; ?></p>
                    </li>
                    <li>
                        <h2>Login</h2>
                        <p><?php echo $secretaire['Login']; ?></p>
                    </li>
                </ul>
            </div>
        </div>
    </main>
</body>  