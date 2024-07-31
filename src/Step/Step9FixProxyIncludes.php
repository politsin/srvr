<?php

namespace Srvr\Step;

/**
 * Step 9 Fix Proxy Includes.
 */
class Step9FixProxyIncludes extends Step0Base {

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
      "{$_ENV['ASSETS']}/docker-proxy/includes",
      '/opt/docker-proxy/includes',
    ]);
    $this->exec(['docker', 'restart', 'docker-proxy']);
    return 1;
  }

}
