# IAFRATE_THOMAS_API

## Description du Projet

IAFRATE_THOMAS_API est reprit d'une API crée pour un ancien projet.
Je suis reparti de ce projet pour créer un login sécurisé avec des requêtes POST.
Il contient de nombreuses fonctionnalités.

## Fonctionnalités

- **Inscription (SignUp)**
- **Connexion (SignIn)**
- **Changement de mot de passe (ChangePwd)**
- **Vérification de l'état de connexion (SignedIn)**
- **Déconnexion (Logout)**
- **Protection contre les attaques par force brute**
- **Déconnexion automatique après une période d'inactivité**


## URLs et Exemples de Requêtes

### Inscription (SignUp)
- **Exemple URL :** `http://localhost/IAFRATE_THOMAS_API/public/signup.php?username=coucou&password=Coucou1!&verifpassword=Coucou1!`

### Connexion (SignIn)
- **URL :** `http://localhost/IAFRATE_THOMAS_API/public/signin.php?username=coucou&password=Coucou1!`

### Changement de mot de passe (ChangePwd)
- **URL :** `http://localhost/IAFRATE_THOMAS_API/public/changepwd.php?oldPassword=test&newPassword=test2`

### Vérification de l'état de connexion (SignedIn)
- **URL :** `http://localhost/IAFRATE_THOMAS_API/public/signedin.php?username=coucou&password=Coucou1!`

### Déconnexion (Logout)
- **URL :** `http://localhost/IAFRATE_THOMAS_API/public/logout.php`

## Protection contre les attaques par force brute

- **Nombre maximum de tentatives :** 5
- **Durée de blocage après les tentatives échouées :** 30 minutes


