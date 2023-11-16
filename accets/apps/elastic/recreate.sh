#!/bin/bash

cd /opt/apps/elastic

docker stop elastic kibana
docker rm elastic kibana
docker-compose up -d
