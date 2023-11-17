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
    $pass = $this->genPass();
    $this->sedFile("default_pass =", "default_pass = $pass", ".etc/rabbitmq.conf");
    $cookie = $this->genPass();
    $this->echo($cookie, ".etc/.erlang.cookie");
    return 1;
  }

}
