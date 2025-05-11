FROM php:8.1-fpm

# Composerインストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 必要なパッケージのインストール
RUN apt-get update \
    && apt-get install -y git unzip zip \
    && apt-get install -y libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql

WORKDIR /var/www
