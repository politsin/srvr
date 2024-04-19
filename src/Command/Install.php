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
    $steps = $this->installSteps();
    if (file_exists('/opt/docker-proxy')) {
      $this->io->block('Already installed', 'error');
      dump($info);
      // Return 0;.
    }
    // Install.
    dump($steps);
    $this->io->comment('Installing...');
    $system->install($steps);
    return 0;
  }

  /**
   * Servers.
   */
  private function installSteps() : array {
    $installText = "Install all";
    $install = [
      'Step1Clear' => "Clear apache, exim, etc",
      'Step2Update' => "Update system",
      'Step2Util' => "Util",
      'Step2ArchUtil' => "Util: architecture-dependent utilities",
      'Step3Bash' => "Set Bash",
      'Step3FsMaxWatches' => "Set file monitor FsMaxWatches for VsCode",
      'Step3GitUser' => "Set git user",
      'Step4Swap' => "Swap 4G",
      'Step5Docker' => "Install Docker",
      'Step6DockerProxy' => "Docker Proxy",
      'Step6LogRotate' => "LogRotate",
      'Step7DockerRest' => "Docker Rest",
      'Step7DockerImages' => "Docker Images php, mysql, dockup",
      'Step8CronKill' => "Cron kill phpcs, phpcbf, vscode",
    ];
    $help = [
      '=' => $installText,
      'Step9TimeZone' => "Set TimeZone to Moscow",
      'Step9FixProxyIncludes' => "Fix Proxy Includes",
    ];
    $choises = [
      '=' => $installText,
      ...$install,
      ...$help,
    ];
    ksort($choises);
    $user = $this->io->choice('Select steps, example: 4,7,8', array_values($choises), NULL, TRUE);
    if (in_array($installText, $user)) {
      $this->io->warning('Full install selected');
      return $install;
    }
    elseif (!empty($user)) {
      foreach ($choises as $key => $value) {
        if (!in_array($value, $user)) {
          unset($choises[$key]);
        }
      }
    }
    return $choises;
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
