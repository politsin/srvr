<?php

namespace Srvr\Step;

/**
 * Docker Rest.
 */
class Step7DockerRest extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $this->execCommands([
      "cp -r {$_ENV['ACCETS']}/docker-rest /opt/docker-rest",
      "/opt/docker-rest/start.sh",
    ]);
    return 1;
  }

}
