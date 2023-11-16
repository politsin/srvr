<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Chatwoot.
 */
class AppMattermost extends AppBase {


  //phpcs:ignore
  protected string $name = 'bridge';

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $this->exec(['whoami']);
    return 1;
  }

}
