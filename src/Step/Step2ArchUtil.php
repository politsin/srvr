<?php

namespace Srvr\Step;

use Srvr\System\ArchArm;
use Srvr\System\ArchX64;

/**
 * Step1 Clear.
 */
class Step2ArchUtil extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $info = $this->info();
    switch ($info['arch']) {
      case 'x86_64':
        $sys = new ArchX64();
        $commands = $sys->getCommands();
        break;

      case 'aarch64':
        $sys = new ArchArm();
        $commands = $sys->getCommands();
        break;

      default:
        $commands = [];
        break;
    }
    $this->exec($commands);
    return 1;
  }

}
