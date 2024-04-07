# projetAPI2024
Projet en Architecture logicielle - Développement d'une API Rest en BUT2

# Etudiantes
Lilou PEDRO (@lilouuuuuuu) et Mirindra RANDRIANARISON RATSIANDAVANA (@henitsu)

# API Authentification
L'URL de base utilisée pour cette API est [`https://api-patientele-auth.alwaysdata.net/authapi`](https://api-patientele-auth.alwaysdata.net/authapi)

Cette API sert à l'authentification de l'utilisateur.
La documentation de l'API se trouve dans le fichier `/api_documentations/api_auth/API Auth Documentation.md` ou `/api_documentations/api_auth/API Auth Documentation.pdf`

Les identifiants pour l'authentification sont :
```json
{
  "login":"secretaire1",
  "mdp":"password1234!"
}
```

# API Cabmed
L'URL de base utilisée pour cette API est [`https://api-patientele-cabmed.alwaysdata.net/cabmed`](https://api-patientele-cabmed.alwaysdata.net/cabmed)

Cette API sert à la gestion des différentes instances de l'API, à savoir les *usagers*, les *médecins*, les *consultations* et les *statistiques*
La documentation de l'API se trouve dans le fichier `/api_documentations/api_cabmed/API Cabmed Documentation.md` ou `/api_documentations/api_cabmed/API Cabmed Documentation.pdf`

# Repo GIT
Le repository GIT du projet se trouve au lien suivant : [`projetAPI2024`](https://github.com/henitsu/projetAPI2024.git)

# Partie Front-End
La partie Front-End de l'application a été réalisée, notamment dans le répertoire `PHP`et le fichier `index.php`à la racine du projet.
Le client se trouve à l'adresse suivante :

## Ce qui n'a pas été fait dans la partie Front-end
- L'utilisation de l'API authentification
