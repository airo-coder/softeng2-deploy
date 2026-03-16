#!/bin/bash

# Clear caches
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan view:clear

# Cache for production
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache

# Run database migrations
php artisan migrate --force

# Start Apache in foreground
apache2-foreground
