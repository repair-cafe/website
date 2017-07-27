#!/bin/sh

set -e

HERE=`dirname $0`
DOCKER_ROOT="$HERE/../.."

set +e

cd $DOCKER_ROOT
docker-compose exec workspace /var/www/public/vendor/bin/phpcs --standard=PSR2 --ignore=/var/www/public/themes/repair-cafe/assets/js,/var/www/public/plugins/liip/*/updates/ /var/www/public/plugins/liip /var/www/public/themes/repair-cafe

exit $?
