# Certbot

## Описание:

- Докер-композ для выпуска и обновления сертификатов Let's Encrypt.
- Настрйки по умолчанию для работы с https://github.com/politsin/docker-proxy

## Порядок действий

`_DOMAIN_` - это основной домен сервера

- Клонируем репу в `/opt/apps/certbot`
- Пишем свои домены в `.env`, cамый перый _DOMAIN_
- Запускаем докер `start.sh` - он сгенерит ключи по адресу ./etc/live/_DOMAIN_/\*
- Запускаем команду `./recurrent.sh _DOMAIN_` - чтобы получить линки на сертификаты в `./tls/*`
- Крон для ежедневного обновления сертификатов
  - `0 0 * * * /usr/bin/docker start certbot -a > /opt/apps/certbot/log/cron.log`
- Подставляем сертификаты конфиг в `docker-proxy` (https://github.com/politsin/docker-proxy)

```yml
volumes:
  # ...
      - "/opt/apps/certbot/tls/fullchain.pem:/etc/nginx/default/ssl/proxy.crt:ro"
      - "/opt/apps/certbot/tls/private.pem:/etc/nginx/default/ssl/proxy.key:ro"
```

## Crontab

- `apt install cron` - установка
- `crontab -e` - редактирование конфигурации
- `crontab -l` - просмотр текущей конфигурации
- Каждый день запускаем контейнер
  - `0 10 * * * /usr/bin/docker start certbot -a> /opt/apps/certbot/log/cron.log`
- Рестартим контейнеры каждый вторник чтобы точно перепрочитывались ключи:
  - `0 11 * * 2 /usr/bin/docker restart influx`
  - `0 12 * * 2 /usr/bin/docker restart rabbitmq`
  - `0 13 * * 2 /usr/bin/docker restart docker-proxy`

## TODO:

- bridge
- telegraf
- log-rotate для docker-proxy

## Что может поменяться в docker-compose:

- Stage / Prod `--staging`
- Всегда обнволять `--force-renewal`
- Путь к публик-директории `/opt/docker-proxy/default/www`

```yml
volumes:
  # Путь к вашей паблик-директории веб сервера
  - "/opt/docker-proxy/default/www:/var/www/html"
```
