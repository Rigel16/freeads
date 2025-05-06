#!/bin/bash

# Vérifier si .env existe
if [ ! -f .env ]; then
  echo "Création du fichier .env à partir de .env.example"
  cp .env.example .env
fi

# S'assurer que la configuration utilise MySQL (en fonction des variables d'environnement)
echo "Configuration de la base de données MySQL"
sed -i "s/^DB_CONNECTION=.*/DB_CONNECTION=mysql/" .env
sed -i "s/^DB_HOST=.*/DB_HOST=${DB_HOST}/" .env  # Utilisation de la variable d'environnement DB_HOST
sed -i "s/^DB_PORT=.*/DB_PORT=${DB_PORT:-3306}/" .env  # Valeur par défaut pour le port si non définie
sed -i "s/^DB_DATABASE=.*/DB_DATABASE=${DB_DATABASE}/" .env
sed -i "s/^DB_USERNAME=.*/DB_USERNAME=${DB_USERNAME}/" .env
sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/" .env

# Vérifier et définir APP_KEY si non existant
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
# Ajout d'un délai d'attente avant la connexion à la base de données pour éviter les erreurs de connexion
until php artisan migrate:status --force; do
    echo "En attente de la base de données..."
    sleep 5
done

echo "Connexion à la base de données réussie, exécution des migrations..."
php artisan migrate --force

# Démarrage du serveur en utilisant le port défini par Render
echo "Démarrage du serveur sur le port ${PORT}"
php artisan serve --host=0.0.0.0 --port=${PORT}
