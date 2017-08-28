#!/bin/sh

set -e

HERE=`dirname $0`
ROOT="$HERE/.."

set +e

cd $DOCKER_ROOT
$ROOT/vendor/bin/phpunit -c $ROOT/phpunit.xml

exit $?
