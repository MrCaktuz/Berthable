FROM php:8.4-fpm-alpine

# Install required dependencies for GD and other PHP extensions
RUN apk add --no-cache freetype-dev libpng-dev libjpeg-turbo-dev libwebp-dev zlib-dev

# Install GD extension
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd

# Install MySQL extensions
RUN docker-php-ext-install mysqli pdo_mysql && docker-php-ext-enable pdo_mysql

# Install WP CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x wp-cli.phar && mv wp-cli.phar /usr/local/bin/wp