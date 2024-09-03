<?php

namespace Srvr\App;

/**
 * Wireguard - vpn.
 */
class AppWireGuard extends AppBase {

  //phpcs:ignore
  protected string $name = 'wireguard';

  /**
   * Run!
   */
  public function run() : bool {
    $this->cp($this->name);
    $this->setHost();
    $pass = $this->setPass();
    // Bcrypt password.
    $hash = password_hash($pass, PASSWORD_BCRYPT);
    // $hash = "docker run ghcr.io/wg-easy/wg-easy wgpw $pass";
    $this->setEnv('PASSWORD_HASH', $hash);
    return 1;
  }

}
