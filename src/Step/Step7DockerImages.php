<?php

namespace Srvr\Step;

/**
 * Step7 Docker Images.
 */
class Step7DockerImages extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $images = [
      'synstd/php:8.3',
      'synstd/s3-dockup:latest',
      'mariadb:10.6',
    ];
    foreach ($images as $image) {
      $this->io->writeln("pull: $image");
      $this->exec("docker pull $image");
    }
    return 1;
  }

}
