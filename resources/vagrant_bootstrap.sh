#!/bin/sh

export APP_ROOT="/srv/crudders"
export APP_NAME="crudders"


sudo locale-gen en_GB.UTF-8

## INSTALL
sudo apt-get update -qq \
    && sudo apt-get upgrade -qq -y \
    && sudo apt-get install -qq -y \
        nginx \
        php5-fpm


## CONFIG
sudo rm /etc/nginx/sites-enabled/default;
cat $APP_ROOT/resources/nginx.conf \
    | envsubst '$APP_NAME $APP_ROOT' \
    | sudo tee /etc/nginx/sites-enabled/$APP_NAME > /dev/null

cat $APP_ROOT/resources/phpfpm.conf \
    | envsubst '$APP_NAME $APP_ROOT' \
    | sudo tee /etc/php5/fpm/pool.d/$APP_NAME.conf > /dev/null


## RESTART SERVICES
sudo service nginx restart
sudo service php5-fpm restart
