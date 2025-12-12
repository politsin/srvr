## Эксплуатация на SSD: как минимизировать запись (ARM/OrangePi/Linux)

Цель: перевести системные и контейнерные логи в оперативную память (RAM), чтобы не изнашивать SSD. Ниже — проверка текущего состояния, обязательные шаги и способы защиты от переполнения памяти.

### 1) Быстрая проверка текущего состояния

```bash
# journald: persistent или volatile?
grep -E '^[[:space:]]*Storage' /etc/systemd/journald.conf /etc/systemd/journald.conf.d/*.conf 2>/dev/null || echo "no explicit Storage= (смотрим наличие /var/log/journal)"

# Есть ли журналы на диске:
ls -ld /var/log/journal 2>/dev/null || true
journalctl --disk-usage || true

# rsyslog пишет файлы?
systemctl is-active rsyslog || true
sed -n '1,120p' /etc/rsyslog.conf 2>/dev/null | sed 's/^/| /'

# Docker глобальный лог-драйвер и файлы json-log:
docker info --format 'LoggingDriver={{.LoggingDriver}}' 2>/dev/null || true
find /var/lib/docker/containers -maxdepth 2 -name '*-json.log' -printf '%TY-%Tm-%Td %TH:%TM %s %p\n' 2>/dev/null | sort -r | head
```

Если видим `json-file` в Docker и активный `rsyslog` — это запись на SSD.

### 2) Хранить `/var/log` в RAM (tmpfs)

Создаём `systemd` unit, чтобы монтирование работало постоянно и после перезагрузки.

```bash
cat > /etc/systemd/system/var-log.mount << 'EOF'
[Unit]
Description=Temporary /var/log in RAM (tmpfs)
Before=systemd-journald.service rsyslog.service

[Mount]
What=tmpfs
Where=/var/log
Type=tmpfs
Options=mode=0755,size=64M

[Install]
WantedBy=multi-user.target
EOF

systemctl daemon-reload
systemctl enable --now var-log.mount

# Восстановить базовую структуру (на случай пустого каталога):
systemd-tmpfiles --create --prefix /var/log || true
install -d -m 2755 -o root -g systemd-journal /var/log/journal || true

# Проверка
mount | grep ' on /var/log '
df -h /var/log
```

Замечание про орг/дистро-специфику: на Armbian/OrangePi может существовать собственный «ramlog» (`orangepi-ramlog`/`armbian-ramlog`). Если он уже монтирует `/var/log` как tmpfs — можно использовать его, но избегайте конфликтов: не активируйте одновременно два механизма монтирования на один путь.

### 3) Перевести `systemd-journald` в volatile-режим и поставить лимиты

```bash
mkdir -p /etc/systemd/journald.conf.d

# Только RAM (без записи на диск)
cat > /etc/systemd/journald.conf.d/volatile.conf << 'EOF'
[Journal]
Storage=volatile
EOF

# Жёсткие лимиты в RAM (под 1 ГБ общей памяти — рекомендуемые значения)
cat > /etc/systemd/journald.conf.d/limits.conf << 'EOF'
[Journal]
RuntimeMaxUse=32M
RuntimeKeepFree=128M
RateLimitIntervalSec=10s
RateLimitBurst=200
MaxRetentionSec=12h
EOF

systemctl restart systemd-journald

# Проверка лимитов и объёма
grep -R '^(RuntimeMaxUse|RuntimeKeepFree|RateLimitIntervalSec|RateLimitBurst|MaxRetentionSec)=' /etc/systemd/journald.conf.d/*.conf || true
journalctl --disk-usage
```

Поведение при переполнении: `journald` начнёт удалять старые записи и троттлить bursts; OOM-риски минимальны.

### 4) Отключить `rsyslog` (чтобы не писать файлы на SSD)

```bash
systemctl disable --now rsyslog || true
systemctl is-active rsyslog || true   # должно быть inactive
```

### 5) Docker: глобально отправлять stdout/stderr в `journald`

```bash
mkdir -p /etc/docker
cp -a /etc/docker/daemon.json /etc/docker/daemon.json.bak.$(date +%Y%m%d%H%M%S) 2>/dev/null || true

cat > /etc/docker/daemon.json << 'EOF'
{
  "registry-mirrors": [
    "https://docker.mirrors.ustc.edu.cn"
  ],
  "log-driver": "journald",
  "log-opts": {}
}
EOF

systemctl restart docker
docker info --format 'LoggingDriver={{.LoggingDriver}}'   # должно показать journald
```

Важно: уже запущенные контейнеры сохраняют старый драйвер. Их нужно пересоздать (или перегрузить с `--log-driver=journald`). Пример для сервиса `redis` (сохраните свои порты/тома/переменные!):

```bash
docker rm -f redis || true
docker run -d --name redis \
  --log-driver=journald \
  -p 6379:6379 \
  redis:7
```

После этого файлы `*-json.log` в `/var/lib/docker/containers/...` расти не будут.

### 6) Рекомендации по файловой системе

- В `/etc/fstab` добавить `noatime` для корневого и других часто читаемых разделов, чтобы не обновлять время доступа на SSD при каждом чтении.
- Использовать zram/zswap (обычно уже включено на ARM-дистрибутивах) — это снижает запись на SSD, но не отменяет необходимость лимитов для логов.

Пример строки в `/etc/fstab` (будьте осторожны и адаптируйте к своей разметке дисков!):

```bash
# UUID=<ваш-uuid>  /  ext4  defaults,noatime  0 1
```

### 7) Мониторинг и верификация

```bash
# Объём и тип /var/log
mount | grep ' on /var/log '
df -h /var/log

# Объём журналов journald в RAM
journalctl --disk-usage

# Docker: какие драйверы у контейнеров
docker ps -aq | xargs -r -I{} sh -c 'docker inspect -f "{{.Id}} {{.Name}} {{.HostConfig.LogConfig.Type}} {{.LogPath}}" {}'

# Поиск потенциальных файловых логов, если «что-то ещё» пишет:
find /var/log -type f -printf '%TY-%Tm-%Td %TH:%TM %s %p\n' | sort -r | head
```

### 8) Политика приложения

- Приложение должно писать логи только в stdout/stderr — без файловых логгеров (никаких `*.log` файлов).
- Для долговременного хранения: рассмотреть удалённый сбор логов (journald→rsyslog remote, Loki, Fluentd/Vector, Promtail и т.д.). Это сохраняет SSD и даёт ретенцию.

### 9) Откат к «обычному» поведению (если потребуется)

```bash
# journald снова на диск
rm -f /etc/systemd/journald.conf.d/volatile.conf /etc/systemd/journald.conf.d/limits.conf
systemctl restart systemd-journald

# вернуть rsyslog
systemctl enable --now rsyslog

# вернуть docker json-file
sed -i 's/"log-driver":[^,]*/"log-driver": "json-file"/' /etc/docker/daemon.json
systemctl restart docker

# убрать tmpfs /var/log
systemctl disable --now var-log.mount
rm -f /etc/systemd/system/var-log.mount
systemctl daemon-reload
```

### 10) Базовые профили для 1 ГБ RAM

- `/var/log` (tmpfs): 64M
- `journald`: `RuntimeMaxUse=32M`, `RuntimeKeepFree=128M`, `RateLimitIntervalSec=10s`, `RateLimitBurst=200`, `MaxRetentionSec=12h`

Эта схема защищает от переполнения памяти: при достижении лимитов старые записи удаляются, bursts троттлятся, а SSD остаётся нетронутым.


