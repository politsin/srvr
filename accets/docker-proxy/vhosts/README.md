# Vhosts

All `{dir}/{name}.conf` files are included

Example:

```conf
server {
  listen 443 ssl http2;
  listen [::]:443 ssl http2;
  server_name click.example.com;

  include includes/proxy_headers;
  include includes/letsencrypt.conf;

  set $upstream click.example.com:8123;

  # SSL
  include includes/ssl-on.conf;
  ssl_certificate default/ssl/server.crt;
  ssl_certificate_key default/ssl/server.key;

  location / {
    proxy_pass_header Authorization;
    proxy_pass http://$upstream;
  }
}

```
