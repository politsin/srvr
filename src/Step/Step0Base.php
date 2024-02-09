<?php

namespace Srvr\Step;

use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Step Base.
 */
abstract class Step0Base {

  //phpcs:disable
  protected string $value;
  protected SymfonyStyle $io;
  //phpcs:enable

  /**
   * Constructor.
   */
  public function __construct(string $value, SymfonyStyle $io) {
    $this->io = $io;
    $this->value = $value;
  }

  /**
   * Info.
   */
  protected function info() : void {

  }

  /**
   * Current data.
   */
  public function exec(array $cmd, float $timeout = 999999) : string {
    $process = new Process($cmd, NULL, [
      'DEBIAN_FRONTEND' => 'noninteractive',
    ]);
    $process->setTimeout($timeout);
    if (TRUE) {
      // dump(implode(" ", $cmd));.
      // return "";.
    }
    $process->run();
    if (!$process->isSuccessful()) {
      throw new ProcessFailedException($process);
    }
    return $process->getOutput();
  }

}
