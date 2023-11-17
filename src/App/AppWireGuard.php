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
    $this->io = $io;
    $this->cp($this->name);
    $this->setHost();
    $this->setPass();
    return 1;
  }

}
