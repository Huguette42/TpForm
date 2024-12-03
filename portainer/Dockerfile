FROM webdevops/php-nginx:8.3-alpine
# Installation dans votre Image du minimum pour que Docker fonctionne
RUN apk add oniguruma-dev libxml2-dev
RUN docker-php-ext-install \
        bcmath \
        ctype \
        fileinfo \
        mbstring \
        pdo_mysql \
        xml
# Installation dans votre image de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# Installation dans votre image de NodeJS
RUN apk add nodejs npm
ENV WEB_DOCUMENT_ROOT /app
ENV APP_ENV production
WORKDIR /app
COPY . .
# On copie le fichier .env.example pour le renommer en .env
# Vous pouvez modifier le .env.example pour indiquer la configuration de votre site pour la production
RUN cp -n .env.example .env
# Installation et configuration de votre site pour la production
# https://laravel.com/docs/10.x/deployment#optimizing-configuration-loading
RUN composer install
RUN chown -R application:application .
