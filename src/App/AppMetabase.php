<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

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
    $this->exec(['whoami']);
    return 1;
  }

}
