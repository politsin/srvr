<?php

namespace Srvr\System;

/**
 * System architecture Arm/aarch64.
 */
class ArchArm extends Linux {

  //phpcs:disable
  protected string $arch = 'aarch64';
  protected array $extras =[
    // 'apt install lm-sensors i2c-tools',
    'apt install php-mbstring php8.1-gmp -y --no-install-recommends',
    // 'pecl install dio',
    'pecl install channel://pecl.php.net/dio-0.2.0',
    // 'pecl install channel://pecl.php.net/dio-0.3.0RC1',
    'echo "extension=dio.so" > /etc/php/8.1/mods-available/dio.ini',
    'ln -s /etc/php/8.1/mods-available/dio.ini /etc/php/8.1/cli/conf.d/20-dio.ini',
  ];
  //phpcs:enable
  // # PhpCS:::
  //  mkdir /var/lib/composer && \
  //  cd /var/lib/composer && \
  //  wget https://raw.githubusercontent.com/politsin/snipets/master/patch/composer.json && \
  //  composer install -o && \
  //  sed -i 's/snap/var\/lib\/composer\/vendor/g' /etc/environment && \
  //  /var/lib/composer/vendor/bin/phpcs -i && \
  //  /var/lib/composer/vendor/bin/phpcs --config-set colors 1 && \
  //  /var/lib/composer/vendor/bin/phpcs --config-set default_standard Drupal && \
  //  /var/lib/composer/vendor/bin/phpcs --config-show
  // custom bin
  // .bashrc: export PATH="$PATH:/opt/console/vendor/bin"

  /**
   * Commands.
   */
  public function getCommands() : array {
    return $this->extras;
  }

}
