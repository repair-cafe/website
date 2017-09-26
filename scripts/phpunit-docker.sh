#!/bin/sh

set -e

HERE=`dirname $0`
DOCKER_ROOT="$HERE/../.."

set +e

cd $DOCKER_ROOT
docker-compose exec workspace /var/www/vendor/bin/phpunit -c /var/www/phpunit.xml

exit $?
