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
    $this->execCommands([
      'apt update',
      'apt upgrade -yf',
      'apt autoremove -y',
    ]);
    return 1;
  }

}
