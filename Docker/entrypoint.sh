#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-interaction --no-progress
fi

if [ ! -f ".env" ]; then
    echo "Creating .env file"
    cp .env.example .env
else
    echo ".env file already exists"
fi

role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then
    php artisan key:generate
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear

    php artisan serve --port=$PORT --host=0.0.0.0 --env=.env
elif [ "$role" = "queue" ]; then
    echo "Running the queue"
    php /var/www/artisan queue:work --verbose --tries=3 --timeout=100
elif [ "$role" = "websocket" ]; then
    echo "Running the websocket"
    php artisan websockets:serve
fi



exec docker-php-entrypoint "$@"