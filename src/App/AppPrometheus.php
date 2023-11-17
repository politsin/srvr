<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Prometheus - metrics.
 */
class AppPrometheus extends AppBase {

  //phpcs:ignore
  protected string $name = 'prometheus';

  /**
   * Run!
   */
  public function run() : bool {
    $this->cp($this->name);
    return 1;
  }

}
