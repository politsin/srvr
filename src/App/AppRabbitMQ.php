<?php

namespace Srvr\App;

/**
 * Rabbitmq - message broker.
 */
class AppRabbitMQ extends AppBase {

  //phpcs:ignore
  protected string $name = 'rabbitmq';

  /**
   * Run!
   */
  public function run() : bool {
    if ($this->cp($this->name)) {
      $pass = $this->genPass();
      $this->sedFile("default_pass =", "default_pass = $pass", "etc/rabbitmq.conf");
      $cookie = $this->genPass();
      $this->echo($cookie, "etc/.erlang.cookie");
      $this->exec(["chown", "999:999", "/opt/apps/certbot/tls/private.pem"]);
      $this->exec(["chown", "999:999", "/opt/apps/certbot/tls/fullchain.pem"]);
      $this->exec(["mkdir", "/opt/apps/rabbitmq/data"]);
      $this->exec(["chown", "999:999", "/opt/apps/rabbitmq/data"]);
      $this->exec(["chown", "999:999", "/opt/apps/rabbitmq/etc/.erlang.cookie"]);
      $this->exec(["chmod", "600", "/opt/apps/rabbitmq/etc/.erlang.cookie"]);
      // @todo restart.
      return TRUE;
    }
    return FALSE;

  }

}
