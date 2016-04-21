<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use PneuMoney\Domain\User;
use PneuMoney\DAO\UserDAO;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new PneuMoney\DAO\UserDAO($app['db']);
            }),
        ),
    ),
));

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
$app['dao.user'] = $app->share(function ($app) {
    return new PneuMoney\DAO\UserDAO($app['db']);
});
$app['dao.panier'] = $app->share(function ($app) {
    $panierDAO = new PneuMoney\DAO\PanierDAO($app['db']);
    $panierDAO->setPneuDAO($app['dao.pneu']);
    $panierDAO->setUserDAO($app['dao.user']);
    return $panierDAO;
});
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.messages' => array(),
));
