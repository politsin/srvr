<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Telegraf - metrics.
 */
class AppTelegraf extends AppBase {

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $name = 'telegraf';
    $this->cp($name);
    return 1;
  }

}
