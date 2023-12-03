<?php

namespace Srvr\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Echo.
 */
class Fix extends Command {

  //phpcs:disable
  protected OutputInterface $output;
  protected SymfonyStyle $io;
  //phpcs:enable

  /**
   * Config.
   */
  protected function configure() {
    $this
      ->setName('install')
      ->setDescription('creates new server installation');
  }

  /**
   * Exec.
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $this->output = $output;
    $this->io = new SymfonyStyle($input, $output);
    $this->io->title('Fix');
    $content = "
fs.inotify.max_queued_events = 32768
fs.inotify.max_user_instances = 512
fs.inotify.max_user_watches = 524288
    ";
    $cmd = [
      'sysctl fs.inotify',
      'nano /etc/sysctl.d/60-fs-inotify.conf',
      "echo '$content' > /etc/sysctl.d/60-fs-inotify.conf",
      'sysctl --system',
    ];
    return 0;
  }

  /**
   * Current data.
   */
  private function exec(array $cmd) : string {
    $process = new Process($cmd);
    $process->run();
    if (!$process->isSuccessful()) {
      throw new ProcessFailedException($process);
    }
    return $process->getOutput();
  }

}
