<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Rabbitmq - message broker.
 */
class AppRabbitMQ extends AppBase {

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $name = 'rabbitmq';
    $this->cp($name);
    return 1;
  }

}
