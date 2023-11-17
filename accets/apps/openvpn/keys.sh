#!/bin/bash

# cd {path}
docker run -ti --name vpn-keys --rm -p 8080:8080 --volumes-from openvpn umputun/dockvpn serveconfig
# README:
# edit ports in config:
# <connection>
# remote *.*.*.* 139 udp
# </connection>
#
# <connection>
# remote *.*.*.* 445 tcp-client
# </connection>
