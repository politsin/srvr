<?php

namespace Srvr\App;

/**
 * Chatwoot.
 */
class AppMattermost extends AppBase {

  //phpcs:ignore
  protected string $name = 'mattermost';

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
