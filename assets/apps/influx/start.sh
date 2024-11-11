#!/bin/bash

# cd {path}
mkdir etc
mkdir db
chown -R 999:999 etc/ db/
docker-compose up -d
