#!/bin/bash

set -e

if [ "${1:0:1}" = '-' ]; then
    set -- influxd "$@"
fi

# exec "$@"
influxd --tls-cert='/tls/fullchain.pem' --tls-key='/tls/private.pem' --session-length=525600
