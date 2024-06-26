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
  protected array $info;
  protected string $tkey;
  protected string $value;
  protected SymfonyStyle $io;
  //phpcs:enable

  /**
   * Constructor.
   */
  public function __construct(string $value, SymfonyStyle $io) {
    $this->io = $io;
    $this->value = $value;
    $this->tkey = date('Y-m-dTH-i-s');
    $this->info();
  }

  /**
   * Info.
   */
  protected function info() : void {
    $this->io->note($this->value);
  }

  /**
   * Current data.
   */
  public function setInfo(array $info) : self {
    $this->info = $info;
    return $this;
  }

  /**
   * Shell exec commnads.
   */
  public function execCommands($commnds) : string {
    $result = "";
    foreach ($commnds as $cmd) {
      $result .= $this->exec($cmd) . "\n";
    }
    return $result;
  }

  /**
   * Shell exec with symfony process.
   */
  public function exec(string|array $cmd, float $timeout = 999999) : string {
    if (is_array($cmd)) {
      $process = new Process($cmd, NULL, [
        'DEBIAN_FRONTEND' => 'noninteractive',
      ]);
    }
    else {
      $process = Process::fromShellCommandline($cmd, NULL, [
        'DEBIAN_FRONTEND' => 'noninteractive',
      ]);
    }
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
