#!/bin/bash

# Vérifier si .env existe
if [ ! -f .env ]; then
  echo "Création du fichier .env à partir de .env.example"
  cp .env.example .env
fi

# S'assurer que la configuration utilise MySQL
echo "Configuration de la base de données MySQL"
sed -i "s/DB_CONNECTION=.*/DB_CONNECTION=mysql/" .env
grep -q "DB_HOST=" .env || echo "DB_HOST=${DB_HOST:-mysql}" >> .env
grep -q "DB_PORT=" .env || echo "DB_PORT=${DB_PORT:-3306}" >> .env
grep -q "DB_DATABASE=" .env || echo "DB_DATABASE=${DB_DATABASE:-laravel}" >> .env
grep -q "DB_USERNAME=" .env || echo "DB_USERNAME=${DB_USERNAME:-sail}" >> .env
grep -q "DB_PASSWORD=" .env || echo "DB_PASSWORD=${DB_PASSWORD:-password}" >> .env

# Vérifier et définir APP_KEY
if ! grep -q "APP_KEY=base64:" .env; then
  echo "Génération de la clé d'application"
  php artisan key:generate --force
fi

# Vérification des permissions des répertoires critiques
echo "Vérification des permissions des répertoires critiques"
chmod -R 775 storage bootstrap/cache

# Optimisation pour la production
echo "Optimisation des caches de configuration"
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "Recréation des caches optimisés"
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Tentative de connexion à la base de données et d'exécution des migrations
echo "Test de connexion à la base de données..."
if php artisan migrate:status --force; then
    echo "Connexion à la base de données réussie, exécution des migrations..."
    php artisan migrate --force
else
    echo "ERREUR: Impossible de se connecter à la base de données MySQL."
    echo "Vérifiez les variables d'environnement DB_* sur Render."
    echo "Démarrage du serveur quand même mais l'application pourrait ne pas fonctionner correctement."
fi

# Démarrage du serveur en utilisant le port défini par Render
echo "Démarrage du serveur sur le port ${PORT}"
php artisan serve --host=0.0.0.0 --port=${PORT}