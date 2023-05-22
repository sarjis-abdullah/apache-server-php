FROM php:8.1-apache

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project files to the container
COPY . /var/www/html

# Set up Apache document root
RUN chown -R www-data:www-data /var/www/html
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80
