<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Certbot - Lets Encrypt certs.
 */
class AppCertbot extends AppBase {

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $this->exec(['whoami']);
    return 1;
  }

}
