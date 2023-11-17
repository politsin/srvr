<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Clickhouse.
 */
class AppClickhouse extends AppBase {

  //phpcs:ignore
  protected string $name = 'clickhouse';

  /**
   * Run!
   */
  public function run() : bool {
    $this->cp($this->name);
    return 1;
  }

}
