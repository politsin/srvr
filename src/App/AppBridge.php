<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Bridge - php bridge MQTT to influx.
 */
class AppBridge extends AppBase {

  //phpcs:ignore
  protected $name = 'bridge';

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $this->exec(['whoami']);
    return 1;
  }

}
