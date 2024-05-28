#!/bin/bash

cd /opt/apps/redis
docker-compose up -d
# docker-compose run redis redis-check-aof --fix /data/appendonlydir/appendonly.aof.4.incr.aof
