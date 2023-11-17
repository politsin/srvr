<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Redis - key value store.
 */
class AppRedis extends AppBase {

  //phpcs:ignore
  protected string $name = 'redis';

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $this->io = $io;
    $this->cp($this->name);
    $this->setPass();
    return 1;
  }

}
