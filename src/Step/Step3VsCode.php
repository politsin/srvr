<?php

namespace Srvr\Step;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Step3 VsCode.
 */
class Step3VsCode extends Step0Base {

  /**
   * Run!
   */
  public function run(string $value, SymfonyStyle $io) : bool {
    // @todo monitor files.
    $this->exec(['whoami']);
    $io->warning('@todo monitor files');
    return 1;
  }

}
