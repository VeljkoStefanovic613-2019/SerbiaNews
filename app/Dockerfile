FROM php:7-fpm-alpine

# Update system core
RUN apt update -y && apt upgrade -y
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Start PHP-FPM
CMD ["php-fpm"]