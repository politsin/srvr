<?php

namespace Srvr\Step;

/**
 * Docker Proxy.
 */
class Step6DockerProxy extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $this->execCommands([
      "cp -r {$_ENV['ACCETS']}/docker-proxy /opt/docker-proxy",
      "/opt/docker-proxy/start.sh",
    ]);
    return 1;
  }

}
