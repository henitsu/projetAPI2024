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
        header('Location: menu.php');
        exit;
    } else {
        // Authentification échouée, affichage d'un message d'erreur
        $error_message = 'Identifiant ou mot de passe incorrect';
    }
}
?>