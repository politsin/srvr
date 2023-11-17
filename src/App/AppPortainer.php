<?php

namespace Srvr\App;

/**
 * Chatwoot.
 */
class AppPortainer extends AppBase {

  //phpcs:ignore
  protected string $name = 'portainer';

  /**
   * Run!
   */
  public function run() : bool {
    $this->cp($this->name);
    return 1;
  }

}
