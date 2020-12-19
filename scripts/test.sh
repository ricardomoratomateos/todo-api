#!/bin/bash
# Script for run dockers and execute tests inside them

docker-compose -p 'todo-api-test' -f docker-compose.test.yml up -d

case "$1" in
    "unit")
        docker-compose -p 'todo-api-test' exec -T php ./vendor/bin/phpunit --testsuit unit
        ;;
    "integration")
        docker-compose -p 'todo-api-test' exec -T php ./vendor/bin/phpunit --testsuit integration
        ;;
    *)
        docker-compose -p 'todo-api-test' exec -T php ./vendor/bin/phpunit
        ;;
    esac

docker-compose -p 'todo-api-test' stop