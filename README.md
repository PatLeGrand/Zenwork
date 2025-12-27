# Facebook Clone - Réseau Social

Projet de réseau social développé avec PHP, PostgreSQL, Tailwind CSS et HTMX.

## Stack Technique

- **Backend**: PHP 8.3 + PostgreSQL 16
- **Frontend**: HTML + Tailwind CSS + HTMX
- **Architecture**: MVC orienté objet
- **Containerisation**: Docker + Docker Compose

## Structure du Projet

```
facebook-clone/
├── docker-compose.yml      # Configuration Docker
├── Dockerfile              # Image PHP personnalisée
├── public/                 # Point d'entrée public
│   └── index.php
├── app/
│   ├── db/                 # Connexion base de données
│   ├── models/             # Classes des entités (User, Post, etc.)
│   ├── controllers/        # Logique métier
│   ├── components/         # Composants réutilisables (header, footer)
│   ├── utils/              # Fonctions utilitaires
│   └── partials/           # Fragments HTML pour HTMX
├── views/                  # Templates des pages
└── assets/                 # Ressources statiques
    ├── css/
    ├── js/
    └── images/
```

## Installation et Démarrage

### Prérequis
- Docker et Docker Compose installés

### Commandes

```bash
# Démarrer tous les services
docker-compose up -d --build

# Vérifier que les containers tournent
docker-compose ps

# Voir les logs
docker-compose logs -f

# Arrêter les services
docker-compose down

# Arrêter et supprimer les données (base de données)
docker-compose down -v
```

## URLs d'accès

- **Application**: http://localhost:8080
- **pgAdmin**: http://localhost:5050
  - Email: admin@admin.com
  - Password: admin

## Commandes Utiles

```bash
# Entrer dans le container web (PHP)
docker-compose exec web bash

# Entrer dans le container node (pour Tailwind)
docker-compose exec node sh

# Exécuter des commandes PHP
docker-compose exec web php -v

# Accéder à PostgreSQL
docker-compose exec db psql -U postgres -d facebook_db

# Installer des dépendances Composer
docker-compose exec web composer install

# Installer Tailwind (dans le container node)
docker-compose exec node npm install -D tailwindcss
```

## Roadmap du Projet

### Phase 1 - MVP
- [ ] Système d'authentification
- [ ] Profils utilisateurs basiques
- [ ] Publication de posts textuels
- [ ] Fil d'actualité

### Phase 2 - Interactions Sociales
- [ ] Système d'amis
- [ ] Likes (AJAX/HTMX)
- [ ] Commentaires
- [ ] Fil personnalisé

### Phase 3 - Enrichissement
- [ ] Upload d'images
- [ ] Notifications
- [ ] Recherche d'utilisateurs
- [ ] Page profil détaillée

### Phase 4 - Avancé
- [ ] Messagerie privée
- [ ] Partage de posts
- [ ] Groupes
- [ ] Stories

## Configuration Base de Données

Les variables d'environnement sont définies dans `docker-compose.yml`:
- DB_HOST: db
- DB_PORT: 5432
- DB_NAME: facebook_db
- DB_USER: postgres
- DB_PASSWORD: postgres

## Bonnes Pratiques

- Commit régulièrement sur Git
- Tester chaque feature isolément
- Utiliser var_dump() et error_log() pour débugger
- Lire la documentation officielle
- Commencer petit, itérer progressivement

## Ressources

- PHP: https://www.php.net/
- PostgreSQL: https://www.postgresql.org/docs/
- Tailwind: https://tailwindcss.com/docs
- HTMX: https://htmx.org/docs

---

Bon développement ! 🚀
