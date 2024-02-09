<?php

namespace Srvr\Step;

/**
 * Step1 Clear.
 */
class Step5Docker extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $this->exec([
      'apt',
      'install',
      '-y',
      'docker.io',
      'docker-compose',
    ]);
    return 1;
  }

}
