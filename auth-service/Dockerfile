# Usa una imagen base oficial de PHP 8.2 con Apache
FROM php:8.2-apache

# Instala dependencias del sistema necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Instala Composer (gestor de dependencias de PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configura el directorio de trabajo y el host virtual de Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
WORKDIR /var/www/html

ENTRYPOINT ["/bin/sh", "-c", "chown -R www-data:www-data /var/www/html && php artisan migrate --force && apache2-foreground"]