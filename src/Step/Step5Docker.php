<?php

namespace Srvr\Step;

/**
 * Step1 Clear.
 */
class Step5Docker extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $version = "v2.26.1";
    $arch = "x86_64";
    $this->io->warning("TODO: arch: $arch");
    $compose = "https://github.com/docker/compose/releases/download/{$version}/docker-compose-linux-$arch";
    $dir = "/usr/local/lib/docker/cli-plugins";
    $this->execCommands([
      'apt install -y docker.io docker-compose',
      "mkdir -p $dir",
      "rm -f $dir/docker-compose",
      "curl -SL $compose -o $dir/docker-compose",
      "chmod +x $dir/docker-compose",
    ]);
    return 1;
  }

}
