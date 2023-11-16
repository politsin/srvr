<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Grafana - dashboard.
 */
class AppGrafana extends AppBase {

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $name = 'grafana';
    $this->cp($name);
    return 1;
  }

}
