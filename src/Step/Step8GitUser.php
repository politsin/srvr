<?php

namespace Srvr\Step;

/**
 * Step8 Clear.
 */
class Step8GitUser extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $this->exec(['git', 'config', '--global', 'user.name', 'Anatoly' . 'Politsin']);
    $this->exec(['git', 'config', '--global', 'user.email', 'politsin@gmail.com']);
    $this->exec(['git', 'config', '--global', 'push.default', 'simple']);
    $result = $this->exec(['/usr/bin/cat', '~/.gitconfig']);
    dump($result);
    return 1;
  }

}
