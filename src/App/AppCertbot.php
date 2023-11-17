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
  public function run(SymfonyStyle $io) : bool {
    $this->cp($this->name);
    $domains = $this->io->ask('Domains', NULL, function ($answer) {
      $answer = str_replace(",", " ", $answer);
      $answer = str_replace("  ", " ", $answer);
      return explode(" ", $answer);
    });
    print_r($domains);
    $env = ""
    foreach ($variable as $key => $value) {
      $env .= "-d {$value} ";
    }
    $this->setEnv("HOSTS=", $env);
    return 1;
  }

}
