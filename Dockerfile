FROM php:7.4-apache

WORKDIR /var/www/html

COPY . .

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip

RUN docker-php-ext-install pdo pdo_mysql zip

RUN a2enmod rewrite



# Add the following line to set the DocumentRoot
# This assumes that your Laravel app is in the 'laravel' folder
# Adjust the path accordingly based on your project structure
RUN sed -i -e 's|/var/www/html|/var/www/html/taskReviewApi/public|g' /etc/apache2/sites-available/000-default.conf


CMD ["apache2-foreground"]
