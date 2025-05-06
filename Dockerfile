FROM laravelsail/php83-composer

# Installe les extensions PHP nécessaires (dont pdo_mysql)
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
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

COPY . .

# Installation des dépendances et optimisation
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && mkdir -p storage/framework/sessions \
    && mkdir -p storage/framework/views \
    && mkdir -p storage/framework/cache \
    && chmod -R 775 storage bootstrap/cache

# Variable d'environnement pour le port (compatible avec Render)
ENV PORT=8000

# Script de démarrage
COPY start-render.sh /usr/local/bin/start-render.sh
RUN chmod +x /usr/local/bin/start-render.sh

EXPOSE 8000

CMD ["/usr/local/bin/start-render.sh"]
