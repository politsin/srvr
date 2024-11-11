# Influx

## Reload cert
```
# Apps
0 10 * * * /usr/bin/docker start certbot -a > /opt/apps/certbot/log/cron.log
1 10 * * * /usr/bin/chown 999:999 /opt/apps/certbot/tls/private.pem
1 10 * * * /usr/bin/chown 999:999 /opt/apps/certbot/tls/fullchain.pem
30 11 * * 3 /usr/bin/docker restart influx >> /opt/apps/influx/restart-log.log
```

## Backet `server`

- Delete data → `older then` → `14 days`
- Load Data → Telegraf → Create Configuration →
  - BUCKET=server → ping → Continue Configurating
  - Name=metrics → Save AND Test
  - COPY TOKEN

## Server metrics (see telegraf/.env)

- ORG=default
- BUCKET=server
- Copy TOKEN
- SETUP .env:
  - INFLUX_URL = https://HOST:18086
  - INFLUX_TOK =
