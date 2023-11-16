<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Influx - time series db.
 */
class AppInflux extends AppBase {

  //phpcs:ignore
  protected string $name = 'influx';

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $this->cp($this->name);
    return 1;
  }

}
