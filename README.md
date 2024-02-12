# SRVR

## TODO:

- TLS users: (999:999)
- File mon
- LogRotate: nginx, exim, ...
- CP if exists
- rabbitmq init.sh
- Docker: /etc/docker/daemon.json

# Cron

```
# Edit this file to introduce tasks to be run by cron.

# Dev: phpcs phpcbf vscode
* * * * * ps -aux | grep phpcs | awk '{print $2}' | xargs kill
* * * * * ps -aux | grep phpcbf | awk '{print $2}' | xargs kill
30 7,12,18 * * * ps -aux | grep vscode | awk '{print $2}' | xargs kill

# Apps
0 10 * * * /usr/bin/docker start certbot -a > /opt/apps/certbot/log/cron.log
30 9 * * * /usr/bin/docker exec -i docker-proxy /usr/sbin/nginx -s reload > /opt/docker-proxy/reload-log.log

# Custom
```

## Dokcer-images

- Source:
  - hub: https://hub.docker.com/repositories/synstd
  - repo: https://github.com/politsin/docker-build
- Images:
  - php
  - exim
  - backup
  - mattermost

## Ubuntu

- apt update && apt install git -y
- cd /opt && git clone https://github.com/politsin/srvr
- cd srvr
- ./init.sh

## OrangePi Zero

- Download
  - Ubuntu 22.04 LTS jammy server
    - https://drive.google.com/drive/folders/1ohxfoxWJ0sv8yEHbrXL1Bu2RkBhuCMup
  - Alternatives
    - http://www.orangepi.org/html/hardWare/computerAndMicrocontrollers/service-and-support/Orange-Pi-Zero-2.html
- MicroHDMI + USB-KeyBoard
- переходник+провод
- Login: `root`:`orangepi`
- `nmtui` - wifi tool -> connect to wifi
- `ip a`

## Todo

https://askubuntu.com/questions/1472428/why-i-got-failed-to-allocate-directory-watch-too-many-open-files

```
sysctl fs.inotify
fs.inotify.max_queued_events = 16384
`fs.inotify.max_user_instances` = 128
fs.inotify.max_user_watches = 65536
```

- `sysctl fs.inotify`
- `fs.inotify.max_user_instances = 128`
- `sysctl -w fs.inotify.max_user_instances=256`
- `sysctl -w fs.inotify.max_user_watches=256`
  sysctl -w fs.inotify.max_user_watches=6553699
  sysctl -w fs.inotify.max_user_instances=1024

### Exim Update

SET `4` APP

```sh
cd /opt/srvr
git pull
cat .env.local
docker stop exim
docker rm exim
mv /opt/apps/exim /opt/apps/exim-old
./console.php setapp
cd /opt/apps/exim
mv compose.yml docker-compose.yml
./start.sh
docker ps | grep exim
```

PHP-test

```php
<?php
print "hello";
$to = "politsin@gmail.com";
$subject = "server test";
$message = "test psss";
$additional_headers = [];
$additional_params = "";
$mail = mail($to, $subject, $message);
print ">$mail<";
```

## Docker-REST Update

1. меняем nginx.conf
2. выполняем команды

```sh
cd /opt/docker-rest
docker pull nginx:alpine
./start.sh
```
