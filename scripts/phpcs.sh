#!/bin/sh

set -e

HERE=`dirname $0`
ROOT="$HERE/.."

set +e

$ROOT/vendor/bin/phpcs --standard=$ROOT/phpcs.xml $ROOT/plugins/liip $ROOT/themes/repair-cafe

exit $?
