<?php

namespace Srvr\Step;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Docker Proxy.
 */
class Step6DockerProxy extends Step0Base {

  /**
   * Run!
   */
  public function run(string $value, SymfonyStyle $io) : bool {
    $this->exec([
      'cp',
      '-r',
      "{$_ENV['ACCETS']}/docker-proxy",
      '/opt/docker-proxy',
    ]);
    return 1;
  }

}
