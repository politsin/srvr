#!/bin/bash

# cd {path}
mkdir -p etc
mkdir -p db
chown -R 999:999 etc/ db/
docker-compose up -d
