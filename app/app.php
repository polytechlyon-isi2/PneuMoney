<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Register services
$app['dao.pneu'] = $app->share(function ($app) {
    return new PneuMoney\DAO\PneuDAO($app['db']);
});

$app['dao.marque'] = $app->share(function ($app) {
    return new PneuMoney\DAO\MarqueDAO($app['db']);
});

$app['dao.taille'] = $app->share(function ($app) {
    return new PneuMoney\DAO\TailleDAO($app['db']);
});
