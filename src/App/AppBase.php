<?php

namespace Srvr\App;

use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * App Base - Abstract class.
 */
abstract class AppBase {

  //phpcs:disable
  protected SymfonyStyle $io;
  protected string $name;
  //phpcs:enable

  /**
   * Constructor.
   */
  public function __construct(SymfonyStyle $io) {
    $this->io = $io;
  }

  /**
   * Cp Directory.
   */
  public function cp(string $name) : string {
    $this->exec(['mkdir', '-p', '/opt/apps']);
    return $this->exec(['cp', '-r', "{$_ENV['ACCETS']}/apps/$name", '/opt/apps']);
  }

  /**
   * Current data.
   */
  public function exec(array $cmd, float $timeout = 999999) : string {
    $process = new Process($cmd, NULL, [
      'DEBIAN_FRONTEND' => 'noninteractive',
    ]);
    $process->setTimeout($timeout);
    $process->run();
    if (!$process->isSuccessful()) {
      throw new ProcessFailedException($process);
    }
    return $process->getOutput();
  }

  /**
   * Current data.
   */
  public function echo(string $env, string $file) : string {
    $name = $this->name;
    $this->io->success("$name: echo {$val} > {$file}");
    file_put_contents("/opt/apps/{$name}/$file", $env);
    return "";
  }

  /**
   * Current data.
   */
  public function sedFile(string $env, string $val, string $file) : string {
    $name = $this->name;
    $this->io->success("$name: {$env}{$val}");
    $this->exec([
      "sed",
      "-i",
      "-e",
      "s/$env/{$val}/g",
      "/opt/apps/{$name}/$file",
    ]);
    return "";
  }

  /**
   * Current data.
   */
  public function setEnv(string $env, string $val) : string {
    $name = $this->name;
    $this->io->success("$name: {$env}{$val}");
    $this->exec([
      "sed",
      "-i",
      "-e",
      "s/$env/{$env}{$val}/g",
      "/opt/apps/{$name}/.env",
    ]);
    return "";
  }

  /**
   * Current data.
   */
  public function setUser(string $env = 'USERNAME=') : string {
    $name = $this->name;
    $user = $this->genUser();
    $this->io->success("$name: {$env}{$user}");
    $this->exec([
      "sed",
      "-i",
      "-e",
      "s/$env/{$env}{$user}/g",
      "/opt/apps/{$name}/.env",
    ]);
    return "";
  }

  /**
   * Current data.
   */
  public function setPass(string $env = 'PASSWORD=') : string {
    $name = $this->name;
    $pass = $this->genPass();
    $this->io->success("$name: {$env}{$pass}");
    $this->exec([
      "sed",
      "-i",
      "-e",
      "s/$env/{$env}{$pass}/g",
      "/opt/apps/{$name}/.env",
    ]);
    return "";
  }

  /**
   * Current data.
   */
  public function setHost(string $env = 'HOST=') : string {
    $name = $this->name;
    $host = $_ENV['HOST'];
    $this->io->success("$name: {$env}{$host}");
    $this->exec([
      "sed",
      "-i",
      "-e",
      "s/$env/{$env}{$host}/g",
      "/opt/apps/{$name}/.env",
    ]);
    return "";
  }

  /**
   * Current data.
   */
  public function genUser() : string {
    if (empty($_ENV['USER'])) {
      $_ENV['USER'] = bin2hex(random_bytes(3));
    }
    return $_ENV['USER'];
  }

  /**
   * Current data.
   */
  public function genPass() : string {
    return date("Y.m.d") . "." . bin2hex(random_bytes(15)) . "";
  }

}
