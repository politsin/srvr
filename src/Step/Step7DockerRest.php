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
    if (!file_exists('/opt/docker-rest')) {
      $this->execCommands([
        "cp -r {$_ENV['ASSETS']}/docker-rest /opt/docker-rest",
        "/opt/docker-rest/start.sh",
      ]);
    }

    return 1;
  }

}
