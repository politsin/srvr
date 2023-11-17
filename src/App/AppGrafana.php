<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Grafana - dashboard.
 */
class AppGrafana extends AppBase {

  //phpcs:ignore
  protected string $name = 'grafana';

  /**
   * Run!
   */
  public function run() : bool {
    $this->cp($this->name);
    $this->exec(["chown", ":472", "/opt/apps/certbot/tls/private.pem"]);
    $this->exec(["chown", ":472", "/opt/apps/certbot/tls/fullchain.pem"]);
    return 1;
  }

}
