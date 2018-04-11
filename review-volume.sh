#!/usr/bin/env bash

VOLUME=${1:-"$(basename $(dirname $(realpath $0)))_data"}

docker run -it --rm -v "${VOLUME}:/app/data" --workdir=/app/data bash