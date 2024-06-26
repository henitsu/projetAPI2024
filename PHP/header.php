<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/base.css">
<body>
    <header>
            <div class="menu-container">
                <div class="logo">
                    <a href="menu.php"><img src="../Donnees/doctor.png" alt="logo"></a>
                </div>
                <div class="burger-menu" onclick="toggleMenu()">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
                <ul class="menuheader">
                    <li><a href="affichagePatient.php">Usagers</a></li>
                    <li><a href="affichageMedecin.php">Médecins</a></li>
                    <li><a href="affichageRDV.php">Consultations</a></li>
                    <li><a href="stats.php">Statistiques</a></li>
                    <li><a href="#" class="display-picture"><img src="https://i.pravatar.cc/85" alt="profil"></a></li>
                </ul>
            </div>
            
            <div class="card hidden">
                <ul>
                    <li>
                        <img src="../Donnees/login.svg" alt="login">
                        <a href="profil.php">Compte</a>
                    </li>
                    <li>
                        <img src="../Donnees/logout.png" alt="logout">
                        <a href="deconnexion.php">Se déconnecter</a>
                    </li>
                </ul>
            </div>
    </header>
    <script src="../JS/header.js"></script>
</body>
</html>