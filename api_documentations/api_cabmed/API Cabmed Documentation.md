# API Cabmed Documentation

## Description

Cette API permet de gérer un cabinet médical composé de :

- Usagers
- Médecins
- Statistiques
- Consultations

## Base URL

L’URL de base pour toutes les requêtes de l’API est :

[`https://api-patientele-cabmed.alwaysdata.net/cabmed`](https://api-patientele-auth.alwaysdata.net/authapi)

## Endpoints

- **Pour les usagers**
    
    ### `GET /usagers`
    
    Retourne la liste de tous les usagers.
    
    ### Réponse
    
    Retourne un objet JSON avec les propriétés suivantes :
    
    - `status_code` : Le statut du résultat de la requête
    - `status_message` : Le message du statut du résultat de la requête
    - `data` : Un tableau de données contenant les propriétés suivantes :
        - `id_usager`: L’identifiant unique de l’usager
        - `civilite`: La civilité de l’usager
        - `nom`: Le nom de l’usager
        - `prenom`: Le prénom de l’usager
        - `sexe`: Le sexe de l’usager
        - `adresse`: L’adresse de l’usager
        - `code_postal`: Le code postal de l’usager
        - `ville`: La ville où l’usager habite
        - `date_nais`: La date de naissance de l’usager
        - `lieu_nais`: Le lieu de naissance de l’usager
        - `num_secu`: Le numéro de sécurité de l’usager
        - `id_medecin`: L’identifiant du médecin référant de l’usager
    
    ### Exemple
    
    Requête :
    
    ```php
    GET /usagers
    ```
    
    Réponse:
    
    ```json
    {
      "status_code": 200,
      "status_message": "OK (récupération patient(s))",
      "data": [
        {
          "id_usager": 10,
          "civilite": "Mme",
          "nom": "Delamer",
          "prenom": "Arielle",
          "sexe": "F",
          "adresse": "101, Vague de l'Atlantis",
          "code_postal": "31000",
          "ville": "Toulouse",
          "date_nais": "1995-08-26",
          "lieu_nais": "Atlantica",
          "num_secu": "112233445566678",
          "id_medecin": 1
        },
        {
          "id_usager": 12,
          "civilite": "M.",
          "nom": "Dumond",
          "prenom": "Armand",
          "sexe": "H",
          "adresse": "85, Square de la Couronne",
          "code_postal": "91120",
          "ville": "Palaiseau",
          "date_nais": "1952-05-14",
          "lieu_nais": "Nantes",
          "num_secu": "112233445566778",
          "id_medecin": 1
        }
      ]
    }
    ```
    
    ### `GET /usagers/<id>`
    
    Retourne l’usager d’identifiant id.
    
    ### Paramètres
    
    - `id`: L’ID de l’usager à récupérer.
    
    ### Réponse
    
    Retourne un objet JSON avec les propriétés suivantes :
    
    - `status_code` : Le statut du résultat de la requête
    - `status_message` : Le message du statut du résultat de la requête
    - `data` : Un tableau de données contenant les propriétés suivantes :
        - `id_usager`: L’identifiant unique de l’usager
        - `civilite`: La civilité de l’usager
        - `nom`: Le nom de l’usager
        - `prenom`: Le prénom de l’usager
        - `sexe`: Le sexe de l’usager
        - `adresse`: L’adresse de l’usager
        - `code_postal`: Le code postal de l’usager
        - `ville`: La ville où l’usager habite
        - `date_nais`: La date de naissance de l’usager
        - `lieu_nais`: Le lieu de naissance de l’usager
        - `num_secu`: Le numéro de sécurité de l’usager
        - `id_medecin`: L’identifiant du médecin référant de l’usager
    
    ### Exemple
    
    Requête :
    
    ```php
    GET /usagers/10
    ```
    
    Réponse:
    
    ```json
    {
      "status_code": 200,
      "status_message": "OK (récupération patient(s))",
      "data": [
        {
          "id_usager": 10,
          "civilite": "Mme",
          "nom": "Delamer",
          "prenom": "Arielle",
          "sexe": "F",
          "adresse": "101, Vague de l'Atlantis",
          "code_postal": "31000",
          "ville": "Toulouse",
          "date_nais": "1995-08-26",
          "lieu_nais": "Atlantica",
          "num_secu": "112233445566678",
          "id_medecin": 1
        }
      ]
    }
    ```
    
    ### `POST /usagers`
    
    Crée un usager.
    
    ### Réponse
    
    Retourne un objet JSON avec les propriétés suivantes :
    
    - `status_code` : Le statut du résultat de la requête
    - `status_message` : Le message du statut du résultat de la requête
    - `data` : L’identifiant unique de l’usager créé
    
    ### Exemple
    
    Requête :
    
    ```php
    POST /usagers
    ```
    
    Body :
    
    ```json
    {
        "civilite":"Mme",
        "nom":"Dumond",
        "prenom":"Armandia",
        "sexe":"F",
        "adresse":"85, Square de la Couronne",
        "code_postal":"91120",
        "ville":"Palaiseau",
        "date_nais":"29/05/1952",
        "lieu_nais":"Nantes",
        "num_secu":"3524364758",
        "id_medecin":"1"
    }
    ```
    
    Réponse:
    
    ```json
    {
      "status_code": 201,
      "status_message": "Patient créé",
      "data": "13"
    }
    ```
    
    ### `PATCH /usagers/<id>`
    
    Modifie l’usager d’identifiant id.
    
    ### Paramètres
    
    - `id`: L’ID de l’usager à modifier.
    
    ### Réponse
    
    Retourne un objet JSON avec les propriétés suivantes :
    
    - `status_code` : Le statut du résultat de la requête
    - `status_message` : Le message du statut du résultat de la requête
    - `data` : Un tableau de données contenant les propriétés suivantes :
        - `id_usager`: L’identifiant unique de l’usager modifié
        - `civilite`: La civilité de l’usager modifié
        - `nom`: Le nom de l’usager modifié
        - `prenom`: Le prénom de l’usager modifié
        - `sexe`: Le sexe de l’usager modifié
        - `adresse`: L’adresse de l’usager modifié
        - `code_postal`: Le code postal de l’usager modifié
        - `ville`: La ville où l’usager habite modifié
        - `date_nais`: La date de naissance de l’usager modifié
        - `lieu_nais`: Le lieu de naissance de l’usager modifié
        - `num_secu`: Le numéro de sécurité de l’usager modifié
        - `id_medecin`: L’identifiant du médecin référant de l’usager modifié
    
    ### Exemple
    
    Requête :
    
    ```php
    PATCH /usagers/16
    ```
    
    Body :
    
    ```json
    {
        "civilite":"Mme",
        "prenom":"Jeanne"
    }
    ```
    
    Réponse :
    
    ```json
    {
      "status_code": 200,
      "status_message": "Patient modifié",
      "data": {
        "id_usager": 16,
        "civilite": "Mme",
        "nom": "Dark",
        "prenom": "Jeanne",
        "sexe": "F",
        "adresse": "101, rue de la roulade",
        "code_postal": "91120",
        "ville": "Routier",
        "date_nais": "1952-05-29",
        "lieu_nais": "Nantes",
        "num_secu": "123245643221",
        "id_medecin": 1
      }
    }
    ```
    
    ### `DELETE /usagers/<id>`
    
    Supprime un usager d’ID id.
    
    ### Réponse
    
    Retourne un objet JSON avec les propriétés suivantes :
    
    - `status_code` : Le statut du résultat de la requête
    - `status_message` : Le message du statut du résultat de la requête
    
    ### Exemple
    
    Requête :
    
    ```php
    DELETE /usagers/1
    ```
    
    Réponse :
    
    ```json
    {
        "status_code": 200,
        "status_message": "Patient supprimé",
        "data": "1"
    }
    ```
    

---

- **Pour les médecins**
    
    ### `GET /medecins`
    
    Retourne la liste de tous les médecins.
    
    ### Réponse
    
    Retourne un objet JSON avec les propriétés suivantes :
    
    - `status_code` : Le statut du résultat de la requête
    - `status_message` : Le message du statut du résultat de la requête
    - `data` : Un tableau de données contenant les propriétés suivantes :
        - `id_medecin`: L’identifiant unique du médecin
        - `civilite`: La civilité du médecin (M. ou Mme)
        - `nom`: Le nom du médecin
        - `prenom`: Le prénom du médecin
    
    ### Exemple
    
    Requête :
    
    ```php
    GET /medecins
    ```
    
    Réponse :
    
    ```json
    {
        "status_code": 200,
        "status_message": "OK",
        "data": [
            {
                "id_medecin": 1,
                "civilite": "M",
                "nom": "Mermoz",
                "prenom": "Jean"
            },
            {
                "id_medecin": 3,
                "civilite": "M",
                "nom": "Latecoere",
                "prenom": "Georges"
            }
        ]
    }
    ```
    
    ### `GET /medecins/<id>`
    
    Retourne le médecin d’identifiant id. 
    
    ### Paramètres
    
    - `id`: L’ID du médecin à récupérer.
    
    ### Réponse
    
    Retourne un objet JSON avec les propriétés suivantes :
    
    - `status_code` : Le statut du résultat de la requête
    - `status_message` : Le message du statut du résultat de la requête
    - `data` : Un tableau de données contenant les propriétés suivantes :
        - `id_medecin`: L’identifiant unique du médecin
        - `civilite`: La civilité du médecin (M. ou Mme)
        - `nom`: Le nom du médecin
        - `prenom`: Le prénom du médecin
    
    ### Exemple
    
    Requête :
    
    ```php
    GET /medecins/1
    ```
    
    Réponse :
    
    ```json
    {
        "status_code": 200,
        "status_message": "OK",
        "data": [
            {
                "id_medecin": 1,
                "civilite": "M",
                "nom": "Mermoz",
                "prenom": "Jean"
            }
    		]
    }
    ```
    
    ### `POST /medecins`
    
    Crée un médecin.
    
    ### Réponse
    
    Retourne un objet JSON avec les propriétés suivantes :
    
    - `status_code` : Le statut du résultat de la requête
    - `status_message` : Le message du statut du résultat de la requête
    - `data` : Un tableau de données contenant les propriétés suivantes :
        - `id_medecin`: L’identifiant unique du médecin créé
    
    ### Exemple
    
    Requête :
    
    ```php
    POST /medecins
    ```
    
    Body :
    
    ```json
    {
        "civilite":"M.",
        "nom":"Dupond",
        "prenom":"Gérard"
    }
    ```
    
    Réponse :
    
    ```json
    {
        "status_code": 201,
        "status_message": "Médecin rajouté",
        "data": "53"
    }
    ```
    

### `PATCH /medecins/<id>`

Modifie le médecin d’identifiant id.

### Paramètres

- `id`: L’ID du médecin à modifier.

### Réponse

Retourne un objet JSON avec les propriétés suivantes :

- `status_code` : Le statut du résultat de la requête
- `status_message` : Le message du statut du résultat de la requête
- `data` : Un tableau de données contenant les propriétés suivantes :
    - `id_medecin`: L’identifiant unique du médecin modifié
    - `civilite` : La civilité du médecin modifié
    - `nom` : Le nom du médecin modifié
    - `prenom` : Le prénom du médecin modifié

### Exemple

Requête :

```php
PATCH /medecins/11
```

Body :

```json
{
    "prenom":"Gordon"
}
```

Réponse :

```json
{
  "status_code": 200,
  "status_message": "Médecin modifié",
  "data": {
    "id_medecin": 11,
    "civilite": "M.",
    "nom": "Ramsay",
    "prenom": "Gordon"
  }
}
```

### `DELETE /medecins/<id>`

Supprime le médecin d’identifiant id.

### Paramètres

- `id`: L’ID du médecin à supprimer.

### Réponse

Retourne un objet JSON avec les propriétés suivantes :

- `status_code` : Le statut du résultat de la requête
- `status_message` : Le message du statut du résultat de la requête
- `data` : Un tableau de données contenant les propriétés suivantes :
    - `id_medecin`: L’identifiant unique du médecin supprimé

### Exemple

Requête :

```php
DELETE /medecins/1
```

Réponse :

```json
{
    "status_code": 200,
    "status_message": "Médecin supprimé",
    "data": 1
}
```

---

- **Pour les consultations**
    
    ### `GET /consultations`
    
    Retourne la liste de toutes les consultations.
    
    ### Réponse
    
    Retourne un objet JSON avec les propriétés suivantes :
    
    - `status_code` : Le statut du résultat de la requête
    - `status_message` : Le message du statut du résultat de la requête
    - `data` : Un tableau de données contenant les propriétés suivantes :
        - `id_consult`: L’identifiant unique de la consultation
        - `id_medecin` : L’identifiant unique du médecin
        - `id_usager` : L’identifiant unique de l’usager
        - `date_consult` : La date de la consultation
        - `heure_consult` : L’heure de la consultation
        - `duree_consult`: La durée de la consultation
        - `nom_usager`: Le nom de l’usager
        - `nom_medecin` : Le nom du médecin
    
    ### Exemple
    
    Requête :
    
    ```php
    GET /consultations
    ```
    
    Réponse :
    
    ```json
    {
        "status_code": 200,
        "status_message": "OK (récupération consultation(s))",
        "data": [
            {
                "id_consult": 1,
                "id_medecin": 3,
                "id_usager": 10,
                "date_consult": "2024-10-24",
                "heure_consult": "11:30:00",
                "duree_consult": 30,
                "nom_usager": "Delamer",
                "nom_medecin": "Mermoz"
            },
            {
                "id_consult": 2,
                "id_medecin": 8,
                "id_usager": 12,
                "date_consult": "2022-10-24",
                "heure_consult": "12:30:00",
                "duree_consult": 45,
                "nom_usager": "Dumond",
                "nom_medecin": "Latecoere"
            }
        ]
    }
    ```
    

### `GET /consultations/<id>`

Retourne la consultation d’identifiant id.

### Paramètres

- `id`: L’ID de la consultation à récupérer.

### Réponse

Retourne un objet JSON avec les propriétés suivantes :

- `status_code` : Le statut du résultat de la requête
- `status_message` : Le message du statut du résultat de la requête
- `data` : Un tableau de données contenant les propriétés suivantes :
    - `id_consult`: L’identifiant unique de la consultation
    - `id_medecin` : L’identifiant unique du médecin
    - `id_usager` : L’identifiant unique de l’usager
    - `date_consult` : La date de la consultation
    - `heure_consult` : L’heure de la consultation
    - `duree_consult`: La durée de la consultation
    - `nom_usager`: Le nom de l’usager
    - `nom_medecin` : Le nom du médecin

### Exemple

Requête :

```php
GET /consultations/1
```

Réponse :

```json
{
    "status_code": 200,
    "status_message": "OK (récupération consultation(s))",
    "data": [
        {
            "id_consult": 1,
            "id_medecin": 3,
            "id_usager": 10,
            "date_consult": "2024-10-24",
            "heure_consult": "11:30:00",
            "duree_consult": 30,
            "nom_usager": "Delamer",
            "nom_medecin": "Mermoz"
        }
		]
}
```

### `POST /consultations`

Crée une consultation.

### Réponse

Retourne un objet JSON avec les propriétés suivantes :

- `status_code` : Le statut du résultat de la requête
- `status_message` : Le message du statut du résultat de la requête
- `data` : Un tableau de données contenant les propriétés suivantes :
    - `id_consult`: L’identifiant unique de la consultation créée

### Exemple

Requête :

```php
POST /consultations
```

Body :

```json
{
	"id_medecin" : 1,
	"id_usager" : 1,
	"date_consult" : "2024-07-01",
  "heure_consult": "09:30:00",
	"duree_consult" : 45
}
```

Réponse :

```json
{
    "status_code": 201,
    "status_message": "Consultation créée",
    "data": "3"
}
```

### `PATCH /consultations/<id>`

Modifie la consultation d’identifiant id.

### Paramètres

- `id`: L’ID de la consultation à modifier.

### Réponse

Retourne un objet JSON avec les propriétés suivantes :

- `status_code` : Le statut du résultat de la requête
- `status_message` : Le message du statut du résultat de la requête
- `data` : Un tableau de données contenant les propriétés suivantes :
    - `id_consult`: L’identifiant unique de la consultation modifiée
    - `date_consult` : La date de la consultation modifiée
    - `heure_consult`: L’heure de la consultation modifiée
    - `duree_consult`: La durée de la consultation modifiée
    - `id_medecin`: L’identifiant du médecin
    - `id_usager` : L’identifiant de l’usager

### Exemple

Requête :

```php
PATCH /consultations/3
```

Body :

```json
{
    "id_usager":"16",
    "id_medecin":"11",
    "date_consult":"12/10/26",
    "heure_consult":"12:30",
    "duree_consult":"45"
}
```

Réponse :

```json
{
  "status_code": 200,
  "status_message": "Consultation modifiée",
  "data": {
    "id_consult": 26,
    "date_consult": "2012-10-26",
    "heure_consult": "12:30:00",
    "duree_consult": 45,
    "id_medecin": 11,
    "id_usager": 16
  }
}
```

### `DELETE /consultations/<id>`

Supprime la consultation d’identifiant id.

### Paramètres

- `id`: L’ID de la consultation à supprimer.

### Réponse

Retourne un objet JSON avec les propriétés suivantes :

- `status_code` : Le statut du résultat de la requête
- `status_message` : Le message du statut du résultat de la requête
- `data` : Un tableau de données contenant les propriétés suivantes :
    - `id_medecin`: L’identifiant unique de la consultation supprimée

### Exemple

Requête :

```php
DELETE /consultation/3
```

Réponse :

```json
{
    "status_code": 200,
    "status_message": "Consultation supprimée",
    "data": "3"
}
```

---

- **Pour les statistiques**
    
    ### `GET /stats/usagers`
    
    Retourne la liste des statistiques des usagers.
    
    ### Réponse
    
    Retourne un objet JSON avec les propriétés suivantes :
    
    - `status_code` : Le statut du résultat de la requête
    - `status_message` : Le message du statut du résultat de la requête
    - `data` : Un tableau de données contenant les propriétés suivantes :
        - `NbFemmesMoins25Ans`: Le nombre de femmes ayant moins de 25 ans
        - `NbFemmesMilieu` : Le nombre de femmes âgées entre 25 et 50 ans
        - `NbFemmesPlus50Ans` : Le nombre de femmes ayant plus de 50 ans
        - `NbHommesMoins25Ans` : Le nombre d’hommes ayant moins de 25 ans
        - `NbHommesMilieu` : Le nombre d’hommes âgées entre 25 et 50 ans
        - `NbHommesPlus50Ans` : Le nombre d’hommes ayant plus de 50 ans
    
    ### Exemple
    
    Requête :
    
    ```php
    GET /stats/usagers
    ```
    
    Réponse :
    
    ```json
    {
      "status_code": 200,
      "status_message": "OK",
      "data": {
        "NbFemmesMoins25Ans": [
          {
            "NbFemmesMoins25ans": 0
          }
        ],
        "NbFemmesMilieu": [
          {
            "NbFemmesMilieu": 1
          }
        ],
        "NbFemmesPlus50Ans": [
          {
            "NbFemmesPlus50ans": 1
          }
        ],
        "NbHommesMoins25Ans": [
          {
            "NbHommesMoins25ans": 0
          }
        ],
        "NbHommesMilieu": [
          {
            "NbHommesMilieu": 0
          }
        ],
        "NbHommesPlus50Ans": [
          {
            "NbHommesPlus50ans": 2
          }
        ]
      }
    }
    
    ```
    
    ### `GET /stats/médecins`
    
    Retourne la liste des statistiques des médecins.
    
    ### Réponse
    
    Retourne un objet JSON avec les propriétés suivantes :
    
    - `status_code` : Le statut du résultat de la requête
    - `status_message` : Le message du statut du résultat de la requête
    - `data` : Un tableau de données contenant les propriétés suivantes :
        - `NbHeures`: Le nombre total d’heures réalisé par le médecin
        - `NomMedecin`: Le nom du médecin concerné
    
    ### Exemple
    
    Requête :
    
    ```php
    GET /stats/medecins
    ```
    
    Réponse :
    
    ```json
    {
      "status_code": 200,
      "status_message": "OK",
      "data": [
        {
          "NbHeures": "0.5000",
          "NomMedecin": "Durand"
        },
        {
          "NbHeures": "0.7500",
          "NomMedecin": "Pierre"
        }
      ]
    }
    
    ```
    

## Erreurs

Cette API peut renvoyer les erreurs suivantes :

- `405 Bad Request`: La méthode n’est pas autorisée.
- `401 Unauthorized`: Une condition permettant d’avoir accès aux données n’est pas remplie.
- `404 Not Found`: La ressource de la requête est introuvable.
- `500 Internal Server Error`: Une erreur inattendue s’est produite dans le serveur.