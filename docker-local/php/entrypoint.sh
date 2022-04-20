#!/bin/sh

if [ ! -f composer.json ]; then

    composer create-project symfony/skeleton tmp  --prefer-dist
    cd tmp
    composer require webapp
    cp -Rp . ..
    cd -
    rm -Rf tmp/

fi