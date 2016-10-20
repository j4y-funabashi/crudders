#!/bin/sh

export APP_ROOT="/srv/app"
export APP_NAME="app"

sudo locale-gen en_GB.UTF-8

## INSTALL
sudo apt-get update -qq \
    && sudo apt-get upgrade -qq -y \
    && sudo apt-get install -qq -y \
        nginx \
        php7.0-cli \
        php7.0-fpm

## CONFIG
cat $APP_ROOT/env.example \
    | envsubst '$APP_NAME $APP_ROOT' \
    | sudo tee /srv/.env > /dev/null

sudo rm /etc/nginx/sites-enabled/default;

cat $APP_ROOT/resources/nginx.conf \
    | envsubst '$APP_NAME $APP_ROOT' \
    | sudo tee /etc/nginx/sites-enabled/$APP_NAME > /dev/null

cat $APP_ROOT/resources/phpfpm.conf \
    | envsubst '$APP_NAME $APP_ROOT' \
    | sudo tee /etc/php/7.0/fpm/pool.d/$APP_NAME.conf > /dev/null

## COMPOSER
curl -sS https://getcomposer.org/installer | php && sudo mv composer.phar /usr/bin/composer
composer install

## RESTART SERVICES
sudo service nginx restart
sudo service php7.0-fpm restart
