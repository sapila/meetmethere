FROM php:7.2-fpm

LABEL maintainer="ngkogktzilas@hoymail.com"
LABEL description="PHP-FPM 7.2"

RUN apt-get update && apt-get install -y --no-install-recommends apt-utils

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libxml2-dev \
    libmcrypt-dev \
    unzip \
    curl


# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip bcmath json ctype xml tokenizer

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Folder permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]