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
    else {
      $this->io->warning("docker-rest already exists");
    }
    $pass = '/opt/docker-rest/passwd';
    $this->io->writeln("password: " . file_get_contents($pass));
    return 1;
  }

}
