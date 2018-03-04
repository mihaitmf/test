#!/usr/bin/env bash

CONTAINERS=(
    memcached1
    memcached2
#    memcached3
#    memcached4
)

startingPort=11201

dashes="================================"

printf "\n!!!!! Must run with sudo. Example: sudo ./run.sh\n"

printf "\n%s Deleting containers %s\n" ${dashes} ${dashes}
for CONTAINER in "${CONTAINERS[@]}"; do
    docker rm -fv ${CONTAINER}
done

printf "\n%s Starting containers %s\n" ${dashes} ${dashes}
for CONTAINER in "${CONTAINERS[@]}"; do
    docker run --name ${CONTAINER} -d -p ${startingPort}:11211 memcached
    ((startingPort+=1))
done

