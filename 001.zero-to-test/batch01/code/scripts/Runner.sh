#!/bin/bash

# listing 001.03  
curl -LO https://phar.phpunit.de/phpunit-9.5.23.phar
php phpunit-9.5.23.phar --version
# /listing 001.03   
#
# listing 001.06   
composer require --dev phpunit/phpunit 9.5.23
# /listing 001.06    

# listing 001.09 
./vendor/bin/phpunit tests/RoomTest.php
# /listing 001.09 

#
./vendor/bin/phpunit tests
