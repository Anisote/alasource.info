#!/bin/bash

if [[ $EUID != 0 ]]; then
   echo "This script must be run as root"
   exit 1
fi

# apache2 
# sudo apt install apache2 libapache2-mod-php 

# nginx
apt install nginx php-fpm

apt install php-mysql php-gd php-mbstring mariadb-server

sudo systemctl start mariadb-server

sudo mysql

USERNAME=$(grep -oP '(?<=strAdminName = ").*?(?=")' ../config/config.php)
PASSWORD=$(grep -oP '(?<=strAdminPassword = ").*?(?=")' ../config/config.php)

ADMIN=$(grep -oP '(?<=strAdminName = ").*?(?=")' ../config/config.php)
ADMINPASSWORD=$(grep -oP '(?<=strAdminPassword = ").*?(?=")' ../config/config.php)

DATABASE=$(grep -oP '(?<=strDbName = ").*?(?=")' ../config/config.php)

# creation of the select user
sudo mysql -e CREATE USER $USERNAME@localhost IDENTIFIED BY '$PASSWORD';
sudo mysql -e GRANT SELECT ON $DATABASE.* TO '$USERNAME'@localhost;

# creation of the admin user
sudo mysql -e CREATE USER $ADMIN@localhost IDENTIFIED BY '$ADMINPASSWORD';
sudo mysql -e GRANT ALL PRIVILEGES ON $DATABASE.* TO '$ADMIN'@localhost;
