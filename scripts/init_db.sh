#!/usr/bin/env bash

set -e

if [ ! -d /var/www/public ] ; then
    echo "This script must be run *inside* the vagrant box"
    exit 1
fi

# MySQL (OctoberCMS DB)
echo "Initialize MySQL-DB..."
mysql -u root -proot -e"show databases;" | grep repair_cafe && mysql -u root -proot -e"DROP DATABASE repair_cafe;"
mysql -u root -proot -e"CREATE DATABASE repair_cafe;"
echo "Migrating OctoberCMS Data"
php artisan october:up
