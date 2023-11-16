<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Elastic search with kibana.
 */
class AppElastic extends AppBase {

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $name = 'elastic';
    $this->cp($name);
    return 1;
  }

}
