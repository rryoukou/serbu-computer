FROM php:8.2-cli-alpine

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apk add --no-cache \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    oniguruma-dev \
    icu-dev \
    libzip-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www/html

# Install dependencies (termasuk dev karena Laravel Pail dibutuhkan di runtime oleh script tertentu)
RUN composer install --no-interaction --optimize-autoloader


# Set permissions (still useful for internal files)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# USER www-data # Commented out to avoid permission issues with host-mounted volumes

# Expose the port laravel will run on
EXPOSE 8001

# Run Laravel built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8001"]

