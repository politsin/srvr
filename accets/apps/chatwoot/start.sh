#!/bin/bash

# cd {{ path }}
docker network create chatwoot
# docker network connect chatwoot postgre
# docker network connect chatwoot postgre-XXX-chat
docker network connect chatwoot redis
docker-compose up -d
