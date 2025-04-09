FROM php:8.2-fpm

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip unzip \
    git curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www

# Instala dependências do Laravel
COPY . /var/www
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Permissões
RUN chown -R www-data:www-data /var/www

CMD php artisan serve --host=0.0.0.0 --port=8000
