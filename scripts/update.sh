#!/bin/bash

if [[ $EUID = 0 ]]; then
   echo "This script must not be run as root"
   exit 1
fi

USERNAME=$(grep -oP '(?<=strUserName = ").*?(?=")' ../config/config.php)
PASSWORD=$(grep -oP '(?<=strPassword = ").*?(?=")' ../config/config.php)
DATABASE=$(grep -oP '(?<=strDbName = ").*?(?=")' ../config/config.php)

echo $USERNAME
echo $PASSWORD
echo $DATABASE

# clean metadata
find ../themes/pictures/ -type f -exec exiftool -overwrite_original -all=  "{}" \;

# dump databas
mysqldump -u $USERNAME -p$PASSWORD $DATABASE > ../database.sql
