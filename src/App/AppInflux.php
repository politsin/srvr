<?php

namespace Srvr\App;

/**
 * Influx - time series db.
 */
class AppInflux extends AppBase {

  //phpcs:ignore
  protected string $name = 'influx';

  /**
   * Run!
   */
  public function run() : bool {
    $this->cp($this->name);
    return 1;
  }

}
