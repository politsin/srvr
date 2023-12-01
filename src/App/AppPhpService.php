<?php

namespace Srvr\App;

/**
 * Php-service.
 */
class AppPhpService extends AppBase {

  //phpcs:ignore
  protected string $name = 'php-service';

  /**
   * Run!
   */
  public function run() : bool {
    $this->cp($this->name);
    return 1;
  }

}
