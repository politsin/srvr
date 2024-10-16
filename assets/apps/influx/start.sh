#!/bin/bash

# cd {path}
chown 1000:999 /opt/apps/certbot/tls/private.pem
chown 1000:999 /opt/apps/certbot/tls/fullchain.pem
docker-compose up -d
