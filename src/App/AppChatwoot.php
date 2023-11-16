<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Chatwoot.
 */
class AppChatwoot extends AppBase {

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $name = 'chatwoot';
    $this->cp($name);
    return 1;
  }

}
