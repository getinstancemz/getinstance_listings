#!/bin/bash

# listing 001.03
curl -LO https://phar.phpunit.de/phpunit-9.5.23.phar
php phpunit-9.5.23.phar --version
# /listing 001.03 
#
# listing 001.05
composer require --dev phpunit/phpunit 9.5.23
# /listing 001.05 

./vendor/bin/phpunit tests
