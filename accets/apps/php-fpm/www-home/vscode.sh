cd /opt/srvr/
git pull
./console.php setapp
# 10
cd /opt/apps/vscode-init/
ll
mkdir data
chown www-data:www-data data
sudo -u www-data tar -xf e.tar
chmod +x start.sh
rm -r /opt/apps/php-fpm/www-home/.codeium
rm -r /opt/apps/php-fpm/www-home/.vscode
rm -r /opt/apps/php-fpm/www-home/.vscode-server
mv ./data/.codeium/ /opt/apps/php-fpm/www-home/
mv ./data/.vscode/ /opt/apps/php-fpm/www-home/
mv ./data/.vscode-server/ /opt/apps/php-fpm/www-home/
