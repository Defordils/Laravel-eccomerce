#!/bin/bash

# Laravel Ecommerce Deployment Script

echo "Starting deployment..."

# Pull latest changes
git pull origin main

# Install/update composer dependencies
composer install --no-dev --optimize-autoloader

# Install/update npm dependencies
npm install
npm run build

# Run database migrations
php artisan migrate --force

# Clear and cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set proper permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Restart services
sudo systemctl restart nginx
sudo systemctl restart php8.2-fpm

echo "Deployment completed successfully!"
