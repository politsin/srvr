<?php

namespace Srvr\Step;

/**
 * Step 9 Time Zone.
 */
class Step9TimeZone extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $this->io->warning("not ready yeat");
    $this->exec([
      'whoami',
    ]);
    return 1;
  }

}
