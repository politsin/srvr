#!/bin/bash

# docker stop certbot && docker rm certbot && docker-compose up certbot
docker-compose up -d

# Crontab.
command="/usr/bin/docker start certbot -a > /opt/apps/certbot/log/cron.log"
job="0 10 * * * $command"
cat <(fgrep -i -v "$command" <(crontab -l)) <(echo "$job") | crontab -
crontab -l
