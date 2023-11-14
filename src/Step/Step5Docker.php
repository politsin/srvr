<?php

namespace Srvr\Step;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Step1 Clear.
 */
class Step5Docker extends Step0Base {

  /**
   * Run!
   */
  public function run(string $value, SymfonyStyle $io) : bool {
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
