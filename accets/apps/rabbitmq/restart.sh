#!/bin/bash

# rm -rf /opt/apps/rabbitmq/var
docker stop rabbitmq
docker rm rabbitmq
docker-compose up rabbitmq
