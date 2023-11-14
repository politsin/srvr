<?php

namespace Srvr\Step;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Step1 Clear.
 */
class Step4Swap extends Step0Base {

  /**
   * Run!
   */
  public function run(string $value, SymfonyStyle $io) : bool {
    $this->exec(['fallocate', '-l', '4G', '/swapfile']);
    $this->exec(['chmod', '600', '/swapfile']);
    $this->exec(['mkswap', '/swapfile']);
    $this->exec(['swapon', '/swapfile']);
    $this->exec(['echo', '/swapfile none swap sw 0 0', '>>', '/etc/fstab']);
    return 1;
  }

}
