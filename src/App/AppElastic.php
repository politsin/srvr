<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Elastic search with kibana.
 */
class AppElastic extends AppBase {

  //phpcs:ignore
  protected string $name = 'elastic';

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $this->cp($this->name);
    return 1;
  }

}
