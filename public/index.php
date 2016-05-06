<?php

require_once __DIR__.'/../common.php';

$app = new Silex\Application();
$app['debug'] = true;


// PROVIDERS
$app->register(new Silex\Provider\ServiceControllerServiceProvider());


$app['logger'] = $app->share(function () {
    $log = new Monolog\Logger('name');
    $log->pushHandler(
        new Monolog\Handler\StreamHandler('php://stdout', Monolog\Logger::WARNING)
    );
    return $log;
});


// CONTROLLERS
$app['action.index'] = $app->share(function () use ($app) {
    return new Crudders\ShowIndexPageAction();
});

// ROUTES
$app->get("/", "action.index:__invoke");

$app->run();
