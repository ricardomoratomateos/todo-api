#!/bin/bash
# Script for run dockers and execute tests inside them

docker-compose -f docker-compose.test.yml up --detach

case "$1" in
    "unit")
        docker-compose exec -T php ./vendor/bin/phpunit --testsuit unit
        ;;
    "integration")
        docker-compose exec -T php ./vendor/bin/phpunit --testsuit integration
        ;;
    *)
        docker-compose exec -T php ./vendor/bin/phpunit
        ;;
    esac

docker-compose stop