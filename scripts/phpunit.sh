#!/bin/sh

set -e

HERE=`dirname $0`
ROOT="$HERE/.."

set +e

$ROOT/vendor/bin/phpunit -c $ROOT/phpunit.xml

exit $?
