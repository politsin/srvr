<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

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
    $this->exec(['whoami']);
    return 1;
  }

}
