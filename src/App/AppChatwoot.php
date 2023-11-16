<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Chatwoot.
 */
class AppChatwoot extends AppBase {

  //phpcs:ignore
  protected string $name = 'chatwoot';

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $this->cp($this->name);
    return 1;
  }

}
