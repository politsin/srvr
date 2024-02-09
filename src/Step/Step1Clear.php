<?php

namespace Srvr\Step;

/**
 * Step1 Clear.
 */
class Step1Clear extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $remove = [
      'exim4-base',
      'exim4-config',
      'exim4-daemon-light',
      'apache2',
      'nginx',
      'vim',
      'vim-common',
      'vim-tiny',
    ];
    $this->exec(['apt', 'remove', '-y', ...$remove, '--purge']);
    $this->exec(['apt', 'autoremove', '-y']);
    return 1;
  }

}
