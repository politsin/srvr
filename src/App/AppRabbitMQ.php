<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Rabbitmq - message broker.
 */
class AppRabbitMQ extends AppBase {

  //phpcs:ignore
  protected string $name = 'rabbitmq';

  /**
   * Run!
   */
  public function run(SymfonyStyle $io) : bool {
    $this->cp($this->name);
    return 1;
  }

}
