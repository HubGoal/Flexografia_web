FROM php:8.2-fpm
RUN docker-php-ext-install pdo pdo_mysql
COPY . /var/www/html

COPY . /usr/share/nginx/html/

EXPOSE 80

