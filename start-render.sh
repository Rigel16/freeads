#!/bin/bash

# Vérifier si .env existe
if [ ! -f .env ]; then
  echo "Création du fichier .env à partir de .env.example"
  cp .env.example .env
fi

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
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Démarrage du serveur en utilisant le port défini par Render
echo "Démarrage du serveur sur le port ${PORT}"
php artisan serve --host=0.0.0.0 --port=${PORT}