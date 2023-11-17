<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Exim - mail server.
 */
class AppExim extends AppBase {

  //phpcs:ignore
  protected string $name = 'exim';

  /**
   * Run!
   */
  public function run() : bool {
    $this->cp($this->name);
    return 1;
  }

}
