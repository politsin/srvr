<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Socks5 proxy.
 */
class AppSocks5 extends AppBase {

  //phpcs:ignore
  protected string $name = 'socks5';

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $this->cp($this->name);
    return 1;
  }

}
