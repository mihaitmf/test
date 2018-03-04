#!/usr/bin/env bash

docker rmi $(docker images -q --filter "dangling=true")

docker build -t memcached .
