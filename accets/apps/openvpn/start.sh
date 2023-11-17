#!/bin/bash

# cd {path}
docker-compose up -d

docker run -d --name vpn --privileged -p 139:1194/udp -p 445:443/tcp umputun/dockvpn
