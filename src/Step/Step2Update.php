<?php

namespace Srvr\Step;

/**
 * Step1 Clear.
 */
class Step2Update extends Step0Base {

  /**
   * Run!
   */
  public function run(string $value) : bool {
    $this->exec(['apt', 'update']);
    $this->exec(['apt', 'upgrade', '-y']);
    $this->exec(['apt', 'autoremove', '-y']);
    return 1;
  }

}
