#!/bin/bash

# cd {{ path }}
docker-compose up -d grafana
chown 472:472 -R ./data
