#!/bin/bash

set -xe

php artisan key:generate
php artisan migrate:fresh --seed

php-fpm