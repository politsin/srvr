<?php

namespace Srvr\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Yaml\Yaml;

/**
 * Check System.
 */
class Check extends Command {

  //phpcs:disable
  protected OutputInterface $output;
  protected SymfonyStyle $io;
  //phpcs:enable

  /**
   * Config.
   */
  protected function configure() {
    $this
      ->setName('check')
      ->setDescription('Check system');
  }

  /**
   * Exec.
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $this->output = $output;
    $this->io = new SymfonyStyle($input, $output);
    $this->io->title('Check');
    $info = $this->currentSrvrInfo();
    dump($info);
    // Switch CPU Arvhitecture.
    switch ($info['arch']) {
      case 'x86_64':
        $this->installX64($info);
        break;

      case 'aarch64':
        // Apt install lm-sensors i2c-tools.
        $this->installArm($info);
        break;

      default:
        $this->io->block("Not supported {$info['arch']}", 'error');
        break;
    }
    return 0;
  }

  /**
   * Servers.
   */
  private function installX64(array $info) : void {
    $this->io->block('x86_64', 'info');
    // OS Description.
    switch ($info['Distributor ID']) {
      case 'Ubuntu':
        $this->io->comment("Ubuntu {$info['Release']} / {$info['Codename']}");
        break;

      case 'Debian':
        $this->io->comment("Debian {$info['Release']} / {$info['Codename']}");
        break;

      default:
        $this->io->block("Not supported {$info['Distributor ID']}", 'error');
        break;
    }
  }

  /**
   * Arm, Pi.
   */
  private function installArm(array $info) : void {
    $this->io->block('Arm', 'info');
    // OS Description.
    switch ($info['Distributor ID']) {
      case 'Ubuntu':
        $this->io->comment('Ubuntu 22.04 LTS');
        break;

      default:
        $this->io->block("Not supported {$info['Distributor ID']}", 'error');
        break;
    }
  }

  /**
   * Current data.
   */
  private function currentSrvrInfo() : array {
    $data = Yaml::parse($this->exec(['lsb_release', '-a']));
    $data['arch'] = trim($this->exec(['arch']));
    return $data;
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
