<?php

namespace Srvr\Step;

/**
 * Step8 Clear.
 */
class Step3GitUser extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $gituser = $_ENV['GIT_USER'] ?: 'Anatoly Politsin';
    $gitmail = $_ENV['GIT_MAIL'] ?: 'politsin@gmail.com';
    $cmd = [
      "git config --global user.name '$gituser'",
      "git config --global user.email $gitmail",
      'git config --global push.default simple',
    ];
    $this->execCommands($cmd);
    $me = trim($this->exec(['whoami']));
    $result = $this->execCommands([
      "/usr/bin/cat /$me/.gitconfig",
    ]);
    dump($result);
    return 1;
  }

}
