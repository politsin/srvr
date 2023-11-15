#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';
use Srvr\Command\Install;
use Srvr\Command\SetApp;
use Symfony\Component\Console\Application;
use Symfony\Component\Dotenv\Dotenv;

// Sup .env vars. print_r($_ENV);
$dotenv = new Dotenv();
$dotenv->load("{$_SERVER['PWD']}/.env");

// Symfony app.
$app = new Application('Console App', 'v1.0');
$app->add(new Install());
$app->add(new SetApp());
$app->setDefaultCommand($_ENV['APP_TEMPLATE'], TRUE);
// Run.
$app->run();
