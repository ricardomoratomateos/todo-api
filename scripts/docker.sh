#!/bin/bash

SCRIPT_DIR="$(dirname "$(which "$0")")"

cd ${SCRIPT_DIR}/../
case $1 in
  docker:run)
    ./docker/scripts/runContainer.sh
    ;;
  docker:build)
    ./docker/scripts/buildImage.sh
    ;;
  docker:destroy)
    ./docker/scripts/destroyContainer.sh
    ;;
  docker:stop)
    ./docker/scripts/stopContainer.sh
    ;;
  *)
    echo "ERROR: Command not found"
    exit 1
    ;;
esac

cd -
