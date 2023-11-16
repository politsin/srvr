# rabbitmq

## Описание

- RabbitMQ в докере для работы с MQTT и сертификатами леценкрипт.
- Сертификаты делает https://github.com/politsin/certbot

## QuickStart

- Сначала у вас должны быть уже сделаны сертификаты
- Склонируйте в `/opt/apps/rabbitmq`
- Напишите что-нибудь уникальное в ./etc/.erlang.cookie
  - TODO: перенести этот функционал в ./start.sh
- Задайте `default_user` и `default_pass` в `./etc/rabbitmq/rabbitmq.conf`
- Задайте hostname в `docker-compose.yml`
- `./start.sh`

## Info

- Админка: https://mqtt.example.com:15671/
- `prefix` у юзера определяет `vhost` например iot:drupal это:
  - `iot` - vhost
  - `drupal` - user
- Открытые порты для mqtt:
  - `1883` mqtt
  - `8883` mqtts (mqtt/ssl)
  - `15675` ws (web-mqtt)
  - `15676` wss (web-mqtt/https)
  - `15671` админка (manage)
- Также открыты порты:
  - `5672` amqp
  - `5671` amqp/ssl
  - `61613` stomp
  - `15674` http/web-stomp
  - `25672` clustering

## Траблшутинг

- посмотреть логи: `docker logs rabbitmq`
- Проблемы с сертификатом при старте `docker start rabbitmq -a`
  - скорее всего у линков нужны права на чтение. Смотри `init.sh`
- TLS Debug:
  - `openssl s_server -accept 8443 -cert ./cert.pem -key ./key.pem -CAfile ./cacert.pem`
  - `openssl s_client -connect localhost:8443 -cert ./cert.pem -key ./key.pem -CAfile ./cacert.pem`
- Если всё пошло не по плану:
  - остановите и удалите докер
  - удалите папку var
  - начните с начала ./start.sh
- Если проблемы с доступом к конфиг-файлу
  - закоментируйте в композ-файле `./etc/rabbitmq/rabbitmq.conf:/etc/rabbitmq/rabbitmq.conf`
  - `./start.sh` - запустит докер
  - вытащите работающий конфиг:
    - `docker cp rabbitmq:/etc/rabbitmq/rabbitmq.conf /opt/apps/rabbitmq/etc/rabbitmq/rabbitmq-new.conf`
  - добавьте его в композ `./etc/rabbitmq/rabbitmq.conf:/etc/rabbitmq/rabbitmq-new.conf`
  - конфигурируйте как надо
