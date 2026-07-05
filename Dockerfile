# ============================================================================
# ETAPE 1 - Build des assets front-end
# ============================================================================
# Cette premiere image ne sert qu'a compiler les fichiers CSS/JS avec Vite.
# Elle ne sera pas lancee en production : on copiera seulement le resultat
# final depuis public/build dans l'image PHP.
FROM node:20-alpine AS assets

WORKDIR /app

# On copie d'abord les fichiers de dependances et de configuration front-end.
# postcss.config.js active Tailwind/Autoprefixer pendant le build.
# tailwind.config.js indique a Tailwind quelles vues scanner pour generer
# les classes CSS utilisees par le site.
COPY package.json package-lock.json vite.config.js postcss.config.js tailwind.config.js ./
RUN npm ci

# Sources front-end utilisees par Vite/Tailwind/Bootstrap.
COPY resources/ resources/

# Tailwind doit voir les fichiers Blade pour conserver les classes utilisees.
# Sans ces vues, le CSS produit dans Docker peut etre different du local.
COPY resources/views/ resources/views/

# Genere les fichiers minifies dans public/build.
RUN npm run build

# ============================================================================
# ETAPE 2 - Image finale Laravel + PHP-FPM + Nginx
# ============================================================================
# C'est cette image que Render va lancer. Elle contient PHP, Composer, Nginx,
# Supervisor et le code Laravel pret pour la production.
FROM php:8.4-fpm-alpine

# Installe les paquets systeme et les extensions PHP necessaires :
# - nginx : serveur HTTP public
# - supervisor : lance nginx et php-fpm dans le meme conteneur
# - postgresql-dev + pdo_pgsql : connexion PostgreSQL Render
# - zip/libzip : requis par plusieurs packages Composer/Laravel
# - opcache : acceleration PHP en production
RUN apk add --no-cache \
    bash \
    nginx \
    supervisor \
    postgresql-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql zip opcache

# Recupere Composer depuis l'image officielle Composer.
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Meme logique de cache que pour npm : on installe les dependances PHP avant
# de copier tout le projet, afin d'eviter de relancer composer install a
# chaque petite modification du code.
COPY composer.json composer.lock ./

# --no-dev retire les packages de developpement.
# --optimize-autoloader accelere le chargement des classes en production.
# --no-scripts evite d'executer des commandes Laravel avant que tout le code
# du projet soit copie dans l'image.
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copie le reste du projet Laravel dans l'image.
COPY . .

# Recupere uniquement le resultat compile par Vite depuis l'etape Node.
COPY --from=assets /app/public/build ./public/build

# Laravel doit pouvoir ecrire dans storage et bootstrap/cache.
# www-data est l'utilisateur utilise par PHP-FPM dans l'image officielle PHP.
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Configuration du serveur HTTP.
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Configuration PHP et OPcache.
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini

# Configuration de Supervisor, qui garde Nginx et PHP-FPM actifs.
COPY docker/supervisord.conf /etc/supervisord.conf

# Script execute au demarrage du conteneur.
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

# Render fournit un port via la variable PORT. On expose 10000 comme valeur
# par defaut locale, puis start.sh remplace le port Nginx au demarrage.
EXPOSE 10000

# Lance le script de demarrage.
CMD ["/start.sh"]
