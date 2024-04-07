<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Gestion d'un cabinet médical</title>
	<link rel="shortcut icon" href="Donnees/patientele_icon.ico" />
	<link rel="stylesheet" href="CSS/base.css">
	<link rel="stylesheet" href="CSS/index.css">
</head>
<body>
	<div class="container" id="container">
		<div class="form-container log-in-container">
			<form action="./PHP/menu.php" method="post">
				<h1>Authentification</h1>
				<input name="identifiant" type="text" placeholder="Identifiant" />
				<input name="mot_de_passe" type="password" placeholder="Mot de passe" />
				<p>Mot de passe oublié ? Consultez le README</p>
				<button>Se connecter</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-right">
					<h1>Gestion d'un cabinet médical</h1>
					<img src="Donnees/doctor.png" alt="docteur">
				</div>
			</div>
		</div>
	</div>
</body>

</html>

<?php
    session_start();

    if (isset($_POST['identifiant']) && isset($_POST['mot_de_passe'])) {
        // Récupérer les identifiants saisis dans le formulaire
        $data = array(
            'login' => $_POST['identifiant'],
            'mdp' => $_POST['mot_de_passe']
        );
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n",
                'content' => json_encode($data)
            )
        );

        // Envoyer une requête à l'API pour obtenir le token
        $context = stream_context_create($options);
        $baseUrl = 'https://api-patientele-auth.alwaysdata.net/authapi';
        $result = file_get_contents($baseUrl, false, $context);
        
        // Vérifier si la requête a réussi et récupérer le token
        if ($result !== false) {
            $response = json_decode($result, true);
            $token = $response['token'];
            
            // Stocker le token dans la session
            $_SESSION['token'] = $token;

            // Redirection vers menu.php ou toute autre page appropriée
            header('Location: ./PHP/menu.php');
            exit;
        } else {
            // Afficher un message d'erreur si l'authentification a échoué
            echo '<script>alert("Identifiant ou mot de passe incorrect")</script>';
        }
    }
?>