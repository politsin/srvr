#!/bin/bash

apt install php \
            php-cli \
            php-dev \
            php-zip \
            php-pear \
            -y
#Composer:::
wget https://getcomposer.org/installer -q -O composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    chmod +x /usr/local/bin/composer

php --version
composer --version
composer install -o --no-progress
