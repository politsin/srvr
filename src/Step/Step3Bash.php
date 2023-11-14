<?php

namespace Srvr\Step;

use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Step1 Clear.
 */
class Step3Bash extends Step0Base {

  /**
   * Run!
   */
  public function run(string $value, SymfonyStyle $io) : bool {
    $this->exec(['rm', '-f', '/root/.bashrc']);
    $this->exec(['rm', '-f', '/root/.bash_profile']);
    $this->exec(['mkdir', '-p', '/root/.ssh']);
    foreach ($this->files() as $file => $source) {
      $data = file_get_contents($source);
      $io->comment("{$source}");
      $this->exec(['echo', "$data", '>', $file]);
    }
    $this->exec(['chmod', '700', '/root/.ssh']);
    $this->exec(['chmod', '600', '/root/.ssh/authorized_keys']);
    // $this->exec(['chmod', '644', '/root/.ssh/id_rsa.pub']);
    return 1;
  }

  /**
   * Files.
   */
  private function files() : array {
    $path = "https://raw.githubusercontent.com/politsin/snipets/master/sh";
    return [
      '/root/.ssh/authorized_keys' => "$path/authorized_keys",
      '/root/.bashrc' => "$path/.bash_profile",
      '/root/.bash_profile' => "$path/.bash_profile",
    ];
  }

}
