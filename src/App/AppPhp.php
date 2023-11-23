<?php

namespace Srvr\App;

/**
 * Php-service.
 */
class AppPhp extends AppBase {

  //phpcs:ignore
  protected string $name = 'php';

  /**
   * Run!
   */
  public function run() : bool {
    $this->cp($this->name);
    return 1;
  }

}
