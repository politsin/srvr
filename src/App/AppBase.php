<?php

namespace Srvr\App;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * App Base - Abstract class.
 */
abstract class AppBase {

  /**
   * Constructor.
   */
  public function __construct() {
  }

  /**
   * Cp Directory.
   */
  public function cp(string $name) : string {
    return $this->exec(['cp', '-r', "{$_ENV['ACCETS']}/apps/$name", '/opt/apps']);
  }

  /**
   * Current data.
   */
  public function exec(array $cmd, float $timeout = 999999) : string {
    $process = new Process($cmd, NULL, [
      'DEBIAN_FRONTEND' => 'noninteractive',
    ]);
    $process->setTimeout($timeout);
    $process->run();
    if (!$process->isSuccessful()) {
      throw new ProcessFailedException($process);
    }
    return $process->getOutput();
  }

}
