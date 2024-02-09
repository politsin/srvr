<?php

namespace Srvr\Command;

use Srvr\System\System;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Echo.
 */
class Install extends Command {

  //phpcs:disable
  protected OutputInterface $output;
  protected SymfonyStyle $io;
  //phpcs:enable

  /**
   * Config.
   */
  protected function configure() {
    // @todo
    // docker plugin install elastic/elastic-logging-plugin:8.5.3
    // x.
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
    $this->io->title('Install');
    $system = new System($this->io);
    $info = $system->getInfo();
    if (file_exists('/opt/docker-proxy')) {
      $this->io->block('Already installed', 'error');
      dump($info);
      return 0;
    }
    $this->io->comment('Installing...');
    $steps = $this->installSteps();
    $system->install($steps);
    return 0;
  }

  /**
   * Servers.
   */
  private function installSteps() : array {
    $steps = [
      'Step1Clear' => "Clear apache, exim, etc",
      'Step2Update' => "Update system",
      'Step2Util' => "Util",
      // 'Step3TimeZone' => "Set TimeZone",
      'Step3Bash' => "Set Bash",
      'Step3VsCode' => "Set file monitor",
      'Step4Swap' => "Set Swap",
      'Step5Docker' => "Install Docker",
      'Step6DockerProxy' => "Docker Proxy",
      'Step7DockerRest' => "Docker Rest",
    ];
    return $steps;
  }

  /**
   * Ask password.
   */
  private function ask() : NULL |string {
    $password = NULL;
    $this->io->askHidden('What is your password?', function (string $password): string {
      if (empty($password)) {
        throw new \RuntimeException('Password cannot be empty.');
      }
      return $password;
    });
    return $password;
  }

}
