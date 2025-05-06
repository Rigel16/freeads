FROM laravelsail/php83-composer

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