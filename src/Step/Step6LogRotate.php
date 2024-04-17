<?php

namespace Srvr\Step;

/**
 * Step8 Clear.
 */
class Step6LogRotate extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $this->exec(['logrotate', '--version']);
    $this->exec(['cp', "{$_ENV['ACCETS']}/etc/logrotate.d/exim", '/etc/logrotate.d/exim']);
    $this->exec(['cp', "{$_ENV['ACCETS']}/etc/logrotate.d/docker-proxy", '/etc/logrotate.d/docker-proxy']);
    $result = $this->exec(['/usr/bin/cat', "/etc/logrotate.d/exim"]);
    dump($result);
    $result = $this->exec(['/usr/bin/cat', "/etc/logrotate.d/docker-proxy"]);
    dump($result);
    return 1;
  }

}
