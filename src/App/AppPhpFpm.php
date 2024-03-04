<?php

namespace Srvr\App;

/**
 * Php-fpm.
 */
class AppPhpFpm extends AppBase {

  //phpcs:ignore
  protected string $name = 'php-fpm';

  /**
   * Run!
   */
  public function run() : bool {
    $this->cp($this->name);
    $this->exec([
      'chown',
      '-R',
      'www-data:www-data',
      '/opt/apps/php-fpm/www-home',
    ]);
    return 1;
  }

}
