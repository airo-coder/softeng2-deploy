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
# Create storage symlink for uploaded images
php artisan storage:link

# Start Apache in foreground
chmod -R 777 /var/www/html/storage
apache2-foreground
