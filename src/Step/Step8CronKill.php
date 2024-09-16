<?php

namespace Srvr\Step;

/**
 * Step1 Clear.
 */
class Step8CronKill extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $crontabs = [
      'debian' => '/var/spool/cron/crontabs/root',
    ];
    if (!file_exists($crontabs['debian'])) {
      $this->exec("touch {$crontabs['debian']}");
    }
    $tab = $crontabs['debian'];
    $cron = [
      "# Dev: phpcs phpcbf vscode",
      "* * * * * ps -aux | grep phpcs | awk '{print $2}' | xargs kill",
      "* * * * * ps -aux | grep phpcbf | awk '{print $2}' | xargs kill",
      "30 7,12,18 * * * ps -aux | grep vscode | awk '{print $2}' | xargs kill",
      // '*/10 * * * *  echo "" > $(docker inspect --format='{{. LogPath}}' docker-proxy)',
      // '*/30 * * * *  echo "" > /opt/sites/XX-grxxxin/www-home/log/nginx-access.log',
    ];
    foreach ($cron as $cmd) {
      $this->exec("echo '$cmd' >> $tab");
    }
    $this->exec("service cron reload");
    $result = $this->exec("crontab -l");
    dump($result);
    return 1;
  }

  /**
   *
   */
  private function template() {
    $tpl = <<<EOD
# Dev: phpcs phpcbf vscode
* * * * * ps -aux | grep phpcs | awk '{print $2}' | xargs kill
* * * * * ps -aux | grep phpcbf | awk '{print $2}' | xargs kill
30 7,12,18 * * * ps -aux | grep vscode | awk '{print $2}' | xargs kill

# Apps
0 10 * * * /usr/bin/docker start certbot -a > /opt/apps/certbot/log/cron.log
30 9 * * * /usr/bin/docker exec -i docker-proxy /usr/sbin/nginx -s reload > /opt/docker-proxy/reload-log.log

# Custom
    EOD;
  }

}
