# Mini-guide technique — Skeleton Honey Group

## 1. Structure du projet

```
skeleton/
├── index.php              → Page d'accueil (assemble les composants)
├── css/style.css          → Styles + responsive (variables CSS en haut du fichier)
├── js/script.js           → Menu burger + validation du formulaire
├── images/                → Logos, photos, icônes
└── includes/
    ├── header.php         → Barre de navigation réutilisable
    ├── footer.php         → Pied de page réutilisable
    └── contact-handler.php→ Validation serveur du formulaire de contact
```

## 2. Lancer le projet en local (XAMPP)

1. Copier le dossier `skeleton/` dans `C:\xampp\htdocs\` (Windows) ou `/opt/lampp/htdocs/` (Linux).
2. Démarrer Apache dans le panneau de contrôle XAMPP.
3. Ouvrir `http://localhost/skeleton/` dans le navigateur.

## 3. Créer une nouvelle page

Copier ce squelette minimal et l'adapter :

```php
<?php require 'includes/contact-handler.php'; // si besoin ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma nouvelle page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- Votre contenu ici -->

    <?php include 'includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>
```

## 4. Ajouter une nouvelle section

Réutiliser les classes CSS existantes pour rester cohérent :
- `.section` pour l'espacement vertical standard
- `.card-grid` + `.card` pour une grille de blocs (services, produits...)
- `.contact-form` pour tout nouveau formulaire

## 5. Personnaliser les couleurs

Modifier les variables en haut de `css/style.css` :

```css
:root {
    --color-primary: #1f7a5c;
    --color-secondary: #f5a623;
}
```

## 6. Phase 2 — Base de données MySQL (déjà en place)

Le squelette inclut désormais la connexion et un CRUD complet :

```
sql/schema.sql              → Script de création de la base + tables (items, messages)
includes/db.php             → Connexion PDO sécurisée (requêtes préparées)
includes/items-handler.php  → Fonctions CRUD complètes (create, read, update, delete)
items.php                   → Page de démonstration : liste, ajoute, modifie, supprime des éléments
```

### Mise en place

1. Ouvrir phpMyAdmin (`http://localhost/phpmyadmin`) et importer `sql/schema.sql`,
   ou en ligne de commande : `mysql -u root -p < sql/schema.sql`.
2. Vérifier/adapter les identifiants dans `includes/db.php` (`DB_HOST`, `DB_NAME`,
   `DB_USER`, `DB_PASS`) selon ta configuration XAMPP.
3. Ouvrir `http://localhost/skeleton/items.php` pour tester l'ajout et la suppression.

Le formulaire de contact (`index.php`) enregistre désormais aussi chaque message
dans la table `messages`.

### Sécurité déjà appliquée

- Requêtes **préparées** partout (`PDO::prepare`) → protection anti-injection SQL.
- `EMULATE_PREPARES` désactivé pour forcer de vraies requêtes préparées côté MySQL.
- Toutes les entrées utilisateur sont nettoyées (`filter_var`) et échappées à
  l'affichage (`htmlspecialchars`) → protection anti-XSS.
- Validation des types (`FILTER_VALIDATE_FLOAT`, `FILTER_VALIDATE_EMAIL`).

### Pour aller plus loin

- Ajouter une pagination si la liste d'éléments devient longue.
- Déplacer les identifiants de `db.php` et `mailer.php` dans un fichier `.env` non versionné, pour ne jamais exposer de mots de passe dans le code source partagé.

## 7. Bonnes pratiques à conserver

- Un composant réutilisable par fichier dans `/includes`.
- Toujours valider les entrées utilisateur côté serveur, même si le JS valide déjà.
- Respecter le nommage : `kebab-case` pour les fichiers, `camelCase` pour le JS.
