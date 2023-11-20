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
    $name = str_replace(".", "-", $_ENV['SET_HOST']);
    $this->sedFile("SET_HOST = ", "SET_HOST = {$_ENV['SET_HOST']}", "etc/exim.conf");
    $this->sedFile("SET_HOST = ", "SET_HOST = $name", "etc/exim.conf");
    return 1;
  }

}
