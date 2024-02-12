<?php

namespace Srvr\System;

/**
 * System architecture x86_64.
 */
class ArchX64 extends Linux {

  //phpcs:disable
  protected string $arch = 'x86_64';
  protected array $extras = [
    // 'apt install lm-sensors i2c-tools'
  ];
  //phpcs:enable

  /**
   * Commands.
   */
  public function getCommands() : array {
    return $this->extras;
  }

}
