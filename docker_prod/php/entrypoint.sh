#!/bin/sh
set -e

echo "Waiting for database connection..."
while ! mysql -h db -u"${DB_USERNAME}" -p"${DB_PASSWORD}" -e "SELECT 1" >/dev/null 2>&1; do
    sleep 1
done

php artisan migrate --force
php artisan db:seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec docker-php-entrypoint php-fpm