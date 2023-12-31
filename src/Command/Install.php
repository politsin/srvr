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
    $info = $this->currentSrvrInfo();
    if (file_exists('/opt/docker-proxy')) {
      $this->io->block('Already installed', 'error');
      return 0;
    }
    $this->io->comment('Installing...');
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
   * Servers.
   */
  private function installX64(array $info) : void {
    $this->io->block('x86_64', 'info');
    // OS Description.
    switch ($info['Distributor ID']) {
      case 'Ubuntu':
        $this->io->comment('Ubuntu 22.04 LTS');
        foreach ($this->installSteps() as $key => $value) {
          $step = "Srvr\Step\\" . $key;
          (new $step())->run($value, $this->io);
        }
        break;

      case 'Debian':
        $this->io->comment('Debian 11 Bullseye');
        foreach ($this->installSteps() as $key => $value) {
          $step = "Srvr\Step\\" . $key;
          (new $step())->run($value, $this->io);
        }
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
        foreach ($this->installSteps() as $key => $value) {
          $step = "Srvr\Step\\" . $key;
          (new $step())->run($value, $this->io);
        }
        break;

      default:
        $this->io->block("Not supported {$info['Distributor ID']}", 'error');
        break;
    }
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
