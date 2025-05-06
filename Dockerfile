FROM laravelsail/php83-composer

# Mise à jour des paquets et installation des extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*  # Nettoyer les caches après installation pour réduire la taille de l'image

WORKDIR /var/www/html

# Copier les fichiers composer.json et composer.lock pour optimiser le cache des dépendances
COPY composer.json composer.lock ./

# Installation des dépendances Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copier le reste des fichiers de l'application
COPY . .

# Créer les répertoires nécessaires et définir les permissions
RUN mkdir -p storage/framework/sessions \
    && mkdir -p storage/framework/views \
    && mkdir -p storage/framework/cache \
    && chmod -R 775 storage bootstrap/cache

# Définir la variable d'environnement pour le port (compatible avec Render)
ENV PORT=8000

# Script de démarrage
COPY start-render.sh /usr/local/bin/start-render.sh
RUN chmod +x /usr/local/bin/start-render.sh

# Exposer le port que Laravel va utiliser
EXPOSE 8000

# Démarrer le script de démarrage
CMD ["/usr/local/bin/start-render.sh"]
