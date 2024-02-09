<?php

namespace Srvr\System;

/**
 * System architecture x86_64.
 */
abstract class ArchX64 extends Linux {

  //phpcs:disable
  protected string $arch = 'x86_64';
  protected string $extras = 'apt install lm-sensors i2c-tools';
  //phpcs:enable

}
