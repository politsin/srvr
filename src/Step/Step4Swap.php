<?php

namespace Srvr\Step;

/**
 * Step1 Clear.
 */
class Step4Swap extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $this->exec(['fallocate', '-l', '4G', '/swapfile']);
    $this->exec(['chmod', '600', '/swapfile']);
    $this->exec(['mkswap', '/swapfile']);
    $this->exec(['swapon', '/swapfile']);
    $this->exec(['echo', '/swapfile none swap sw 0 0', '>>', '/etc/fstab']);
    return 1;
  }

}
