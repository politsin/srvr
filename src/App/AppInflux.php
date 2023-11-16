<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Influx - time series db.
 */
class AppInflux extends AppBase {

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $name = 'influx';
    $this->cp($name);
    return 1;
  }

}
