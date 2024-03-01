<?php

namespace Srvr\Step;

/**
 * Step8 Clear.
 */
class Step8FsMaxWatches extends Step0Base {

  /**
   * Run!
   */
  public function run() : bool {
    $default = [
      'max_queued_events' => 16384,
      'max_user_instances' => 128,
      'max_user_watches' => 65536,
    ];
    $ok = [
      'max_queued_events' => 16384,
      'max_user_instances' => 1024,
      'max_user_watches' => 6553699,
    ];
    $current = $this->exec(['sysctl', 'fs.inotify']);
    dump($current);
    foreach ($ok as $key => $value) {
      $this->exec(['sysctl', '-w', "fs.inotify.$key=$value"]);
    }
    $current = $this->exec(['sysctl', 'fs.inotify']);
    dump($current);
    return 1;
  }

}
