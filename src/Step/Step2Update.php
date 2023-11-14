<?php

namespace Srvr\Step;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Step1 Clear.
 */
class Step2Update extends Step0Base {

  /**
   * Run!
   */
  public function run(string $value, SymfonyStyle $io) : bool {
    $this->exec(['apt', 'update']);
    $this->exec(['apt', 'upgrade', '-y']);
    $this->exec(['apt', 'autoremove', '-y']);
    return 1;
  }

}
