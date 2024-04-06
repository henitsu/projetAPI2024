<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="shortcut icon" href="../Donnees/patientele_icon.ico" />
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/menu.css">
</head>
<body>
    <?php
        include 'header.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identifiant = $_POST['identifiant'];
            $mot_de_passe = $_POST['mot_de_passe'];

            // Préparation des données à envoyer
            $data = array('login' => $identifiant, 'mdp' => $mot_de_passe);
            $data_string = json_encode($data);

            // Initialisation de la requête
            $ch = curl_init('https://api-patientele-auth.alwaysdata.net/authapi');

            // Configuration des options de la requête
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
            );

            // Envoi de la requête et récupération de la réponse
            $result = curl_exec($ch);

            // Gestion de la réponse
            $response = json_decode($result, true);
            if (isset($response['token'])) {
                // Authentification réussie, redirection vers le menu
                $_SESSION['token'] = $response['token'];
            } else {
                // Authentification échouée, affichage d'un message d'erreur
                header('Location: index.php');
                echo 'Identifiant ou mot de passe incorrect';
                exit;
            }
        }

    ?>
        <main>
            <h1>Bienvenue <?php $_SESSION['login'] ?>!</h1>
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