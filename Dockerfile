# Stage 1: Build frontend (Vite)
FROM node:20-alpine AS frontend

WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: PHP & Laravel
FROM php:8.2-fpm-alpine AS backend

# Install PHP extensions
RUN apk add --no-cache \
    bash git curl zip unzip libpng-dev libjpeg-turbo-dev libwebp-dev libxpm-dev \
    oniguruma-dev libxml2-dev icu-dev libzip-dev freetype-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd intl zip

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Set working dir
WORKDIR /var/www/html

# Copy source code
COPY . .

# Copy built frontend
COPY --from=frontend /app/public/build ./public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Laravel optimize commands
RUN php artisan storage:link || true \
    && php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan config:cache

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
