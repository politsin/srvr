#!/bin/bash

# cd {{ path }}
echo "" > ./log/clickhouse-server.log
echo "" > ./log/clickhouse-server.err.log
docker stop clickhouse
docker rm clickhouse
docker-compose up -d clickhouse
