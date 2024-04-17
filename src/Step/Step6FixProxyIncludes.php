<?php

namespace Srvr\Step;

/**
 * Step8 Clear.
 */
class Step6FixProxyIncludes extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $this->exec([
      'mv',
      '/opt/docker-proxy/includes',
      "/opt/sites/0-old/nginx-includes-{$this->tkey}",
    ]);
    $this->exec([
      'cp',
      '-r',
      "{$_ENV['ACCETS']}/docker-proxy/includes",
      '/opt/docker-proxy/includes',
    ]);
    $this->exec(['docker', 'restart', 'docker-proxy']);
    return 1;
  }

}
