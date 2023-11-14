<?php

namespace Srvr\Step;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Step1 Clear.
 */
class Step2Util extends Step0Base {

  /**
   * Run!
   */
  public function run(string $value, SymfonyStyle $io) : bool {
    $this->exec([
      'apt',
      'install',
      '-y',
      'ca-certificates',
      'apache2-utils',
      'mc',
      'git',
      'nnn',
      'zip',
      'htop',
      'curl',
      'ncdu',
      'unzip',
      'python3',
      'dnsutils',
      'net-tools',
      'inetutils-ping',
      'software-properties-common',
    ]);
    return 1;
  }

}
