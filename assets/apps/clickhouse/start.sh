#!/bin/bash

mkdir -p ./tls
# cert:
if [ ! -f ./tls/fullchain.pem ]; then
  # private.pem = server.key | fullchain.pem = server.crt
  openssl req -newkey rsa:4096 -new -nodes -x509 -days 3650 \
    -subj '/CN=clickhouse' \
    -keyout ./tls/private.pem \
    -out ./tls/fullchain.pem 
  openssl rsa -pubout -in ./tls/private.pem -out ./tls/public.pem
fi
# dhparam:
if [ ! -f ./tls/dhparam-2048.pem ]; then
  openssl dhparam -out ./tls/dhparam-2048.pem 2048
fi
# chown -R 100:100 ./tls/*

# cd {{ path }}
docker-compose up -d
