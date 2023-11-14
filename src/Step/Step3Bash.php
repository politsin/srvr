<?php

namespace Srvr\Step;

/**
 * Step1 Clear.
 */
class Step3Bash extends Step0Base {

  /**
   * Run!
   */
  public function run(string $value) : bool {
    // Sudo su root
    // cat /home/ubuntu/.ssh/authorized_keys > /root/.ssh/authorized_keys
    // cat /root/.ssh/authorized_keys
    // cd ~
    // wget https://raw.githubusercontent.com/politsin/snipets/master/sh/.bash_profile
    // rm ~/.bashrc
    // wget https://raw.githubusercontent.com/politsin/snipets/master/sh/.bashrc
    $this->exec([
      'apt',
      'install',
    ]);
    return 1;
  }

}
