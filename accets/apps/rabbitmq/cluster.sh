#!/bin/bash

cd /opt/apps/rabbitmq

docker exec rabbitmq rabbitmqctl stop_app
# docker exec rabbitmq rabbitmqctl reset
docker exec rabbitmq rabbitmqctl join_cluster rabbit@mqtt.example.com
docker exec rabbitmq rabbitmqctl start_app
