FROM php:7.4-fpm-alpine

WORKDIR /var/www/html

RUN chown -R $USER:www-data storage
RUN chown -R $USER:www-data bootstrap/cache
RUN chown -R 775 storage
RUN chown -R 775 bootstrap/cache

RUN docker-php-ext-install pdo pdo_mysql
