<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Redis - key value store.
 */
class AppRedis extends AppBase {

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $name = 'redis';
    $this->cp($name);
    return 1;
  }

}
