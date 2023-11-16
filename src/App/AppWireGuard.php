<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Wireguard - vpn.
 */
class AppWireGuard extends AppBase {

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $name = 'wireguard';
    $this->cp($name);
    return 1;
  }

}
