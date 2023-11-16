<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Grafana - dashboard.
 */
class AppGrafana extends AppBase {

  //phpcs:ignore
  protected string $name = 'grafana';

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $this->cp($this->name);
    return 1;
  }

}
