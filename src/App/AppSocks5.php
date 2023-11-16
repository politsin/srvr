<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Socks5 proxy.
 */
class AppSocks5 extends AppBase {

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $name = 'socks5';
    $this->cp($name);
    return 1;
  }

}
