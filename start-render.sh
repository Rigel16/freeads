#!/bin/bash

# Créer un fichier .env si absent
if [ ! -f .env ]; then
  echo "Création du fichier .env"
  cat <<EOF > .env
APP_NAME=Laravel
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://your-app-on-render.com

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US
APP_MAINTENANCE_DRIVER=file

PHP_CLI_SERVER_WORKERS=4
BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=yamabiko.proxy.rlwy.net
DB_PORT=27830
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=LpRxSuHGCNAFQiDSazhcSgVrYUXxzjLy

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=noreplytwiter16@gmail.com
MAIL_PASSWORD=guxozpixxncvbjwn
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreplytwiter16@gmail.com
MAIL_FROM_NAME="Laravel"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="Laravel"

SCOUT_DRIVER=meilisearch
MEILISEARCH_HOST=http://meilisearch:7700
MEILISEARCH_NO_ANALYTICS=false
EOF
fi

# Générer la clé si manquante
if ! grep -q "^APP_KEY=base64:" .env; then
  echo "Génération de la clé d'application..."
  php artisan key:generate --force
fi

# Permissions nécessaires
echo "Permissions..."
chmod -R 775 storage bootstrap/cache

# Optimisation Laravel
echo "Nettoyage du cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "Recréation des caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Attente que la DB soit dispo
echo "Connexion à la base de données..."
until php artisan migrate:status --force; do
    echo "En attente de la base de données..."
    sleep 5
done

echo "Exécution des migrations..."
php artisan migrate --force

# Lancer le serveur
echo "Lancement de Laravel sur le port ${PORT}"
php artisan serve --host=0.0.0.0 --port=${PORT}
