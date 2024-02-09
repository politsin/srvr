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
    $this->exec(['rm', '-f', '/root/.bashrc']);
    $this->exec(['rm', '-f', '/root/.bash_profile']);
    $this->exec(['mkdir', '-p', '/root/.ssh']);
    foreach ($this->files() as $file => $source) {
      $data = file_get_contents($source);
      // $this->exec(['echo', "\"$data\"", '>', $file]);
      file_put_contents($file, $data, FILE_APPEND);
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
