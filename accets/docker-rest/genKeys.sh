#!/bin/bash

KEYS=/opt/docker-rest/ssl/rest.crt
if [ -f "$KEYS" ]; then
    echo "$KEYS exists."
else
  openssl req -x509 -nodes -days 9000 -newkey rsa:2048 -keyout /opt/docker-rest/ssl/rest.key -out /opt/docker-rest/ssl/rest.crt
  sed -i -e 's/example.crt/rest.crt/g' /opt/docker-rest/nginx.conf
  sed -i -e 's/example.key/rest.key/g' /opt/docker-rest/nginx.conf
  echo "$KEYS done."
fi
