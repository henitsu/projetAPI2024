<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="shortcut icon" href="/Donnees/patientele_icon.ico" />
    <link rel="stylesheet" href="/CSS/base.css">
    <link rel="stylesheet" href="/CSS/menu.css">
</head>
<body>
    <?php
        include 'header.php';
    ?>
        <main>
            <h1>Bienvenue  !</h1>
            <div class="grid">
                <div id="usagers" class="box">
                    <a href="affichagePatient.php"><h2>Usagers</h2></a>
                </div>
                <div id="medecins" class="box">
                    <a href="affichageMedecin.php"><h2>Médecins</h2></a>
                </div>
                <div id="consultations" class="box">
                    <a href="affichageRDV.php"><h2>Consultations</h2></a>
                </div>
                <div id="statistiques" class="box">
                    <a href="stats.php"><h2>Statistiques</h2></a>
                </div>
            </div>
        </main>
    </body>
</html>