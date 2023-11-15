#!/bin/bash

cd /opt/apps/certbot
# docker stop certbot && docker rm certbot && docker-compose up certbot
docker-compose up -d certbot
