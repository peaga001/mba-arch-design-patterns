FROM php:8.4.15-alpine3.21@sha256:9c1dd92c492546d1de23decef0d67280f3f9413942ff44ec119af6db642cd9f0

RUN apk add --no-cache \
    curl \
    autoconf \
    gcc \
    g++ \
    make \
    linux-headers \
    nodejs \
    npm \
    && pecl install xdebug \
    && docker-php-ext-enable opcache \
    && docker-php-ext-enable xdebug \
    && apk del autoconf gcc g++ make

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini