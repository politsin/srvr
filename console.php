#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';
use Srvr\Command\Install;
use Srvr\Command\SetApp;
use Srvr\Command\SetCron;
use Symfony\Component\Console\Application;
use Symfony\Component\Dotenv\Dotenv;

// Sup .env vars. print_r($_ENV);
$dir = $_SERVER['PWD'];
$dotenv = new Dotenv();
$dotenv->load("{$dir}/.env");
if (file_exists("{$dir}/.env.local")) {
  $dotenv->load("{$dir}/.env.local");
}
// Symfony app.
$app = new Application('Console App', 'v1.0');
$app->add(new Install());
$app->add(new SetApp());
$app->add(new SetCron());
if ($_ENV['APP_TEMPLATE'] ?? FALSE) {
  $app->setDefaultCommand($_ENV['APP_TEMPLATE'], TRUE);
}
// Run.
$app->run();
