<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;

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
    $this->cp($this->name);
    $domains = $this->io->ask('Domains', NULL, function ($answer) {
      $answer = str_replace(",", " ", $answer);
      $answer = str_replace("  ", " ", $answer);
      return explode(" ", $answer);
    });
    $env = "";
    foreach ($domains as $key => $value) {
      $env .= "-d {$value} ";
    }
    $this->setEnv("HOSTS=", $env);
    // todo:
    // start.sh
    // recurrent.sh $domains[0]
    // Cron (README.md)
    // docker-proxy
    return 1;
  }

}
