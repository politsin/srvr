<?php

namespace Srvr\System;

/**
 * System architecture Arm/aarch64.
 */
abstract class ArchArm extends Linux {

  //phpcs:disable
  protected string $arch = 'aarch64';
  protected array $extras =[
    // 'apt install lm-sensors i2c-tools',
    'apt install php8.1-gmp -y --no-install-recommends',
    'pecl install -y dio',
    'pecl install -y channel://pecl.php.net/dio-0.2.1',
    'echo "extension=dio.so" > /etc/php/8.1/mods-available/dio.ini',
    'ln -s /etc/php/8.1/mods-available/dio.ini /etc/php/8.1/cli/conf.d/20-dio.ini',
  ];
  //phpcs:enable

  /**
   * Commands.
   */
  public function getCommands() : array {
    return $this->extras;
  }

}
