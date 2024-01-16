FROM php:8.3.1 as php

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
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Set Working Directory
WORKDIR /var/www/html

# Copy Project Files
COPY . .

# Install Composer dependencies
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY  --from=composer:2.6.6 /usr/bin/composer /usr/bin/composer
# RUN composer install

# ENTRYPOINT [ "Docker/entrypoint.sh" ]
