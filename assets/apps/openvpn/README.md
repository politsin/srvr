# OpenVPN

- запускаем `./start.sh`
- запускаем `./keys.sh`
  - скачиваем ключи с IP:8080
  - останавливаем `Ctrl+C`
- редактируем файл в блокноте
  - название `foo.ovpn`
  - меняем порты на: 445 tcp-client 139 udp
  - убираем блок <dh>

```
<connection>
remote 51.250.34.46 139 udp
</connection>

<connection>
remote 51.250.34.46 445 tcp-client
</connection>
```
