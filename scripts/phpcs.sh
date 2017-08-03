#!/bin/sh

set -e

HERE=`dirname $0`
ROOT="$HERE/.."

set +e

$ROOT/vendor/bin/phpcs --standard=PSR2 --ignore=themes/repair-cafe/assets,plugins/liip/*/updates $ROOT/plugins/liip $ROOT/themes/repair-cafe

exit $?
