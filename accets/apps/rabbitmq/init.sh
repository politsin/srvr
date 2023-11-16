#!/bin/bash

# cd {{ path }}
chown 999:999 /opt/apps/certbot/tls/private.pem
chown 999:999 /opt/apps/certbot/tls/fullchain.pem
chmod 600 ./etc/.erlang.cookie
