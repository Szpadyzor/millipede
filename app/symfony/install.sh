#!/bin/bash

php -d memory_limit=-1 /usr/local/bin/composer install -o

bin/console doctrine:schema:create