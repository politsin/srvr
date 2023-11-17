<?php

namespace Srvr\App;

/**
 * Chatwoot.
 */
class AppMetabase extends AppBase {


  //phpcs:ignore
  protected string $name = 'metabase';

  /**
   * Run!
   */
  public function run() : bool {
    $this->cp($this->name);
    $this->setUser();
    $this->setPass();
    return 1;
  }

}
