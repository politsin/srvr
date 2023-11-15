<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Clickhouse.
 */
class AppClickhouse extends AppBase {

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $this->exec(['whoami']);
    return 1;
  }

}
