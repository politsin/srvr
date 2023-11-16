<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Prometheus - metrics.
 */
class AppPrometheus extends AppBase {

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $name = 'prometheus';
    $this->cp($name);
    return 1;
  }

}
