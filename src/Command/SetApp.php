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
class SetApp extends Command {

  //phpcs:disable
  protected OutputInterface $output;
  protected SymfonyStyle $io;
  //phpcs:enable

  /**
   * Config.
   */
  protected function configure() {
    $this
      ->setName('setapp')
      ->setDescription('set app, KO');
  }

  /**
   * Exec.
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $this->output = $output;
    $this->io = new SymfonyStyle($input, $output);
    $this->io->title('Set App');
    $this->ask();
    $user = $this->io->choice('Select apps, example: 4,7,8', array_values($this->apps()), NULL, TRUE);
    $apps = $this->apps($user);

    foreach ($apps as $key => $app) {
      $step = "Srvr\App\\" . $key;
      $this->io->success($app);
      (new $step($this->io))->run();
    }
    return 0;
  }

  /**
   * Available apps.
   */
  private function apps(array $user = []) : array {
    // 4 из 18
    $apps = [
      'AppBridge' => '[ ] bridge - php bridge MQTT to influx',
      'AppCertbot' => '[-] certbot - Lets Encrypt certs',
      'AppChatwoot' => '[ ] chatwoot',
      'AppClickhouse' => 'clickhouse',
      'AppElastic' => 'elastic search with kibana',
      'AppExim' => '[ ] exim - mail server',
      'AppGrafana' => 'grafana - dashboard',
      'AppInflux' => 'influx - time series db',
      'AppMattermost' => '[ ] mattermost',
      'AppMetabase' => 'metabase - bi',
      'AppOpenVpn' => 'openvpn - vpn',
      'AppPortainer' => 'portainer - docker dashboard',
      'AppPrometheus' => 'prometheus - metrics',
      'AppRabbitMQ' => 'rabbitmq - message broker',
      'AppRedis' => 'redis - key value store',
      'AppSocks5' => 'socks5 proxy',
      'AppTelegraf' => 'telegraf - metrics',
      'AppWireGuard' => 'wireguard - vpn',
    ];
    // Filter apps from user input.
    if (!empty($user)) {
      foreach ($apps as $key => $value) {
        if (!in_array($value, $user)) {
          unset($apps[$key]);
        }
      }
    }
    return $apps;
  }

  /**
   * Current data.
   */
  private function ask() : void {
    if (empty($_ENV['USER'])) {
      $_ENV['USER'] = $this->io->ask('User', NULL, function ($answer) {
        return $answer;
      });
    }
    if (empty($_ENV['HOST'])) {
      $_ENV['HOST'] = $this->io->ask('Host', NULL, function ($answer) {
        return $answer;
      });
    }
    print_r($_ENV);
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
