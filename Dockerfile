FROM php:8.3.1-fpm

# Install PHP Dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP Extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set Working Directory
WORKDIR /var/www/html

# Copy Project Files
COPY . /var/www/html

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# Expose port 9000 for FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
