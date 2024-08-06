
mkdir /opt/apps/php-fpm/www-home/.vscode-server
chown www-data:www-data /opt/apps/php-fpm/www-home/.vscode-server
sudo -u www-data tar -xf /opt/apps/vscode.tar -C /opt/apps/php-fpm/www-home/.vscode-server

