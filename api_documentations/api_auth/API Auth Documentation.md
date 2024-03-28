# API Auth Documentation

## Description

Cette API permet de générer un token à partir d’un login (celui de la secrétaire) et de son mot de passe. 

## Base URL

L’URL de base utilisée pour notre API d’authentification est la suivante : 

[`https://api-patientele-auth.alwaysdata.net`](https://api-patientele-auth.alwaysdata.net)

## Endpoints

### `POST /authapi`

Renvoie un token généré à partir de l’identifiant de la secrétaire et de son mot de passe.

### Exemple

Requête :

```php
POST /authapi
```

Body :

```json
{
	"login":"secretaire1",
	"mdp":"password1234!"
}
```

Réponse :

```json
{
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJsb2dpbiI6InNlY3JldGFpcmUxIiwiZXhwIjo1MTM0OTA0NjE2MDAwfQ.SDzDxv-Rge2gu3O4VQguIggoPIWj0mGsjtk7icJNcE0"
}
```

### `GET /authapi`

Vérifie l’authentification de la personne connectée. Renvoie l’identifiant ainsi que le mot de passe de cette personne. 

### Réponse

Renvoie un document JSON avec les champs suivants :

- `login`: identifiant de connexion de la personne souhaitant s’authentifier.
- `mdp`: le mot de passe de la personne s’authentifiant.

### Exemple

Requête :

```php
GET /authapi
```

Token généré après la requête `POST` à mettre dans Auth, dans Bearer :

![Bearer Token](/api_documentations/api_auth/bearer_token.png)

Réponse :

```json
{
  "login": "secretaire1",
  "mdp": "password1234!"
}
```

## Erreurs

Cette API peut renvoyer les erreurs suivantes :

- `405 Bad Request`: La méthode n’est pas autorisée.
- `401 Unauthorized`: Une condition permettant d’avoir accès aux données n’est pas remplie. Ici, avec le cas de `GET` où le token ou le mot de passe ou le login est invalide.
- `404 Not Found`: La ressource de la requête est introuvable.
- `500 Internal Server Error`: Une erreur inattendue s’est produite dans le serveur.