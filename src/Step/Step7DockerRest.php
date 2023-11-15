<?php

namespace Srvr\Step;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Docker Rest.
 */
class Step7DockerRest extends Step0Base {

  /**
   * Run!
   */
  public function run(string $value, SymfonyStyle $io) : bool {
    $this->exec([
      'cp',
      '-r',
      "{$_ENV['ACCETS']}/docker-rest",
      '/opt/docker-rest',
    ]);
    return 1;
  }

}
