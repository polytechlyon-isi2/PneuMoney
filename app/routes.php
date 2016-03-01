<?php

// Home page
$app->get('/', function () use ($app) {
    $pneus = $app['dao.pneu']->findAll();
    return $app['twig']->render('index.html.twig', array('pneus' => $pneus));
})->bind('home');

// Details sur un pneu
$app->get('/pneu/{id}', function ($id) use ($app) {
    $pneu = $app['dao.pneu']->find($id);
    return $app['twig']->render('pneu.html.twig', array('pneu' => $pneu));
})->bind('article');;
