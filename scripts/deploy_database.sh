#!/bin/bash

if [[ $EUID = 0 ]]; then
   echo "This script must not be run as root"
   exit 1
fi

USERNAME=$(grep -oP '(?<=strAdminName = ").*?(?=")' ../config/config.php)
PASSWORD=$(grep -oP '(?<=strAdminPassword = ").*?(?=")' ../config/config.php)
DATABASE=$(grep -oP '(?<=strDbName = ").*?(?=")' ../config/config.php)

echo $USERNAME
echo $PASSWORD
echo $DATABASE

set -x
mysql -u $USERNAME -p$PASSWORD -e "DROP DATABASE $DATABASE;"

mysql -u $USERNAME -p$PASSWORD -e "CREATE DATABASE $DATABASE;"

mysql -u $USERNAME -p$PASSWORD $DATABASE < ./database.sql
