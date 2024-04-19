<?php

namespace Srvr\Step;

/**
 * Step1 Clear.
 */
class Step3Bash extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $this->execCommands([
      'rm -f /root/.bashrc',
      'rm -f /root/.bash_profile',
      'mkdir -p /root/.ssh',
    ]);
    foreach ($this->files() as $file => $source) {
      $data = file_get_contents($source);
      file_put_contents($file, $data, FILE_APPEND);
    }
    $this->execCommands([
      'chmod 700 /root/.ssh',
      'chmod 600 /root/.ssh/authorized_keys',
    ]);
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
