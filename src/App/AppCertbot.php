<?php

namespace Srvr\App;

/**
 * Certbot - Lets Encrypt certs.
 */
class AppCertbot extends AppBase {

  //phpcs:ignore
  protected string $name = 'certbot';

  /**
   * Run!
   */
  public function run() : bool {
    // @todo
    // Cron (README.md)
    // docker-proxy.
    $this->cp($this->name);
    $domains = $this->io->ask('Domains', $_ENV['HOST'], function ($answer) {
      $answer = str_replace(",", " ", $answer);
      $answer = str_replace("  ", " ", $answer);
      return explode(" ", $answer);
    });
    $hosts = "";
    foreach ($domains as $value) {
      $hosts .= "-d {$value} ";
    }
    $this->setEnv("HOSTS=", $hosts);
    $this->sedFile('${HOST}', $_ENV['HOST'], "recurrent.sh");

    return 1;
  }

}
