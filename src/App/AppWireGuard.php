<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Wireguard - vpn.
 */
class AppWireGuard extends AppBase {

  //phpcs:ignore
  protected string $name = 'wireguard';

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $this->cp($this->name);
    return 1;
  }

}
