# Utiliser l'image PHP + Nginx
FROM webdevops/php-nginx:8.3-alpine

# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers de l'application dans le conteneur
COPY . .

# Installer les dépendances PHP avec Composer (en incluant les dépendances de dev)
RUN composer install --optimize-autoloader

# Configurer les permissions pour Laravel
RUN chown -R application:application /app \
    && chmod -R 775 /app/storage /app/bootstrap/cache

# Exposer le port Nginx
EXPOSE 80
