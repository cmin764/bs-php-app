# Use an official PHP image with Apache
FROM php:8.1-apache

# Set the default environment variable for PORT in case it's not set by Heroku
ENV PORT 80
# Copy Apache config
COPY config/ports.conf /etc/apache2/ports.conf
# Ensure the Apache config listens to the $PORT environment variable (set by Heroku randomly)
RUN sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
# Allow .htaccess files to override Apache settings
RUN a2enmod rewrite

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copy application files
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html/

# Expose port
EXPOSE ${PORT}
