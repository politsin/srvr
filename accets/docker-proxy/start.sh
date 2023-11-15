#!/bin/bash

cd /opt/docker-proxy
if [ ! -f /opt/docker-proxy/default/ssl/dhparam-2048.pem ]; then
  openssl dhparam -out /opt/docker-proxy/default/ssl/dhparam-2048.pem 2048
fi

KEYS=/opt/docker-proxy/default/ssl/proxy.crt
if [ -f "$KEYS" ]; then
    echo "$KEYS exists."
else
  openssl req -x509 -nodes -days 9000 -newkey rsa:2048 \
    -keyout /opt/docker-proxy/default/ssl/proxy.key \
    -out /opt/docker-proxy/default/ssl/proxy.crt \
    -subj "/C=RU/ST=Msc/L=Msc/O=Syn/OU=IT/CN=example.com"
  sed -i -e 's/server.crt/proxy.crt/g' /opt/docker-proxy/default/default.conf
  sed -i -e 's/server.key/proxy.key/g' /opt/docker-proxy/default/default.conf
  echo "$KEYS done."
fi

docker-compose up -d docker-proxy
