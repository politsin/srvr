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
    $this->exec([
      'cp',
      '-r',
      "{$_ENV['ACCETS']}/docker-rest",
      '/opt/docker-rest',
    ]);
    return 1;
  }

}
