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
  public function exec(array $cmd) : string {
    $process = new Process($cmd);
    $process->run();
    if (!$process->isSuccessful()) {
      throw new ProcessFailedException($process);
    }
    return $process->getOutput();
  }

}
