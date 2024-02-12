<?php

namespace Srvr\Step;

/**
 * Step1 Clear.
 */
class Step2Update extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $this->exec(['apt', 'update']);
    $this->exec(['apt', 'upgrade', '-yf']);
    $this->exec(['apt', 'autoremove', '-y']);
    return 1;
  }

}
