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
        if (!empty($_POST['identifiant'])){
            $_SESSION["identifiant"] = $_POST["identifiant"];
            $session_id = session_id();
        }
        $login = $_SESSION['identifiant'];

        require 'connexionBD.php';
        $sql = "SELECT Nom, Prenom FROM secretaire WHERE login = :Login";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':Login', $login, PDO::PARAM_STR);
        $stmt->execute();
        $secretaire = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$secretaire){
            echo "<h2>Oh, il semble que vous ne soyez pas référencé en poste donné !</h2>";
            header("refresh:3;url=/index.php");
        } else {
            $nom = $secretaire['Nom'];
            $prenom = $secretaire['Prenom'];
            
            // Création des variables de session
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;

            echo 
            '<main>
                <h1>Bienvenue ' . $prenom . " " . $nom . ' !</h1>
                <div class="grid">
                    <div id="usagers" class="box">
                        <a href="/PHP/affichagePatient.php"><h2>Usagers</h2></a>
                    </div>
                    <div id="medecins" class="box">
                        <a href="/PHP/affichageMedecin.php"><h2>Médecins</h2></a>
                    </div>
                    <div id="consultations" class="box">
                        <a href="/PHP/affichageRDV.php"><h2>Consultations</h2></a>
                    </div>
                    <div id="statistiques" class="box">
                        <a href="/PHP/stats.php"><h2>Statistiques</h2></a>
                    </div>
                </div>
            </main>
            </body>
            </html>';
        }
    ?>