#!/bin/bash

KEYS=/opt/docker-rest/ssl/rest.crt
if [ -f "$KEYS" ]; then
    echo "$KEYS exists."
else
  openssl req -x509 -nodes -days 9000 -newkey rsa:2048 \
    -keyout /opt/docker-rest/ssl/rest.key \
    -out /opt/docker-rest/ssl/rest.crt \
    -subj "/C=RU/ST=Msc/L=Msc/O=Syn/OU=IT/CN=example.com"
  sed -i -e 's/example.crt/rest.crt/g' /opt/docker-rest/nginx.conf
  sed -i -e 's/example.key/rest.key/g' /opt/docker-rest/nginx.conf
  echo "$KEYS done."
fi

PASSFILE=/opt/docker-rest/.passwd
if [ -f "$PASSFILE" ]; then
    echo "$PASSFILE exists."
else
   PASS=$(LC_ALL=C tr -dc '[:alnum:]' < /dev/urandom | head -c20)
   if [ -z "$1" ]; then
     PASS=$1
   fi
   echo 'DOCKER_OPTS="-H unix:///var/run/docker.sock"' >> /etc/default/docker
   service docker restart
   htpasswd -bc $PASSFILE synapse $PASS
   echo $PASS > /opt/docker-rest/passwd
   echo "$PASS done."
fi
