#!/bin/bash

# cd {{ path }}
chown 999:999 /opt/apps/certbot/tls/private.pem
chown 999:999 /opt/apps/certbot/tls/fullchain.pem
chown 999:999 ./etc/.erlang.cookie
chown 999:999 ./data
chmod 600 ./etc/.erlang.cookie
