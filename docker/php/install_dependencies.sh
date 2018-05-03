#!/usr/bin/env bash

apt-get update
apt-get install -y apt-utils
apt-get install -y build-essential
apt-get install -y locales
apt-get install -y gettext gettext-doc libgettextpo-dev

apt-get install -yq \
    libfreetype6-dev \
    libmcrypt-dev \
    libpng12-dev \
    libjpeg-dev \
    libicu-dev \
    libgettextpo-dev \
    libpng-dev

docker-php-ext-install pdo_mysql \
    gd \
    mbstring \
    mysqli \
    mcrypt \
    gettext \
    intl

pecl install xdebug-2.5.0 \
	&& docker-php-ext-enable xdebug

curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

locale-gen en_US.UTF-8
locale-gen pt_BR.UTF-8
locale-gen ru_RU.UTF-8
