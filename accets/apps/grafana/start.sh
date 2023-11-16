#!/bin/bash

# cd {{ path }}
docker-compose up -d
chown 472:472 -R ./data
