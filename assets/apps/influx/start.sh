#!/bin/bash

# cd {path}
# chown 999:999 etc/ db/ -R
mkdir etc
mkdir db
chown -R 999:999 etc/ db/
docker-compose up -d
