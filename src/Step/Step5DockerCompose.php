<?php

namespace Srvr\Step;

/**
 * Step1 Clear.
 */
class Step5DockerCompose extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $version = "v2.26.1";
    $arch = "x86_64";
    $this->io->warning("TODO: arch: $arch");
    $compose = "https://github.com/docker/compose/releases/download/{$version}/docker-compose-linux-$arch";
    $this->execCommands([
      "curl -SL $compose -o /usr/local/lib/docker/cli-plugins/docker-compose",
      "chmod +x /usr/local/lib/docker/cli-plugins/docker-compose",
    ]);
    $result = $this->exec("docker compose version");
    dump($result);
    return 1;
  }

}
