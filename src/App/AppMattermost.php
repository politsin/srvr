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
    return 1;
  }

}
