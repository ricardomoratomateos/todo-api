FROM php:7.2-fpm-alpine

COPY . .

RUN rm -rf /var/www/html/logs/* \
    && chown -R www-data:www-data /var/www/html

RUN docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_mysql
