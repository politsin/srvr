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
    if (!file_exists('/opt/docker-proxy')) {
      $this->execCommands([
        "cp -r {$_ENV['ASSETS']}/docker-proxy /opt/docker-proxy",
        "/opt/docker-proxy/start.sh",
      ]);
    }
    else {
      $this->io->warning("docker-proxy already exists");
    }
    return 1;
  }

}
