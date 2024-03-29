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
    $info = $this->info;
    switch ($info['archClass']) {
      case 'ArchX64':
        $sys = new ArchX64();
        $commands = $sys->getCommands();
        break;

      case 'ArchArm':
        $sys = new ArchArm();
        $commands = $sys->getCommands();
        break;

      default:
        $commands = [];
        break;
    }
    foreach ($commands as $command) {
      $this->exec(explode(' ', $command));
    }
    return 0;
  }

}
