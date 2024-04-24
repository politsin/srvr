<?php

namespace Srvr\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Test Email.
 */
class TestEmail extends Command {

  //phpcs:disable
  protected OutputInterface $output;
  protected SymfonyStyle $io;
  //phpcs:enable

  /**
   * Config.
   */
  protected function configure() {
    $this
      ->setName('test-mail')
      ->setDescription('Email test')
      ->addArgument('mail', InputArgument::REQUIRED, 'The mail to send.');
  }

  /**
   * Exec.
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $this->output = $output;
    $this->io = new SymfonyStyle($input, $output);
    $this->io->title('Email Test');
    $mail = $input->getArgument('mail');
    $output->writeln("Mail: $mail");

    $m = $this->mail($mail);
    $output->writeln("Result: " . $m ? "OK" : "FAIL");
    return 0;
  }

  /**
   * MAil!
   */
  private function mail(string $to) : bool {
    $subject = "Test mail from console";
    $message = date("d M H:i") . "test mail";
    $headers = [
      'From' => 'do-not-reply@s1dev.ru',
      'X-Mailer' => 'PHP/' . phpversion(),
      'Reply-To' => 'do-not-reply@s1dev.ru',
    ];
    $params = "";
    $result = mail($to, $subject, $message, $headers, $params);
    return $result;
  }

}
