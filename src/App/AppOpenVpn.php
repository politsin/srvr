<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Openvpn - vpn.
 */
class AppOpenVpn extends AppBase {

  //phpcs:ignore
  protected string $name = 'openvpn';

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $this->cp($this->name);
    return 1;
  }

}
