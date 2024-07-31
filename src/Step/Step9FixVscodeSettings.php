<?php

namespace Srvr\Step;

/**
 * Step 9 Fix Vscode Settings.
 */
class Step9FixVscodeSettings extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $src = "{$_ENV['ASSETS']}/apps/php-fpm/www-home/.vscode/settings.json";
    $dst = "/opt/apps/php-fpm/www-home/.vscode/settings.json";
    $settings = file_get_contents($src);
    file_put_contents($dst, $settings);
    return 1;
  }

}
