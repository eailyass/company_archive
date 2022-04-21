#!/bin/sh

set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

if [ ! -f composer.json ]; then

    composer create-project "symfony/website-skeleton 5.4.*" tmp --prefer-dist --no-progress --no-interaction
    cd tmp
    cp -Rp . ..
    cd -
    rm -Rf tmp/

fi

exec docker-php-entrypoint "$@"