<?php

require_once __DIR__.'/../vendor/autoload.php';

Symfony\Component\Debug\ErrorHandler::register();

$dotenv = new Dotenv\Dotenv(__DIR__."/../..");
$dotenv->load();
