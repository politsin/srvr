<?php

namespace Srvr\System;

/**
 * System architecture Arm/aarch64.
 */
abstract class ArchArm extends Linux {

  //phpcs:disable
  protected string $arch = 'aarch64';
  protected string $extras = 'apt install lm-sensors i2c-tools';
  //phpcs:enable

}
