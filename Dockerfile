FROM php:7.4-apache

WORKDIR /var/www/html

COPY . .

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip

RUN docker-php-ext-install pdo pdo_mysql zip

RUN a2enmod rewrite

CMD ["apache2-foreground"]
