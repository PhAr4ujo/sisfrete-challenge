#!/bin/bash
set -e

echo "Waiting for available database..."
until nc -z -v -w30 db 3306; do
  echo "Waiting for database..."
  sleep 5
done

if [ ! -f .env ]; then
    cp .env.example .env
fi

if [ ! -f storage/oauth-private.key ]; then
    php artisan key:generate
fi

php artisan config:clear
php artisan migrate --seed --force
php artisan l5-swagger:generate

exec apache2-foreground
