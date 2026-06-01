#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Srvr\Command\Check;
use Srvr\Command\Fix;
use Srvr\Command\Install;
use Srvr\Command\SetApp;
use Srvr\Command\SetCron;
use Srvr\Command\TestEmail;
use Srvr\Console\PromptsConfig;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Dotenv\Dotenv;

// Sup .env vars. print_r($_ENV);
$dir = $_SERVER['PWD'];
$dotenv = new Dotenv();
$dotenv->load("{$dir}/.env");
if (file_exists("{$dir}/.env.local")) {
  $dotenv->load("{$dir}/.env.local");
}

$input = new ArgvInput();
$output = new ConsoleOutput();
PromptsConfig::apply($input, $output);

// Symfony app.
$app = new Application('Console App', 'v1.0');
$app->addCommand(new Fix());
$app->addCommand(new Check());
$app->addCommand(new SetApp());
$app->addCommand(new Install());
$app->addCommand(new SetCron());
$app->addCommand(new TestEmail());
if ($_ENV['APP_TEMPLATE'] ?? FALSE) {
  $app->setDefaultCommand($_ENV['APP_TEMPLATE'], TRUE);
}
// Run.
$app->run($input, $output);
