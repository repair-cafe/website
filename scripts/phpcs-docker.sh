#!/bin/sh

set -e

HERE=`dirname $0`
DOCKER_ROOT="$HERE/../.."

set +e

cd $DOCKER_ROOT
docker-compose exec workspace /var/www/vendor/bin/phpcs --standard=PSR2 --ignore=/var/www/themes/repair-cafe/assets/js,/var/www/plugins/liip/*/updates/ /var/www/plugins/liip /var/www/themes/repair-cafe

exit $?
