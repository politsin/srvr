<?php

namespace Srvr\Step;

/**
 * Step1 Clear.
 */
class Step1Clear extends Step0Base {

  /**
   * Run!
   */
  public function run(string $value) : bool {

    $this->exec([
      'apt',
      'remove',
      '-y',
      'exim4-base',
      'exim4-config',
      'exim4-daemon-light',
      'apache2',
      'vim',
      'vim-common',
      'vim-tiny',
    ]);
    $this->exec(['apt', 'autoremove', '-y']);
    return 1;
  }

}
