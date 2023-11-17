#!/bin/bash

# cd {path}
docker-compose up -d

docker run -ti --name vpn-keys --rm -p 8080:8080 --volumes-from vpn umputun/dockvpn serveconfig
# README:
# edit ports in config:
# <connection>
# remote *.*.*.* 139 udp
# </connection>
#
# <connection>
# remote *.*.*.* 445 tcp-client
# </connection>
