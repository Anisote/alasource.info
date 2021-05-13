#!/bin/bash

sudo apt install apache2 libapache2-mod-php php-mysql php-gd php-mbstring mariadb-server

sudo systemctl start mariadb-server

sudo mysql

USERNAME=$(grep -oP '(?<=strUserName = ").*?(?=")' ../config/config.php)
PASSWORD=$(grep -oP '(?<=strPassword = ").*?(?=")' ../config/config.php)
DATABASE=$(grep -oP '(?<=strDbName = ").*?(?=")' ../config/config.php)

CREATE USER $USERNAME@localhost IDENTIFIED BY '$PASSWORD';
GRANT ALL PRIVILEGES ON '$DATABASE'.* TO '$USERNAME'@localhost;
