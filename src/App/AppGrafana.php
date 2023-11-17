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
  public function run() : bool {
    $this->cp($this->name);
    // todo: mkdir ./data && chown 999:999 ./data
    return 1;
  }

}
