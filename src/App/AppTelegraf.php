<?php

namespace Srvr\App;

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
    $this->setHost();
    return 1;
  }

}
