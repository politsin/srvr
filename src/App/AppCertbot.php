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
    // @todo reload tls: proxy, rabbit, influx.
    // @todo start.sh && recurrent.sh
    $this->cp($this->name);
    $this->setHost();
    $domains = $this->io->ask('Domains', NULL, function ($answer) {
      $answer = str_replace(",", " ", $answer);
      $answer = str_replace("  ", " ", $answer);
      return explode(" ", $answer);
    });
    $i = 0;
    foreach ($domains as $host) {
      $i++;
      // $this->sedFile("HOST={$value}", $_ENV['HOST'], "compose.yml");
      // $this->echo("HOST{$i}= -d {$host}", ".env");
      $this->io->warning("HOST{$i}= -d {$host}");
    }
    $this->sedFile('${HOST}', $_ENV['HOST'], "recurrent.sh");

    return 1;
  }

}
