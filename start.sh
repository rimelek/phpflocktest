#!/usr/bin/env bash

SCALE=${1:-1}

docker-compose up -d --scale php=${SCALE}