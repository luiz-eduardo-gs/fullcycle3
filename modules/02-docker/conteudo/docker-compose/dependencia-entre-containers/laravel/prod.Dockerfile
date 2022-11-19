FROM php:7.4-cli as stage

RUN apt-get update && \
    apt-get install -y libzip-dev && \
    docker-php-ext-install zip

WORKDIR /var/www

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

RUN composer create-project laravel/laravel laravel

FROM php:7.4-fpm-alpine
WORKDIR /var/www
RUN rm -rf /var/www/html
COPY --from=stage /var/www/laravel .
RUN chown -R www-data:www-data /var/www
RUN ln -s public html
EXPOSE 9000
CMD [ "php-fpm" ]