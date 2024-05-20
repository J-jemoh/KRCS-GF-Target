# Use the official PHP image as the base image
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache modules
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set DocumentRoot
RUN sed -i -e 's/\/var\/www\/html/\/var\/www/' /etc/apache2/sites-available/*.conf

# Copy the existing application directory contents
COPY . .

# Copy the existing application directory permissions
COPY --chown=www-data:www-data . .

# Expose port 80 and start Apache server
EXPOSE 9000
CMD ["apache2-foreground"]
