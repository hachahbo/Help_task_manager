FROM php:8.2-fpm

# Install PDO MySQL extension
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql

# Optional: Install Composer (for Laravel dependencies)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /usr/share/nginx/html
