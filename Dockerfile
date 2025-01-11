FROM php:8.3-fpm-alpine

RUN apk add --no-cache supervisor curl bash zip unzip

COPY --from=ghcr.io/mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo pdo_pgsql http sockets

COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN mkdir -p runtime/logs

RUN composer install --no-dev --optimize-autoloader \
    && ./vendor/bin/rr get

COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

CMD ["/usr/bin/supervisord"]
