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
    $cron = [
      "# Dev: phpcs phpcbf vscode",
      "* * * * * ps -aux | grep phpcs | awk '{print $2}' | xargs kill",
      "* * * * * ps -aux | grep phpcbf | awk '{print $2}' | xargs kill",
      "30 7,12,18 * * * ps -aux | grep vscode | awk '{print $2}' | xargs kill",
      '*/10 * * * *  echo "" > $(docker inspect --format='{{.LogPath}}' docker-proxy)',
      '*/30 * * * *  echo "" > /opt/sites/2130-gruzovozkin/www-home/log/nginx-access.log',
    ];
    $this->io->warning("@todo set cron");
    $this->io->error(implode("\n", $cron));
    // $this->exec(['crontab', '-r']);
    return 1;
  }

}
