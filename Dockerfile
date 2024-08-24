# Use an official PHP image from the Docker Hub
FROM php:8.0-apache

# Install necessary PHP extensions and other dependencies
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite (important for many PHP frameworks)
RUN a2enmod rewrite

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Install Composer (PHP package manager)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install project dependencies using Composer
RUN composer install

# Set environment variables (OPTIONAL: If you prefer not to use .env)
ENV APP_NAME=YourAppName
ENV ZENOPAY_SECRET_KEY=your_zenopay_secret_key
ENV DB_HOST=external-db-host.com
ENV DB_USER=your_database_user
ENV DB_PASS=your_database_password
ENV DB_NAME=your_database_name
ENV DB_PORT=3306

# Expose the port Apache is listening on
EXPOSE 8080

# Start Apache in the foreground
CMD ["apache2-foreground"]
