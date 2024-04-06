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
	// Démarrer la session
	session_start();

	// Vérifier si le formulaire de connexion a été soumis
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Récupérer les données du formulaire
		$identifiant = $_POST['identifiant'];
		$mot_de_passe = $_POST['mot_de_passe'];

		// Appeler l'API d'authentification pour obtenir le token
		$url = 'https://api-patientele-auth.alwaysdata.net/authapi/';
		$data = array(
			'login' => $identifiant,
			'mdp' => $mot_de_passe
		);

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

		$response = curl_exec($curl);
		curl_close($curl);

		// Vérifier la réponse de l'API
		$decoded_response = json_decode($response, true);
		if (isset($decoded_response['token'])) {
			// Stocker le token dans une variable de session
			$_SESSION['token'] = $decoded_response['token'];
			// Rediriger l'utilisateur vers une page sécurisée, comme le menu
			header("Location: menu.php");
			exit();
		} else {
			// Gérer les erreurs d'authentification
			echo "Erreur lors de l'authentification : " . $response;
		}
	}
?>