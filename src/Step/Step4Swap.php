<?php

namespace Srvr\Step;

/**
 * Step1 Clear.
 */
class Step4Swap extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $cmd = [
      'swapon --show=SIZE',
      'free --giga -h -t',
    ];
    $current = $this->currentMem();
    if ($current['swap'] < $current['mem']) {
      $swap = $current['mem'] - $current['swap'] = 2;
      $swap = ($swap > 32) ? 32 : $swap;
      $this->io->warning("Swap ON {$swap}G");
      $swapon = [
        "fallocate -l {$swap}G /swapfile",
        'chmod 600 /swapfile',
        'mkswap /swapfile',
        'swapon /swapfile',
        'echo "/swapfile none swap sw 0 0" >> /etc/fstab',
      ];
      if (!file_exists('/swapfile')) {
        $this->execCommands($swapon);
      }
    }

    $result = $this->execCommands($cmd);
    dump($result);
    return 1;
  }

  /**
   * Current Mem.
   */
  private function currentMem() : array {
    $current = $this->exec('free -g');
    $lines = explode("\n", $current);
    return [
      'mem' => trim(substr($lines[1], 15, 6)),
      'swap' => trim(substr($lines[2], 15, 6)),
    ];
  }

}
