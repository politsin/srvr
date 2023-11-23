# SRVR

## TODO:

- TLS users: (999:999)
- File mon
- LogRotate: nginx, exim, ...
- Docker: /etc/docker/daemon.json

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
