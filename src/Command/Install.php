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
    // Switch CPU Arvhitecture.
    switch ($info['arch']) {
      case 'x86_64':
        $this->installX64($info);
        break;

      case 'arm':
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
      // 'Step3TimeZone' => "Set TimeZone",
      // 'Step3Bash' => "Set Bash",
      // 'Step3Swap' => "Set Swap",
      // 'Step4Util' => "Install utility",
      // 'Step5Docker' => "Install Docker",
      // 'Step5DockerRest' => "Docker REST",
      // 'Step5DockerProxy' => "Docker Proxy",
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
        $this->io->comment('Ubuntu 22.04.2 LTS');
        foreach ($this->installSteps() as $key => $value) {
          $step = "Srvr\Step\\" . $key;
          (new $step())->run($value);
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
