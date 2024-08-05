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
    $hosts = [];
    foreach ($domains as $host) {
      if (strpos($host, ".")) {
        $hosts[] = $host;
      }
    }
    $this->sedFile('HOSTS=', "HOSTS=" . implode(",", $hosts), ".env");
    $this->sedFile('${HOST}', $hosts[0], "recurrent.sh");

    return 1;
  }

}
