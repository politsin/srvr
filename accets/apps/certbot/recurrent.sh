#!/bin/bash

HOST_NAME="${HOST}"
mkdir -p /opt/apps/certbot/tls
if [[ ! -z "$1" ]]; then
  HOST_NAME=$1
  rm /opt/apps/certbot/tls/*
  ln -s /opt/apps/certbot/etc/live/$HOST_NAME/privkey.pem /opt/apps/certbot/tls/private.pem
  ln -s /opt/apps/certbot/etc/live/$HOST_NAME/fullchain.pem /opt/apps/certbot/tls/fullchain.pem
  chown -R 999:999 ./tls/private.pem
  chown -R 999:999 ./tls/fullchain.pem
fi
echo "$HOST_NAME"
