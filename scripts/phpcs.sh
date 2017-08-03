#!/bin/sh

set -e

HERE=`dirname $0`
ROOT="$HERE/.."

set +e

$ROOT/vendor/bin/phpcs --standard=PSR2 --extensions=php --ignore=$ROOT/themes/repair-cafe/assets/js,$ROOT/plugins/liip/*/updates/ $ROOT/plugins/liip $ROOT/themes/repair-cafe

exit $?
