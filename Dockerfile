# Use an official PHP image with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install required PHP extensions (you can customize this)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy app files into container
COPY ./app/ /var/www/html/

# Set proper permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 (Apache)
EXPOSE 80
