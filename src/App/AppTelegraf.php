<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Telegraf - metrics.
 */
class AppTelegraf extends AppBase {

  //phpcs:ignore
  protected string $name = 'telegraf';

  /**
   * Run!
   */
  public function run() : bool {
    $this->cp($this->name);
    return 1;
  }

}
