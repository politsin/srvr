<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Certbot - Lets Encrypt certs.
 */
class AppCertbot extends AppBase {

  //phpcs:ignore
  protected string $name = 'certbot';

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $this->cp($this->name);
    return 1;
  }

}
