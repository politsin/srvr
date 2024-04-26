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
    $src = "{$_ENV['ACCETS']}/apps/php-fpm/www-home/.vscode/settings.json";
    $settings = file_get_contents($src);
    $dst = "/opt/apps/php-fpm/www-home/.vscode/settings.json";
    $this->exec("echo '$settings' > $dst");
    return 1;
  }

}
