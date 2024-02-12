<?php

namespace Srvr\System;

use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Yaml\Yaml;

/**
 * System OS Ubuntu.
 */
class System {

  //phpcs:disable
  private SymfonyStyle $io;
  private array $info;
  //phpcs:enable

  /**
   * Create new.
   */
  public function __construct(SymfonyStyle $io) {
    $this->io = $io;
    $this->info = $this->init();
  }

  /**
   * Current data.
   */
  private function init() : array {
    $data = Yaml::parse($this->exec(['lsb_release', '-a']));
    $data['arch'] = trim($this->exec(['arch']));
    switch ($data['arch']) {
      case 'x86_64':
        $data['archClass'] = 'ArchX64';
        break;

      case 'aarch64':
        $data['archClass'] = 'ArchArm';
        break;

      default:
        $this->io->block("Not supported {$data['arch']}", 'error');
        $data['archClass'] = NULL;
        break;
    }
    $os = $data['Distributor ID'];
    switch ($data['Release']) {
      case '20.04':
        $data['osClass'] = ($os == 'Ubuntu' ? 'Ubuntu20Lts' : NULL);
        break;

      case '22.04':
        $data['osClass'] = ($os == 'Ubuntu' ? 'Ubuntu22Lts' : NULL);
        break;

      case '24.04':
        $data['osClass'] = ($os == 'Ubuntu' ? 'Ubuntu24Lts' : NULL);
        break;

      case '11':
        $data['osClass'] = ($os == 'Debian' ? 'Debian11' : NULL);
        break;

      case '12':
        $data['osClass'] = ($os == 'Debian' ? 'Debian12' : NULL);
        break;

      default:
        $this->io->block("Not supported {$data['Distributor ID']}", 'error');
        $data['osClass'] = NULL;
        break;
    }

    if (!empty($data['osClass'])) {
      $osClass = "Srvr\System\\{$data['osClass']}";
      try {
        $s = new $osClass();
        $this->io->info("{$data['Description']}\n$s->name / $s->version from {$data['osClass']}");
        $data['os'] = $s;
      }
      catch (\Throwable $th) {
        $this->io->error("Missing OS Class");
        dump($data);
        throw $th;
      }
    }

    return $data;
  }

  /**
   * Current data.
   */
  public function getInfo() : array {
    return $this->info;
  }

  /**
   * Current data.
   */
  public function install(array $steps) : array {
    $info = $this->info;
    dump($info);
    $result = [];
    foreach ($steps as $key => $value) {
      $step = "Srvr\Step\\{$key}";
      $stepsys = (new $step($value, $this->io))->setInfo($info);
      $result[$key] = $stepsys->run();
    }
    return $result;
  }

  /**
   * Symfony exec.
   */
  public function exec(array $cmd) : string {
    $process = new Process($cmd);
    $process->run();
    if (!$process->isSuccessful()) {
      throw new ProcessFailedException($process);
    }
    return $process->getOutput();
  }

}
