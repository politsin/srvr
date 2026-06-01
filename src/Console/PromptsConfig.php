<?php

namespace Srvr\Console;

use Laravel\Prompts\MultiSelectPrompt;
use Laravel\Prompts\Prompt;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Laravel Prompts setup for Linux interactive terminals.
 */
final class PromptsConfig {

  /**
   * Configure prompts before running console commands.
   */
  public static function apply(InputInterface $input, OutputInterface $output): void {
    Prompt::setOutput($output);

    $interactive = $input->isInteractive()
      && defined('STDIN')
      && stream_isatty(STDIN);

    Prompt::interactive($interactive);
    Prompt::fallbackWhen(!$interactive);

    MultiSelectPrompt::fallbackUsing(function (MultiSelectPrompt $prompt) use ($input, $output): array {
      $style = new SymfonyStyle($input, $output);
      $options = $prompt->options;

      if (!array_is_list($options)) {
        $labels = array_values($options);
        $selected = $style->choice($prompt->label, $labels, NULL, TRUE);
        $keys = [];
        foreach ($options as $key => $label) {
          if (in_array($label, $selected, TRUE)) {
            $keys[] = $key;
          }
        }
        return $keys;
      }

      return $style->choice($prompt->label, $options, NULL, TRUE);
    });
  }

}
