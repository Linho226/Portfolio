#!/usr/bin/env sh

# Arrete le script si une commande critique echoue.
set -e

cd /var/www/html

# Render fournit le port HTTP dans la variable PORT.
# Si elle n'existe pas en local, on utilise 10000.
PORT="${PORT:-10000}"

# Nginx ne lit pas directement les variables d'environnement dans listen.
# On remplace donc le placeholder __PORT__ au demarrage du conteneur.
sed -i "s/__PORT__/${PORT}/g" /etc/nginx/nginx.conf

# S'assure que les dossiers d'ecriture Laravel existent dans l'image.
mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache

# PHP-FPM doit pouvoir ecrire les sessions, vues compilees, caches et logs.
chown -R www-data:www-data storage bootstrap/cache

# Nettoie les caches potentiellement crees pendant le build ou un ancien run.
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Lance les migrations au demarrage par defaut.
# Sur Render, tu peux mettre RUN_MIGRATIONS=false si tu veux les lancer
# manuellement depuis un job/commande separee.
if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    php artisan migrate --force
fi

# Cree le lien public/storage -> storage/app/public.
# Le "|| true" evite d'echouer si le lien existe deja.
php artisan storage:link || true

# Optimisations Laravel pour la production.
php artisan config:cache

# Certaines applications ont des routes en closure qui ne sont pas cachables.
# Dans ce cas, on continue quand meme le demarrage.
php artisan route:cache || true
php artisan view:cache

# Lance Supervisor, qui demarre ensuite Nginx et PHP-FPM.
exec /usr/bin/supervisord -c /etc/supervisord.conf
