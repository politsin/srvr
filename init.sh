#!/bin/bash

apt update -y
apt install ssmtp \
            php-cli \
            php-dev \
            php-zip \
            php-curl \
            php-pear \
            -y --no-install-recommends

mv /etc/ssmtp/ssmtp.conf /etc/ssmtp/ssmtp.conf.bak
cp /opt/srvr/assets/etc/ssmtp/ssmtp.conf /etc/ssmtp/ssmtp.conf

#Composer:::
wget https://getcomposer.org/installer -q -O composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php && \
    chmod +x /usr/local/bin/composer

php --version
export COMPOSER_ALLOW_SUPERUSER=1
composer --version
composer install -o --no-progress
