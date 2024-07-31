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
    $swapon = [
      'fallocate -l 4G /swapfile',
      'chmod 600 /swapfile',
      'mkswap /swapfile',
      'swapon /swapfile',
      'echo "/swapfile none swap sw 0 0" >> /etc/fstab',
    ];
    if (!file_exists('/swapfile')) {
      $this->execCommands($swapon);
    }
    $result = $this->execCommands($cmd);
    dump($result);
    return 1;
  }

}
