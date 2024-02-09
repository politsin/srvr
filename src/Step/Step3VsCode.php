<?php

namespace Srvr\Step;

/**
 * Step3 VsCode.
 */
class Step3VsCode extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    // @todo monitor files.
    $this->exec(['whoami']);
    $this->io->warning('@todo monitor files');
    return 1;
  }

}
