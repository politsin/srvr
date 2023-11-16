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
    $name = 'clickhouse';
    $this->cp($name);
    return 1;
  }

}
