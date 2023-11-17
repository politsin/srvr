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
  public function run() : bool {
    $this->cp($this->name);
    $this->setPass();
    $this->setPass('KIBANA_PASSWORD=');
    $this->setPass('ENCRYPTION_KEY=');
    $this->setHost();
    return 1;
  }

}
