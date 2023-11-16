#!/bin/bash

cd /opt/apps/openvpn
docker-compose up -d vpn

# docker run -d --name vpn --privileged -p 139:1194/udp -p 445:443/tcp umputun/dockvpn
docker run -t -i --name vpn-keys --rm -p 8080:8080 --volumes-from vpn umputun/dockvpn serveconfig
# README:
# edit ports in config:
# <connection>
# remote *.*.*.* 139 udp
# </connection>
#
# <connection>
# remote *.*.*.* 445 tcp-client
# </connection>
