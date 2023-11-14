<?php

namespace Srvr\Step;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Step Base.
 */
abstract class Step0Base {

  /**
   * Constructor.
   */
  public function __construct() {
  }

  /**
   * Current data.
   */
  public function exec(array $cmd, float $timeout = 999999) : string {
    // @todo export DEBIAN_FRONTEND=noninteractive
    $process = new Process($cmd);
    $process->setTimeout($timeout);
    $process->run();
    if (!$process->isSuccessful()) {
      throw new ProcessFailedException($process);
    }
    return $process->getOutput();
  }

}
