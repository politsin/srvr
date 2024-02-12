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
    $info = $this->value;
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
    $this->exec($commands);
    return 1;
  }

}
