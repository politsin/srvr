<?php

namespace Srvr\App;

/**
 * Openvpn - vpn.
 */
class AppOpenVpn extends AppBase {

  //phpcs:ignore
  protected string $name = 'openvpn';

  /**
   * Run!
   */
  public function run() : bool {
    // @todo можно ещё сделать автоматическое скачивание конфига.
    $this->cp($this->name);
    return 1;
  }

}
