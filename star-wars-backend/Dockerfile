FROM php:8.4-fpm

RUN apt-get update && apt-get install -y git unzip curl libpq-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN pecl install redis \
    && docker-php-ext-enable redis


WORKDIR /var/www/html

COPY . .

RUN [ ! -d vendor ] && composer install || true

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 777 storage bootstrap/cache

EXPOSE 9000

CMD php artisan migrate --force && php-fpm
