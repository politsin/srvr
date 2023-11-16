#!/bin/bash

cd /opt/apps/exim
mkdir -p ./log
chown -R 100:100 ./log
chmod -R 755 ./log
chmod -R 644 ./log/*

# keys:

mkdir -p ./tls
# cert:
if [ ! -f ./tls/fullchain.pem ]; then
  openssl req -newkey rsa:4096 -new -nodes -x509 -days 3650 -keyout ./tls/private.pem -out ./tls/fullchain.pem -subj '/CN=exim'
  openssl rsa -pubout -in ./tls/private.pem -out ./tls/public.pem
fi
# dhparam:
if [ ! -f ./tls/dhparam-2048.pem ]; then
  openssl dhparam -out ./tls/dhparam-2048.pem 2048
fi
chown -R 100:100 ./tls/*

# dkim:
if [ ! -f ./tls/dkim.pem ]; then
  openssl genrsa -out ./tls/dkim.pem 1024
  openssl rsa -pubout -in ./tls/dkim.pem -out ./tls/dkim-public.pem
fi
key="$( cat ./tls/dkim-public.pem |  awk '(NR>1)' | sed '$d' | tr -d '\n' )"
echo "DKIM TXT smail._domainkey"
echo "v=DKIM1; h=sha256; k=rsa; p=$key"

chown -R 100:100 ./tls/*

docker-compose up -d exim
