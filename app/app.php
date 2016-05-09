<?php

$app = new Silex\Application();
$app['debug'] = (false !== getenv("APP_DEBUG"))
    ? true
    : false;
$app['APP_NAME'] = (false !== getenv("APP_NAME"))
    ? getenv("APP_NAME")
    : "app";


// PROVIDERS
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/views',
));


$app['log'] = $app->share(function () use ($app) {
    $log = new Monolog\Logger($app['APP_NAME']);
    $log->pushHandler(
        new Monolog\Handler\SyslogHandler($app['APP_NAME'])
    );
    return $log;
});


// CONTROLLERS
$app['action.index'] = $app->share(function () use ($app) {
    return new App\ShowIndexPageAction(
        $app['twig'],
        $app['log']
    );
});


require_once __DIR__ . '/routes.php';
