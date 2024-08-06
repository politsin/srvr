<?php

namespace Srvr\Step;

/**
 * Step1 Clear.
 */
class Step2Util extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $install = [
      'ca-certificates',
      'apache2-utils',
      'mc',
      'git',
      'nnn',
      'zip',
      'htop',
      'curl',
      'ncdu',
      'sudo',
      'unzip',
      'python3',
      'dnsutils',
      'sendemail',
      'net-tools',
      'inetutils-ping',
      'software-properties-common',
    ];
    $this->exec(['apt', 'install', '-y', ...$install, '--no-install-recommends']);
    return 1;
  }

}
