#!/usr/bin/env bash

apt-get update
apt-get install -yq \
    libfreetype6-dev \
    libmcrypt-dev \
    libpng12-dev \
    libjpeg-dev \
    libpng-dev

docker-php-ext-install pdo_mysql \
    gd \
    mbstring \
    mysqli \
    mcrypt

pecl install xdebug-2.5.0 \
	&& docker-php-ext-enable xdebug
