FROM ubuntu:latest

MAINTAINER MihaiT

# install memcached
RUN apt-get update && apt-get install -y \
    memcached

EXPOSE 11211

# Set the user to run Memcached daemon
USER memcache

# Set the entrypoint to memcached binary
ENTRYPOINT ["memcached", "-p", "11211", "-u", "memcache"]
