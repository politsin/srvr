#!/bin/bash

cd /opt/docker-proxy
if [ ! -f /opt/docker-proxy/default/ssl/dhparam-2048.pem ]; then
  openssl dhparam -out /opt/docker-proxy/default/ssl/dhparam-2048.pem 2048
fi
docker-compose up -d docker-proxy
