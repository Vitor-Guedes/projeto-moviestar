FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    unzip

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install -j$(nproc) gd zip 

# install mongodb ext
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer clearcache

RUN composer install --no-scripts --no-dev --no-interaction --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Adjusting Apache configurations
RUN a2enmod rewrite
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Define the entry point for the container
CMD ["apache2-foreground"]