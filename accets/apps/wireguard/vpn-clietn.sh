# ln -s /usr/bin/resolvectl /usr/local/bin/resolvconf
# systemctl start systemd-resolved.service
# systemctl enable systemd-resolved.service
# ln -s /opt/apps/wireguard/client/wg0.conf /etc/wireguard/wg0.conf
wg-quick up wg0
