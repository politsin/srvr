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
    $hello = [
      "sysctl fs.inotify",
      "fs.inotify.max_queued_events = 16384", 
      "`fs.inotify.max_user_instances` = 128", 
      "fs.inotify.max_user_watches = 65536", 
      "sysctl fs.inotify", 
      "fs.inotify.max_user_instances = 128", 
      "sysctl -w fs.inotify.max_user_instances=256", 
      "sysctl -w fs.inotify.max_user_watches=256 sysctl -w fs.inotify.max_user_watches=6553699 sysctl -w fs.inotify.max_user_instances=1024",
    ];
    $this->io->warning("@todo max_user_watches");
    $this->io->error(implode("\n", $hello));
    // $this->exec(['crontab', '-r']);
    return 1;
  }

}
