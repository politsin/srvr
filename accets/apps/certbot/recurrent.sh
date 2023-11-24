#!/bin/bash

HOST_NAME="${HOST}"
mkdir -p ./tls
if [[ ! -z "$1" ]]; then
  HOST_NAME=$1
fi
  rm -f ./tls/*
  ln -s ../etc/live/$HOST_NAME/privkey.pem ./tls/private.pem
  ln -s ../etc/live/$HOST_NAME/fullchain.pem ./tls/fullchain.pem
  chown -R 999:999 ./tls/private.pem
  chown -R 999:999 ./tls/fullchain.pem
  sed -i -e 's/# - \/opt\/apps\/certbot/- \/opt\/apps\/certbot/g' /opt/docker-proxy/compose.yml
  cd /opt/docker-proxy && docker-compose up -d
echo "$HOST_NAME"
