<?php

namespace Srvr\App;

/**
 * Exim - mail server.
 */
class AppExim extends AppBase {

  //phpcs:ignore
  protected string $name = 'exim';

  /**
   * Run!
   */
  public function run() : bool {
    $this->cp($this->name);
    $srv = str_replace(".", "-", $_ENV['HOST']);
    $this->sedFile("SET_HOST =", "SET_HOST = {$_ENV['HOST']}", "etc/exim.conf");
    $this->sedFile("SET_NAME =", "SET_NAME = $srv", "etc/exim.conf");
    return 1;
  }

}
