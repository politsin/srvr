<?php

namespace Srvr\App;

/**
 * Clickhouse.
 */
class AppClickhouse extends AppBase {

  //phpcs:ignore
  protected string $name = 'clickhouse';

  /**
   * Run!
   */
  public function run() : bool {
    $this->cp($this->name);
    $this->setUser();
    $this->setPass();
    $this->setHost();
    return 1;
  }

}
